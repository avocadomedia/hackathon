<div class="h-screen overflow-hidden relative lg:grid lg:grid-cols-[82px,auto]">
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


    <x-layouts.app>
       <div class="flex flex-col items-center justify-center w-full">
        <form action="{{ route('ratings.store') }}" method="post">
            @csrf
            <div id="address-form" action="" method="get" autocomplete="off">
                <label class="full-field">
                    <span class="form-label">Plaats</span>
                    <h2 style="color:#333;" id="placeNameDisplay"></h2>
                </label>


                <input type="hidden" name="name" id="hiddenName" />
                <br />
                <br />

                <label class="full-field">
                    <span class="form-label">Adres</span>
                    <input id="ship-address" name="address" required autocomplete="off" />
                </label>

                <label class="slim-field-right"  for="postal_code">
                    <span class="form-label">Postcode</span>
                    <input id="postcode" name="zip" required />
                </label>

                <input type="hidden" name="longitude" id="longitude" />
                <input type="hidden" name="latitude" id="latitude" />

                <label class="slim-field-right"  for="postal_code">
                    <span class="form-label">Score</span>
                    <input id="score" name="score" required />
                </label>

                <label class="slim-field-right"  for="postal_code">
                    <span class="form-label">Opmerking</span>
                    <br />
                    <textarea id="comment" name="comment" required></textarea>
                </label>

                <input type="submit" value="Doorvoeren" class="bt-submit" />
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
