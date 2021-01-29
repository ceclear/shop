@extends("layouts.main")
@section('title','登录')
@section("content")
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li>
                                <h1><a href="index.html">Home</a></h1>
                            </li>
                            <li>Login</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="login-area mt-25">
        <div class="container">
            <div class="row">
                <div class="offset-lg-3 col-lg-6">
                    <div class="checkout_info mb-20">
                        <form class="form-row"  id="login_form">
                            <h1 class="last-title mb-30 text-center">Login to Your Account</h1>
                            <div class="form_group col-12">
                                <label class="form-label">Username or email <span>*</span></label>
                                <input class="input-form" type="text" data-tip="username" name="username">
                            </div>
                            <div class="form_group col-12 position-relative">
                                <label class="form-label">Password <span>*</span></label>
                                <input class="input-form input-login" data-tip="password"  type="password" name="password">
                                <button class="show-btn">Show</button>
                            </div>
                            <div class="form_group group_3 col-lg-3">
                                <button class="login-register" type="button" id="login">Login</button>
                            </div>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form_group group_3 col-lg-9">
                                <label for="remember_box">
                                    <input id="remember_box" type="checkbox">
                                    <span> Remember me </span>
                                </label>
                            </div>
                            <div class="col-lg-12 text-left">
                                <a class="lost-password" href="#">Lost your password?</a>
                            </div>
                            <div class="col-lg-12 text-left">
                                <p class="register-page"> No account? <a href="register.html">Create one here</a>.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#login").click(function (e) {
            let formData = formToJson($("#login_form"));
            validateRequire($(".input-form"));
            ajax(
                {
                    'data': formData,
                    'url': 'login_submit',
                    'type': 'post',
                    'dataType':'json'
                }
            )
        });
    </script>
@endsection
