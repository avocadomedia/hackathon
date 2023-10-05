<div class="h-screen overflow-hidden relative lg:grid lg:grid-cols-[82px,auto] ">
    <aside class="fixed bg-white border-t lg:relative lg:border-none shadow-lg bottom-0 z-[51] flex justify-center w-full py-2 lg:flex-col lg:items-center lg:justify-center lg:col-start-1 lg:row-start-1 px-3">
        <div class="w-10 top-1/2 lg:top-10 lg:w-14 lg:h-14 lg:left-3 -translate-y-1/2 h-10 overflow-hidden absolute left-4">
            <img src='https://github.com/avocadomedia/hackathon/assets/48051912/b8a321b6-b2a5-4e4e-a350-ce10f61f23da' alt='logo' />
        </div>

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


    <x-layouts.app>
       <div class="flex flex-col items-center justify-center w-full m-4">
        <form class='border rounded-xl shadow-lg' action="{{ route('ratings.store') }}" method="post">
            @csrf
            <div class="flex flex-col gap-6 py-8 px-4 w-[500px]" id="address-form" action="" method="get" autocomplete="off">
                <div class="mx-auto rounded-xl overflow-hidden">
                    <img class="w-full" src='https://github.com/avocadomedia/hackathon/assets/48051912/817dba0f-be7f-46e7-bd3d-fdd5b8512952' alt='hero image' />
                </div>

                <fieldset>
                    <label class="flex flex-col gap-2">
                        <span class="font-bold text-xl">Plaats</span>
                        <h2 class="text-xl" style="color:#333;" id="placeNameDisplay"></h2>
                    </label>

                    <input type="hidden" name="name" id="hiddenName" />
                </fieldset>

                <div class="flex gap-4 w-fit">
                    <fieldset class='flex flex-col gap-2 w-auto'>
                        <label class="font-bold text-xl" for='address'>Adres</label>
                    
                        <input class='px-4 py-2 focus:border-2 w-full focus:border-yellow-500  outline-yellow-500 border-slate-600 rounded-lg' id="ship-address" name="address" required autocomplete="off" />
                   </fieldset>

                   <fieldset class='flex flex-col gap-2 w-auto'>
                        <label class="font-bold text-xl" for="zip">Postcode</label>
                        <input class='px-4 py-2 focus:border-2 w-full focus:border-yellow-500  outline-yellow-500 border-slate-600 rounded-lg' id="ship-address" id="postcode" name="zip" required />
                    </fieldset>
                </div>

                
                <input type="hidden" name="longitude" id="longitude" />
                <input type="hidden" name="latitude" id="latitude" />

                <fieldset class='flex flex-col gap-2'>
                    <label class="font-bold text-xl"  for="score">Score</label>
                    <input class='px-4 py-2 focus:border-2 focus:border-yellow-500  outline-yellow-500 border-slate-600 rounded-lg' type='number' min="1" max="5" id="score" name="score" required />
                </fieldset>

                <fieldset>
                    <label class="flex flex-col"  for="comment">
                        <span class="font-bold mb-4">Opmerking</span>
                    </label>
                    <textarea class="w-full rounded-lg resize-none"  id="comment" name="comment" required></textarea>
                </fieldset>

                <input class="w-full py-4 rounded-lg bg-black text-white ease duration-150 hover:cursor-pointer mt-4 hover:bg-slate-700" type="submit" value="Doorvoeren" class="bt-submit" />
            </div>

            <script>
                let autocomplete;
                let address1Field;
                let postalField;

                function initAutocomplete() {
                    address1Field = document.querySelector("#ship-address");
                    postalField = document.querySelector("#postcode");

                    autocomplete = new google.maps.places.Autocomplete(address1Field, {
                        componentRestrictions: {
                            country: ["nl"]
                        },
                        fields: ["address_components", "formatted_address", "geometry", "name"],
                    });
                    address1Field.focus();
                    autocomplete.addListener("place_changed", fillInAddress);
                }

                function fillInAddress() {
                    const place = autocomplete.getPlace();
                    const lat = place.geometry.location.lat();
                    const lng = place.geometry.location.lng();

                    document.getElementById("longitude").value = lng;
                    document.getElementById("latitude").value = lat;

                    const placeName = place.name;
                    document.getElementById("placeNameDisplay").innerText = placeName;
                    document.getElementById("hiddenName").value = placeName;

                    let address1 = "";
                    let postcode = "";

                    for (const component of place.address_components) {
                        const componentType = component.types[0];

                        switch (componentType) {
                            case "street_number": {

                                address1 = `${component.long_name} ${address1}`;
                                break;
                            }

                            case "route": {
                                address1 += component.short_name;
                                break;
                            }

                            case "postal_code": {
                                postcode = `${component.long_name}${postcode}`;
                                break;
                            }

                            case "postal_code_suffix": {
                                postcode = `${postcode}-${component.long_name}`;
                                break;
                            }
                        }
                    }

                    address1Field.value = address1;
                    postalField.value = postcode;
                }

                window.initAutocomplete = initAutocomplete;
            </script>
            <script
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFIRKxfoGWp8fdtj6KYN7ZlpcuAIEmqiQ&callback=initAutocomplete&libraries=places">
            </script>
        </form>
    </div>
    </x-layouts.app>
</div>
