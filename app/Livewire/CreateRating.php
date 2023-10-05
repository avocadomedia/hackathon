<?php

namespace App\Livewire;

use App\Models\Rating;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\View\View;
use Livewire\Component;

class CreateRating extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public bool $success = false;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('pdok_id')
                    ->required(),
                TextInput::make('score')
                    ->required()
                    ->numeric(),
                Textarea::make('comment')
                    ->required(),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        Rating::create($this->form->getState());

        $this->success = true;
    }

    public function render(): View
    {
        return view('livewire.create-rating');
    }
}
