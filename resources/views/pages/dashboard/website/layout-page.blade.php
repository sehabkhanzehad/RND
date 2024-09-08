@extends('layouts.dashborad.master')
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Website</a></li>
            <li class="breadcrumb-item active" aria-current="page">Layout</li>
        </ol>
    </nav>

    @include('components.dashboard.layout.data')
@endsection

@section('script')
    <script>
        getData();

        async function getData() {
            showLoader();
            const response = await axios.get("{{ route('layout.data') }}");
            hideLoader();

            if (response.data.status == "success") {
                document.getElementById('fav').src = response.data.data.favicon;
                document.getElementById('header0').src = response.data.data.header_logo;
                document.getElementById('footer0').src = response.data.data.footer_logo;
                document.getElementById('footer_text').value = response.data.data.footer_text;
                document.getElementById('twitter_link').value = response.data.data.twitter_link;
                document.getElementById('facebook_link').value = response.data.data.facebook_link;
                // document.getElementById('instagram_link').value = response.data.data.instagram_link;
                document.getElementById('linkedin_link').value = response.data.data.linkedin_link;
                document.getElementById('whatsapp_link').value = response.data.data.whatsapp_link;
            } else {
                errorToast(response.data.message);
            }
        }
        async function upadteFavicon() {
            let favicon = document.getElementById('favicon').files[0];

            if (!favicon) {
                errorToast("Please select a favicon.");
                return;
            } else {
                let formData = new FormData();
                formData.append('favicon', favicon);

                let config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                    },
                }

                showLoader();
                try {
                    const response = await axios.post("{{ route('layout.favicon') }}", formData, config);
                    hideLoader();
                    if (response.data.status == "success") {
                        await getData();
                        document.getElementById('favicon').value = "";
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

        async function updateSocial() {

            let twitterLink = document.getElementById('twitter_link').value;
            let facebookLink = document.getElementById('facebook_link').value;
            let whatsappLink = document.getElementById('whatsapp_link').value;
            let linkedinLink = document.getElementById('linkedin_link').value;
            let instagramLink = null;


            let formData = new FormData();
            formData.append('facebook_link', facebookLink);
            formData.append('whatsapp_link', whatsappLink);
            formData.append('linkedin_link', linkedinLink);
            formData.append('twitter_link', twitterLink);
            formData.append('instagram_link', instagramLink);

            let config = {
                headers: {
                    'content-type': 'multipart/form-data',
                },
            }

            showLoader();
            try {
                const response = await axios.post("{{ route('layout.social') }}", formData, config);
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
        async function updateHeaderLogo() {
            let headerLogo = document.getElementById('header_logo').files[0];
            if (!headerLogo) {
                errorToast("Please select an image.");
            } else {
                let formData = new FormData();
                formData.append('header_logo', headerLogo);

                let config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                    },
                }

                showLoader();
                try {
                    const response = await axios.post("{{ route('layout.header') }}", formData, config);
                    hideLoader();
                    if (response.data.status == "success") {
                        await getData();
                        document.getElementById('header_logo').value = "";
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

        async function upadteFooter() {
            let footerLogo = document.getElementById('footer_logo').files[0];
            let footerText = document.getElementById('footer_text').value;

            if (footerText == "") {
                errorToast("Please enter footer text.");
            } else {
                let formData = new FormData();
                formData.append('footer_logo', footerLogo);
                formData.append('footer_text', footerText);

                let config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                    },
                }
                showLoader();
                try {
                    const response = await axios.post("{{ route('layout.footer') }}", formData, config);
                    hideLoader();
                    if (response.data.status == "success") {
                        await getData();
                        document.getElementById('footer_logo').value = "";
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


        // async function upadteAbout() {
        //     let videoLink = document.getElementById('video_link').value;
        //     let image = document.getElementById('image').files[0];
        //     let description = document.getElementById('description').value;


        //     if (videoLink == "" && description == "") {
        //         errorToast("Please enter any one field.");
        //     } else if (videoLink == "") {
        //         errorToast("Please enter video link.");
        //     } else if (description == "") {
        //         errorToast("Please enter a description.");
        //     } else {

        //         let formData = new FormData();
        //         formData.append('video_link', videoLink);
        //         formData.append('image', image);
        //         formData.append('description', description);

        //         let config = {
        //             headers: {
        //                 'content-type': 'multipart/form-data',
        //             },
        //         }
        //         showLoader();
        //         try {
        //             const response = await axios.post("{{ route('about-us.update') }}", formData, config);
        //             hideLoader();
        //             if (response.data.status == "success") {
        //                 await getData();
        //                 successToast(response.data.message);
        //             } else {
        //                 errorToast(response.data.message);
        //             }
        //         } catch (err) {
        //             hideLoader();
        //             errorToast("Something wen't wrong. Please try again later.");
        //         }


        //     }
        // }
    </script>
@endsection
