<x-layouts.app>
    <form action="{{ route('ratings.store') }}" method="post">
        @csrf
        <div id="address-form" action="" method="get" autocomplete="off">
            <label class="full-field">
                <span class="form-label">Plaats</span>
                <label style="color:#333;" id="placeNameDisplay" />
            </label>
            <br />
            <br />

            <label class="full-field">
                <span class="form-label">Adres</span>
                <input id="ship-address" name="ship-address" required autocomplete="off" />
            </label>

            <label class="slim-field-right hidden"  for="postal_code">
                <input id="postcode" name="postcode" required />
            </label>

        </div>

        <script>
            let autocomplete;
            let address1Field;
            let address2Field;
            let postalField;

            function initAutocomplete() {
                address1Field = document.querySelector("#ship-address");
                address2Field = document.querySelector("#address2");
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


                const placeName = place.name;
                document.getElementById("placeNameDisplay").innerText = placeName;

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
                address2Field.focus();
            }

            window.initAutocomplete = initAutocomplete;
        </script>
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFIRKxfoGWp8fdtj6KYN7ZlpcuAIEmqiQ&callback=initAutocomplete&libraries=places">
        </script>
    </form>


</x-layouts.app>
