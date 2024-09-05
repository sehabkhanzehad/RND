@extends('layouts.dashborad.master')
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Website</a></li>
            <li class="breadcrumb-item active" aria-current="page">About Us</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Update About Us</h6>
                    {{-- <form class="forms-sample"> --}}
                        <div class="form-group">
                            <label>Video Link</label>
                            <input id="video_link" value="" type="text" name="video_link" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input id="image" type="file" name="image"
                                onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])"
                                class="form-control">
                            <div class="my-3">
                                <img src="" id="blah1" width="100" alt="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id ="description" class="form-control" style="font-size: px; text-align: justify;" name="description"
                                rows="6"></textarea>
                        </div>

                        <button onclick="upadteAbout()" type="submit" class="btn btn-primary mr-2">Update</button>
                    {{-- </form> --}}
                </div>
            </div>
        </div>

        {{-- <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Update Video</h6>

                    <form class="forms-sample" action="" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Video Link</label>
                            <input id="uploadBanner" style="color: red; font-size: 20px" value=""
                                type="text" name="title" class="form-control">
                        </div>

                        <div class="form-group">
                            <input id="" type="file" name="image1"
                                onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])"
                                class="form-control">
                            <div class="my-3">
                                <img src="{{ asset('uploads/dashboard/website/features') }}/{{ App\Models\FeaturesOne::first()->image1 }}"
                                    id="blah1" width="100" alt="">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Done</button>

                    </form>
                </div>
            </div>
        </div> --}}
        {{--
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Update Image-2</h6>
                    @if (session('image2Updated'))
                        <div class="alert alert-success">{{ session('image2Updated') }}</div>
                    @endif

                    <form class="forms-sample" action="{{ route('feature1.image2') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <input id="" type="file" name="image2"
                                onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])"
                                class="form-control">
                            @error('image2')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="my-3">
                                <img src="{{ asset('uploads/dashboard/website/features') }}/{{ App\Models\FeaturesOne::first()->image2 }}"
                                    id="blah2" width="100" alt="">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Done</button>

                    </form>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
@section('script')
    <script>
        getAboutUs();

        async function getAboutUs() {
            showLoader();
            const response = await axios.get("{{ route('about-us.data') }}");
            hideLoader();

            if (response.data.status == "success") {
                document.getElementById('video_link').value = response.data.data.video_link;
                document.getElementById('description').value = response.data.data.description;
                document.getElementById('blah1').src = response.data.data.image;
            } else {
                errorToast(response.data.message);
            }
        }




        async function upadteAbout() {
            let videoLink = document.getElementById('video_link').value;
            let image = document.getElementById('image').files[0];
            let description = document.getElementById('description').value;


            if (videoLink == "" && !image && description == "") {
                errorToast("Please enter any one field.");
            } else if (videoLink == "") {
                errorToast("Please enter video link.");
            } else if (!image) {
                errorToast("Please select an image.");
            } else if (description == "") {
                errorToast("Please enter a description.");
            } else {

                let formData = new FormData();
                formData.append('video_link', videoLink);
                formData.append('image', image);
                formData.append('description', description);

                let config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                    },
                }


                showLoader();
                const response = await axios.post("{{ route('about-us.update') }}", formData, config);
                hideLoader();

                if (response.data.status == "success") {
                    await getAboutUs();
                    successToast(response.data.message);
                } else {
                    errorToast(response.data.message);
                }
            }
        }
    </script>
@endsection
