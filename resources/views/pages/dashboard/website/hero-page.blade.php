@extends('layouts.dashborad.master')
@section('content')
    @include('components.dashboard.hero.data')
@endsection
@section('script')
    <script>
        getData();

        async function getData() {
            showLoader();
            const response = await axios.get("{{ route('hero.data') }}");
            hideLoader();

            if (response.data.status == "success") {
                document.getElementById('blah1').src = response.data.data.background_image;
                document.getElementById('blah2').src = response.data.data.hover_image;
                document.getElementById('title').value = response.data.data.title;
                document.getElementById('description').value = response.data.data.description;
            } else {
                errorToast("Something went wrong.");
            }
        }

        async function updateBackground() {
            let background_image = document.getElementById('background_iamge').files[0];
            let hover_image = document.getElementById('hover_image').files[0];

            if (!background_image && !hover_image) {
                errorToast("Please select at least one image.");
            } else {
                const formData = new FormData();
                formData.append('background_image', background_image);
                formData.append('hover_image', hover_image);

                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                showLoader();
                try {
                    const response = await axios.post("{{ route('hero.background') }}", formData, config);
                    hideLoader();
                    if (response.data.status == "success") {
                        await getData();
                        document.getElementById('background_iamge').value = "";
                        document.getElementById('hover_image').value = "";
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

        async function updateContent() {
            let title = document.getElementById('title').value;
            let description = document.getElementById('description').value;

            if (title == "" || description == "") {
                errorToast("Please fill all the fields.");
            } else {
                showLoader();
                try {
                    const response = await axios.post("{{ route('hero.content') }}", {
                        title: title,
                        description: description
                    });
                    hideLoader();
                    if (response.data.status == "success") {
                        await getData();
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
