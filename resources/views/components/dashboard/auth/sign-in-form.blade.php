<div class="main-wrapper">
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">

            <div class="container">
                <div class="col-md-4 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <a href="#" class="noble-ui-logo d-block mb-2 text-center">RND<span>GlobalNest</span></a>
                            <h5 class="text-muted font-weight-normal mb-4 text-center">Welcome back! Sign in to your
                                account.</h5>
                            <form class="forms-sample">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email">
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
                                    <button class="btn btn-primary btn-block mr-2 mb-2 mb-md-0 text-white" type="button"
                                        onclick="login()">Sign In</button>

                                    {{-- <button type="button" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                                        <i class="btn-icon-prepend" data-feather="facebook"></i>
                                        Sign in with facebook
                                    </button> --}}
                                </div>
                                {{-- <a href="register.html" class="d-block mt-3 text-muted">Not a user? Sign
                                        up</a> --}}
                                <a href="{{ route('user.send-otp') }}" class="d-block mt-3 text-primary text-center">Forgotten
                                    password?</a>
                            </form>

                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
