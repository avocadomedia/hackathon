<div>
    @if($success)
        <p>Thanks for your rating.</p>
    @else
        <form wire:submit="create">
            {{ $this->form }}

            <x-filament::button type="submit" class="mt-4">
                Submit
            </x-filament::button>
        </form>
    @endif
</div>
