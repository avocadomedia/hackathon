<div class="mx-auto container py-16">
    <h1 class="text-3xl">Rate an address</h1>

    <div class="mt-8">
        @if($success)
            <p class="text-green-500">
                Your rating has been recorded, thanks.
            </p>
        @else
            <form wire:submit="create">
                {{ $this->form }}

                <x-filament::button type="submit" class="mt-4">
                    Rate
                </x-filament::button>
            </form>
        @endif
    </div>
</div>
