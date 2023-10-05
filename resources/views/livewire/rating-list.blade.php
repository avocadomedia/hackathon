<script>
    async function fetchPosts() {
      return await (await fetch('/api/ratings')).json();
    }

    
</script>

<div
    x-data="{ posts: [], locationDetails: [] }"
    x-init="(() => {
        fetchPosts().then(data => {
            // Log the data
            console.log('Raw Data:', data);

            // Transform the data as needed
            const transformedData =  data.data.map((item) => {
                return {
                    ...item,
                    latlng: [item.pdok_latitude, item.pdok_longitude]
                }
            })


            // Arrays of [item.pdok_latitude, item.pdok_longitude]
            // Arrays of detail elements like we have now

            {{-- const transformedData = data.map(post => ({ --}}
                {{-- // Example: Transform the post title to uppercase --}}
                {{-- title: post.title.toUpperCase(), --}}
                {{-- // Include other transformations or filtering as needed --}}
            {{-- })); --}}

            // Assign the transformed data to the 'posts' variable
        });
    })()"
    class="min-h-screen relative"
>
    <x-mapbox class="h-[70vh]" :markers="[[13.4105300, 52.5243700], [4.895168, 52.370216]]"  :options="['zoom' => 11, 'style' => 'mapbox://styles/mapbox/light-v11', 'center' => [4.895168, 52.370216]]" />   


    <aside class="fixed z-50 bottom-0 w-full rounded-xl border p-8 pb-32 bg-white shadow-md">
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
</div>