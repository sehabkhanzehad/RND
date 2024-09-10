@extends('layouts.dashborad.master')
@section('content')
    @include('components.dashboard.contact.data')
@endsection
@section('script')
    <script>
        getData();
        async function getData() {
            showLoader();
            let url = "{{ route('contact.data') }}";
            let response = await axios.get(url);
            hideLoader();

            if (response.data.status == "success") {
                document.getElementById('address').value = response.data.data.address;
                document.getElementById('phone').value = response.data.data.phone;
                document.getElementById('email').value = response.data.data.email;
                document.getElementById('map').value = response.data.data.map;
            } else {
                errorToast("Something went wrong.");
            }
        }


        async function updateContact() {
            let address = document.getElementById('address').value;
            let phone = document.getElementById('phone').value;
            let email = document.getElementById('email').value;
            let map = document.getElementById('map').value;

            if (!address || !phone || !email || !map) {
                errorToast("All fields are required.");
            } else {
                let url = "{{ route('contact.update') }}";
                let data = {
                    address: address,
                    phone: phone,
                    email: email,
                    map: map
                };
                showLoader();
                try {
                    let response = await axios.post(url, data);
                    hideLoader();

                    if (response.data.status == "success") {
                        successToast(response.data.message);
                    } else {
                        errorToast(response.data.message);
                    }
                } catch (error) {
                    hideLoader();
                    errorToast("Something went wrong!");
                }
            }

        }
    </script>
@endsection
