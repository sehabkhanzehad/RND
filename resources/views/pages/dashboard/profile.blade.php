@extends('layouts.dashborad.master')
@section('content')
    @include('components.dashboard.profile-form')
@endsection




@section('script')
    <script>
        getUserDetails();
        
        async function getUserDetails() {
            showLoader();
            const response = await axios.get("{{ route('user.details') }}");
            hideLoader();

            if (response.data.status == "success") {
                document.getElementById('name').value = response.data.data.name;
                document.getElementById('email').value = response.data.data.email;
            } else {
                errorToast(response.data.message);
            }
        }


        async function updateInfo() {

            // let email = document.getElementById('email').value;
            let name = document.getElementById('name').value;


            if (email == "" && name == "") {
                errorToast("Please enter your information");
            } else if (email == "") {
                errorToast("Please enter your email.");
            } else if (name == "") {
                errorToast("Please enter your name.");
            } else {
                showLoader();
                const response = await axios.post("{{ route('profile.update.info') }}", {
                    name: name,
                });
                hideLoader();

                if (response.data.status == "success") {
                    successToast(response.data.message);
                    await getUserDetails();
                } else {
                    errorToast(response.data.message);
                }
            }
        }
    </script>
@endsection
