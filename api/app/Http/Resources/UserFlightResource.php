<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Attributes:
 * @property int $user_id
 * @property string $departure_airport
 * @property string $destination_airport
 * @property string $created_at
 * @property string $updated_at
 */
class UserFlightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            $this->departure_airport,
            $this->destination_airport
        ];
    }
}
