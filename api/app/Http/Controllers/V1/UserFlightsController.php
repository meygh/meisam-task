<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFlightStore;
use App\Http\Resources\UserFlightResource;
use App\Models\UserFlight;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UserFlightsController extends Controller
{
    /**
     * Retrieves of users' flights by pagination.
     *  By default, 30 flights per page will be shown.
     *
     * @param int|null $user_id
     *
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(int $user_id = null)
    {
        if (!$user_id) {
            return $this->userIdIsRequiredError();
        }

        $flights = UserFlight::where(['user_id' => $user_id])->paginate(30);

        return UserFlightResource::collection($flights);
    }

    /**
     * Retrieves of the first departure and the last destination of user's flight.
     *
     * @param int|null $user_id
     *
     * @return array<string>|JsonResponse
     */
    public function firstAndLastFlights(int $user_id = null)
    {
        if (!$user_id) {
            return $this->userIdIsRequiredError();
        }

        $flights = UserFlight::getFirstAndLastFlights($user_id);

        return array_values($flights);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserFlightStore $request
     * @param int|null $user_id
     *
     * @return array|JsonResponse
     */
    public function store(UserFlightStore $request, int $user_id = null)
    {
        if (!$user_id) {
            return $this->userIdIsRequiredError();
        }

        $flights = $request->validated('flights');

        if (!$flights) {
            return [];
        }

        $new_flights = $this->prepareFlights($user_id, $flights);

        try {
            // Use transaction to controlling multiple insertion which reattempt 5 times
            DB::transaction(function () use ($new_flights) {
                UserFlight::insert($new_flights);
            }, 5);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'ثبت پروازها با خطا مواجه شد لطفا پس از بررسی داده های ورودی مجددا تلاش کنید',
                'error' => $e->getMessage()
            ], 422);
        }

        return response()->json([
            'status' => true,
            'data' => $flights
        ], 201);
    }

    /**
     * Re-Map and prepare the posted flights array for multiple insertion.
     *
     * @param int $user_id
     * @param array $flights
     *
     * @return array
     */
    protected function prepareFlights(int $user_id, array &$flights): array
    {
        $new_flights = []; // Validated flights for inserting into database

        foreach ($flights as $index => $flight) {
            if (!$flight || count($flight) != 2) {
                unset($flights[$index]); // Delete invalid flight element from request

                continue;
            }

            $new_flights[] = [
                'user_id' => $user_id,
                'departure_airport' => Arr::get($flight, 0),
                'destination_airport' => Arr::get($flight, 1)
            ];
        }

        return $new_flights;
    }

    /**
     * Make and return a json response error whenever "user_id" parameter is not exists.
     *
     * @return JsonResponse
     */
    protected function userIdIsRequiredError(): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => 'کد کاربر برای دریافت اطلاعات پروازها الزامی است'
        ], 400);
    }
}
