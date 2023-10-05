<script>
    let markers = null;
    function fetchPosts() {
        return fetch('/api/ratings').then(x => {
            x.json().then(y => {
                markers = y.data;
                console.log(markers);
            });
        });
    }
</script>

<div
    x-data="{ posts: [], locationDetails: [] }"
    x-init="(() => { fetchPosts().then(data => { posts = data }) })()"
    class="min-h-screen relative"
>
    <x-mapbox class="h-[70vh]" :markers="[this.posts]"  :options="['zoom' => 11, 'style' => 'mapbox://styles/mapbox/light-v11', 'center' => [4.895168, 52.370216]]" />

    <aside class="fixed z-50 bottom-0 w-full rounded-xl border p-8 pb-32 bg-white shadow-md">
        <p>Hello World</p>
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