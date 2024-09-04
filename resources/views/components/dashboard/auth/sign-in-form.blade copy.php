<div class="main-wrapper">
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">

            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-8 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-4 pr-md-0">
                                <div class="auth-left-wrapper">

                                </div>
                            </div>
                            <div class="col-md-8 pl-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <a href="#" class="noble-ui-logo d-block mb-2">RND<span>GlobalNest</span></a>
                                    <h5 class="text-muted font-weight-normal mb-4">Welcome back! Log in to your
                                        account.</h5>
                                    <form class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" id="email"
                                                placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" id="password"
                                                autocomplete="current-password" placeholder="Password">
                                        </div>

                                        {{-- <div class="form-check form-check-flat form-check-primary">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input">
                                                Remember me
                                            </label>
                                        </div> --}}

                                        <div class="mt-3">
                                            <button class="btn btn-primary mr-2 mb-2 mb-md-0 text-white" type="button" onclick="login()">Login</button>
                                            {{-- <a href="../../dashboard-one.html"
                                                class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">Login</a> --}}
                                            <button type="button"
                                                class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                                                <i class="btn-icon-prepend" data-feather="facebook"></i>
                                                Login with facebook
                                            </button>
                                        </div>
                                        {{-- <a href="register.html" class="d-block mt-3 text-muted">Not a user? Sign
                                            up</a> --}}
                                        <a href="{{ route("user.send-otp") }}" class="d-block mt-3 text-primary">Forgotten password?</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
