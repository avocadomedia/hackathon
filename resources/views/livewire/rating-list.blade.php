<div>
    <x-mapbox class="h-[70vh]" :markers="[[13.4105300, 52.5243700], [4.895168, 52.370216]]"  :options="['zoom' => 11, 'style' => 'mapbox://styles/mapbox/light-v11', 'center' => [4.895168, 52.370216]]" />   
    
    <div
    x-data="{
        search: '',

        items: ['foo', 'bar', 'baz'],

        get filteredItems() {
            return this.items.filter(
                i => i.startsWith(this.search)
            )
        }
    }"
>
    <input x-model="search" placeholder="Search...">

    <ul>
        <template x-for="item in filteredItems" :key="item">
            <li x-text="item"></li>
        </template>
    </ul>

    {{-- 


</div>

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
</ul> --}}
</div>
