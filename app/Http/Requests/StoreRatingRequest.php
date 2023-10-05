<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRatingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'address' => 'required',
            'zip' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'score' => 'required',
            'comment' => 'nullable',
        ];
    }
}
