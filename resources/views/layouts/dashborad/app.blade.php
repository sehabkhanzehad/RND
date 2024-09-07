{{-- This layout for login & register page --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>
    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('assets') }}/dashboard/vendors/core/core.css">
    <!-- endinject -->

    <!-- plugin css for this page -->
    <!-- end plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets') }}/dashboard/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/dashboard/vendors/flag-icon-css/css/flag-icon.min.css">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets') }}/dashboard/css/demo_1/style.css">
    <!-- End layout styles -->

    <!-- include css -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/include/progress.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/include/toastify.min.css') }}">

    <link rel="shortcut icon" href="{{ asset('assets') }}/dashboard/images/favicon.png" />
</head>

<body>
    <!-- progress bar -->
    <div id="loader" class="LoadingOverlay d-none">
        <div class="Line-Progress">
            <div class="indeterminate"></div>
        </div>
    </div>

    <!-- content -->
    @yield('content')

    <!-- script -->

    <!-- include js -->
    <script src="{{ asset('assets/dashboard/js/include/config.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/include/axios.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/include/toastify-js.js') }}"></script>
    @yield('script')

    <!-- core:js -->
    <script src="{{ asset('assets') }}/dashboard/vendors/core/core.js"></script>
    <!-- endinject -->

    <!-- plugin js for this page -->
    <!-- end plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('assets') }}/dashboard/vendors/feather-icons/feather.min.js"></script>
    <script src="{{ asset('assets') }}/dashboard/js/template.js"></script>
    <!-- endinject -->

    <!-- custom js for this page -->
    <!-- end custom js for this page -->

</body>

</html>
