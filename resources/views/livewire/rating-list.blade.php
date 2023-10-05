<div class="h-screen overflow-hidden relative lg:grid lg:grid-cols-[82px,auto,60vw]">
    {{-- Map --}}
    <div id="map" class="absolute h-[70vh] lg:col-start-3 lg:h-screen lg:w-[60vw]"></div>


    {{-- Search + list --}}
    <aside class="fixed overflow-y-scroll z-50 bottom-8 w-full rounded-2xl border p-8 pb-32 bg-white shadow-md lg:relative lg:bottom-[initial] lg:col-start-2 lg:row-start-1 lg:border-0 lg:rounded-none lg:shadow-xl  lg:border-l lg:border-r ">
        <form id="search-form">
            <div class="relative flex gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 absolute left-2 top-1/2 -translate-y-1/2 stroke-slate-600 stroke-2 stroke-">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                  </svg>
                  
                <input class="rounded w-full pl-12 border-slate-500" id="search-input" placeholder="Avocado Media..">
                <button class="w-32 h-auto bg-stone-900 text-white rounded" type="submit">Search</button>
            </div>

        </form>

        <div id="results" class="mt-8 flex flex-col gap-3 ">
         
        </div>
    </aside>

    {{-- Menu --}}
    <aside class="fixed bg-white border-t lg:relative lg:border-none shadow-lg bottom-0 z-[51] flex justify-center w-full py-2 lg:flex-col lg:items-center lg:justify-center lg:col-start-1 lg:row-start-1 px-3">
        <nav class="flex justify-center lg:flex-col gap-4 items-center">
            <li class="border w-fit rounded-xl list-none hover:bg-slate-200 ease duration-150 hover:cursor-pointer">
                <a href='/' class="block p-3 lg:p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 lg:w-6 lg:h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </a>
            </li>
            <li class="border w-fit rounded-xl list-none hover:bg-slate-200 ease duration-150 hover:cursor-pointer">
                <a href='/create' class="block p-3 lg:p-4">
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
        console.log(data.data)
        return data.data;
    }

 
    const placeMarkers = (data) => {
        for (const item of data) {
            const coords = [parseFloat(item.pin.longitude), parseFloat(item.pin.latitude)];
            
            console.log(item)
            new mapboxgl.Marker()
                .setLngLat(coords)
                .addTo(map)
                .setPopup(
                    new mapboxgl.Popup({ offset: 25 }).setHTML(`
                        <div class='p-1 rounded-xl'>
                            <h3 class='font-bold'>${item.name}</h3>
                            <p>${item.address}</p>
                        </div>
                    `)
                )
        }
    }

    // Fetch and place markers
    fetchPosts().then(data => {
        placeMarkers(data);
        displayResults(data)
    });


    const form = document.getElementById('search-form');
    const input = document.getElementById('search-input');
    const resultsContainer = document.getElementById('results');
    const resultItem = document.createElement('resultItem')



    form.addEventListener('submit', function (e) {
        e.preventDefault(); 

        const query = input.value;
        const apiUrl = `/api/v1/ratings?name=${encodeURIComponent(query)}`;

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                displayResults(data)
            })
            .catch(error => {
                console.log('Error:', error);
            });
    });



    resultItem.addEventListener('click', function(e) {
        console.log('hi?')
    })


    function displayResults(data) {
        resultsContainer.innerHTML = '';

        const article = document.createElement('article')
        const image = document.createElement('img')
        const title = document.createElement('h2')
        const text = document.createElement('p')


        if (data.length > 0) {        
            for (const result of data) {
                const { address: addressValue, comment: commentValue, name: nameValue,score:scoreValue, latitude, longitude } = result;

                const article = document.createElement('article');
                const addressField = document.createElement('p');
                const div = document.createElement('div');
                // const image = document.createElement('img');
                const title = document.createElement('h2');
                const address = document.createElement('p');
                const text = document.createElement('p');

                const titleNode = document.createTextNode(nameValue)
                const textnode = document.createTextNode(commentValue);
                const addressNode = document.createTextNode(addressValue)
                // const src = `https://maps.googleapis.com/maps/api/streetview?size=400x400&location=${parseFloat(longitude)},${parseFloat(latitude)}&fov=80&heading=145&pitch=0&key=AIzaSyAFIRKxfoGWp8fdtj6KYN7ZlpcuAIEmqiQ`;

                resultsContainer.appendChild(article);
                article.appendChild(title)
                article.appendChild(address)
                article.appendChild(div)
                article.appendChild(text);

                // setHTML(`<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" /></svg>`)
                // div.appendChild()
                // article.appendChild(image);
                address.appendChild(addressNode)
                title.appendChild(titleNode)
                text.appendChild(textnode);

                for (let i = 0; i < scoreValue; i++) {
                    const star = document.createElement('span');
                    star.innerHTML = (`<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 fill-black"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" /></svg>`)
        
                    div.appendChild(star);
                }

                // image.src = src;

                title.classList.add('text-2xl', 'mb-4', 'font-bold')
                text.classList.add('mb-2')
                div.classList.add('flex', 'gap-2', 'mb-2')

                address.classList.add('mb-2', 'font-medium')
                article.classList.add('border', 'rounded-xl', 'shadow-sm', 'p-4');
                article.id = 'resultItem';

                if (data.length === 1) return map.flyTo({
                    center: [longitude, latitude],
                    essential: true 
                });
            }    

     
        } else {
            const textnode = document.createTextNode('No results found')

            resultsContainer.appendChild(article)
            article.appendChild(text)
            text.appendChild(textnode)
            article.classList.add('border', 'rounded-xl', 'shadow-sm', 'p-4')
        }
    }

    map.on('click', 'popup', (e) => {
                console.log(e)
        // const clickedLocation = e.features[0].geometry.coordinates; // Get the coordinates
        // const clickedTitle = e.features[0].properties.title; // Get the title
        // const clickedDescription = e.features[0].properties.description; // Get the description

        //     // You can do something with the location information here, e.g., display it in a popup
        //     new mapboxgl.Popup()
        //         .setLngLat(clickedLocation)
        //         .setHTML(`<h3>${clickedTitle}</h3><p>${clickedDescription}</p>`)
        //         .addTo(map);
    });
</script>