<div class="min-h-screen relative lg:grid lg:grid-cols-[auto,auto,60vw]">
    {{-- Map --}}
    <div id="map" class="h-[70vh] lg:col-start-3 lg:h-screen lg:w-[60vw]"></div>


    {{-- Search + list --}}
    <aside class="fixed z-50 bottom-8 w-full rounded-2xl border p-8 pb-32 bg-white shadow-md lg:relative lg:bottom-[initial] lg:col-start-2 lg:row-start-1 lg:border-0 lg:rounded-none lg:shadow-xl  lg:border-l lg:border-r ">
        <form id="search-form">
            <div class="relative flex gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 absolute left-2 top-1/2 -translate-y-1/2 stroke-slate-600 stroke-2 stroke-">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                  </svg>
                  
                <input class="rounded w-full pl-12 border-slate-500" id="search-input" placeholder="Search...">
                <button class="w-32 h-auto bg-stone-900 text-white rounded" type="submit">Search</button>
            </div>

        </form>

        <div id="results">
            <!-- Results will be displayed here -->
            <ul class="mt-24">
                <template x-for="item in filteredItems" :key="item">
                    <li>
                        <div class="flex gap-2 items-center">
                            <h2 class="font-bold text-2xl">[Mollie]</h2>
                            <span class="bg-slate-300 px-6 py-2 rounded">GreenBadge</span>
                        </div>

                        <div>
                           
                        </div>

                        <ul x-data="{ numbers: [1, 2, 3, 4, 5] }" class="flex mt-8">
                            <template x-for="number in numbers">
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                    </svg>
                                </li>
                            </template>
                        </ul>
                              

                        <div class="mt-4">
                            <p>Keizersgracht 126, 1012 AA</p>
                            <p>Amsterdam, The Netherlands</p>
                        </div>
                    </li>

                </template>
            </ul>
        </div>
    </aside>

    {{-- Menu --}}
    <aside class="fixed bg-white border-t lg:relative lg:border-none shadow-lg bottom-0 z-[51] flex justify-center w-full py-2 lg:flex-col lg:items-center lg:justify-center lg:col-start-1 lg:row-start-1 px-3">
        <nav class="flex justify-center lg:flex-col gap-4 items-center">
            <li class="border p-3 lg:p-4 w-fit rounded-xl list-none">
                <a href='/'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 lg:w-6 lg:h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </a>
            </li>
            <li class="border p-3 lg:p-4 w-fit rounded-xl list-none">
                <a href='/create'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 lg:w-6 lg:h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>  
                </a>
            </li>
        </nav>
    </aside>
</div>

<script>
    // Initialize Mapbox GL map
    mapboxgl.accessToken = 'pk.eyJ1Ijoiam9yci1yIiwiYSI6ImNsbmQwMThwbDAwY3cyaXA0OHZwaDZ4ZmMifQ.YawP-ZA-52PE3xBK79PcEQ'; // replace with your own Mapbox token
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/light-v11',
        center: [4.895168, 52.370216],
        zoom: 11
    });

    // Fetch data from API
    async function fetchPosts() {
        const response = await fetch('/api/ratings'); // replace with your actual API URL
        const data = await response.json();
        // console.log(data.data)
        return data.data;
    }

    // Place markers on the map
    function placeMarkers(markersData) {
        for (const item of markersData) {
            const coords = item.pin;
            new mapboxgl.Marker()
                .setLngLat(coords)
                .addTo(map);
        }
    }

    // Fetch and place markers
    fetchPosts().then(data => {
        placeMarkers(data);
    });


    // Search functionality
    const form = document.getElementById('search-form');
    const input = document.getElementById('search-input');
    const resultsContainer = document.getElementById('results');

    form.addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent the form from submitting the traditional way

        const query = input.value;

        console.log(query)
        // You should replace this with your API endpoint
        const apiUrl = `https://api.example.com/search?q=${encodeURIComponent(query)}`;

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                // Handle the API response and display results
                displayResults(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    function displayResults(data) {
        // Clear previous results
        resultsContainer.innerHTML = '';

        // Display results in the results container
        // if (data.length > 0) {
        //     data.forEach(result => {
        //         const resultItem = document.createElement('div');
        //         resultItem.textContent = result.name; // Replace with your data structure
        //         resultsContainer.appendChild(resultItem);
        //     });
        // } else {
        //     resultsContainer.textContent = 'No results found.';
        // }
    }


const Element = {
    name: "Mollie",
    address: 'Keizersgracht 126, 1012AA, Amsterdam The Netherlands', // or other structure, is fine
    rating: 4.5,
    reviews: 20,
    earnedBadge: true,
    pin: [4.895168, 52.370216],
    image: '', // image from streetview

}
</script>