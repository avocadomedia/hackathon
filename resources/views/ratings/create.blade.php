<x-layouts.app>
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
</x-layouts.app>

