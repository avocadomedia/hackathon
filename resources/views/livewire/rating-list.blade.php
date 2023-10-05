<div>
    <x-filament::button tag="a" href="{{ route('ratings.create') }}">
        New rating
    </x-filament::button>

    <ul class="flex flex-col gap-8">
        @foreach($ratings as $rating)
            <li class="p-4 bg-gray-200">
                <p>PDOK ID: {{ $rating->pdok_id }}</p>
                <p>Rating: {{ $rating->score }}</p>
                <p>Comment: {{ $rating->comment }}</p>
            </li>
        @endforeach
    </ul>
</div>
