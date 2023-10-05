<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'pdok_id' => $this->pdok_id,
            'pdok_latitude' => $this->pdok_latitude,
            'pdok_longitude' => $this->pdok_longitude,
            'score' => $this->score,
            'comment' => $this->comment,
        ];
    }
}