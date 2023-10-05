<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'zip' => $this->zip,
            'pin' => [
                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
            ],
            'score' => $this->score,
            'comment' => $this->comment,
            'created_at' => $this->created_at,
        ];
    }
}
