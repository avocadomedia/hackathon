<?php

namespace App\Livewire;

use App\Models\Rating;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class RatingList extends Component
{
    public Collection $ratings;

    public function mount(): void
    {
        $this->ratings = Rating::all();
    }

    public function render(): View
    {
        return view('livewire.rating-list');
    }
}
