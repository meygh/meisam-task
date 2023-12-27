<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * Attributes:
 * @property int $user_id
 * @property string $departure_airport
 * @property string $destination_airport
 *
 * @property-read string|Carbon $created_at
 * @property-read string|Carbon $updated_at
 */
class UserFlight extends Model
{
    use HasFactory, Notifiable;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'departure_airport',
        'destination_airport',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Fetch and returns the departure_airport from the first flight
     *  and the destination_airport from the latest flight.
     *
     * @return Array<string>
     */
    public static function getFirstAndLastFlights(int $user_id): array
    {
        if (!$user_id) {
            return [];
        }

        $firstFlight = self::where(['user_id' => $user_id])->orderBy('id', 'ASC')->first();

        if (!$firstFlight) {
            return [];
        }

        $result = [
            'departure_airport' => $firstFlight->departure_airport,
            'destination_airport' => $firstFlight->destination_airport,
        ];

        $lastFlight = self::where(['user_id' => $user_id])
            ->where('id', '!=', $firstFlight->id)
            ->orderBy('id', 'DESC')
            ->first();

        if ($lastFlight) {
            $result['destination_airport'] = $lastFlight->destination_airport;
        }

        return $result;
    }
}
