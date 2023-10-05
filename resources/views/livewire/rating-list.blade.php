
  
  <section class="min-h-screen relative">

    <div x-data="{ result: null }">
        <button @click="fetchData()">Fetch Data</button>
        <div x-text="result"></div>
        <script>
          function fetchData() {
            fetch('/api/ratings')
              .then(response => response.json())
              .then(data => {
                // this.result = JSON.stringify(data);
                console.log(data)
              })
              .catch(error => {
                console.error('Error fetching data:', error);
              });
          }
        </script>
        </div>
        <x-mapbox class="h-[70vh]" :markers="[[13.4105300, 52.5243700], [4.895168, 52.370216]]"  :options="['zoom' => 11, 'style' => 'mapbox://styles/mapbox/light-v11', 'center' => [4.895168, 52.370216]]" />   
    

        <aside class="fixed bottom-0 w-full">
            <p>Hello World</p>

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
        </div>
    </aside>
</section>

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
