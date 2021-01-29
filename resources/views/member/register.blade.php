@extends("layouts.main")
@section('title','注册')
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
                            <li>Register</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="register-area login-area mt-25">
        <div class="container">
            <div class="row">
                <div class="offset-lg-3 col-lg-6">
                    <div class="checkout_info mb-20">
                        <form id="reg_form" class="form-row">
                            <h5 class="last-title mb-10 text-center">Creat New Account</h5>
                            <div class="col-lg-12 text-left mb-20">
                                <p class="register-page"> Already have an account? <a href="login.html">Log in
                                        instead!</a></p>
                            </div>
                            <div class="form_group col-12">
                                <label class="form-label">First Name <span>*</span></label>
                                <input class="input-form" data-tip="first name" required name="first_name" type="text">
                            </div>
                            <div class="form_group col-12">
                                <label class="form-label">Last Name <span>*</span></label>
                                <input class="input-form" data-tip="last name" required name="last_name" type="text">
                            </div>
                            <div class="form_group col-12">
                                <label class="form-label">Email Address <span>*</span></label>
                                <input class="input-form" data-tip="email" name="email" type="email" required>
                            </div>

                            <div class="form_group col-12">
                                <label class="form-label">Password <span>*</span></label>
                                <input class="input-form input-login" data-tip="password" name="password" required
                                       type="password">
                                <button class="show-btn">Show</button>
                            </div>
                            <div class="form_group col-12">
                                <label class="form-label">Confirm Password <span>*</span></label>
                                <input class="input-form input-login" data-tip="confirm password" required
                                       name="password_confirmation" type="password">
                                <button class="show-btn">Show</button>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-12">
                                    <div class="form-check">
                                        <div class="custom-checkbox">
                                            <input class="form-check-input" type="checkbox" id="agree-condition">
                                            <span class="checkmark"></span>
                                            <label class="form-check-label" for="agree-condition">Receive Offers From
                                                Our Partners</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <div class="form-check">
                                        <div class="custom-checkbox">
                                            <input class="form-check-input" type="checkbox" id="agree-condition-2">
                                            <span class="checkmark"></span>
                                            <label class="form-check-label" for="agree-condition-2">Sign Up For Our
                                                Newsletter <br> Subscribe To Our Newsletters Now And Stay Up-To-Date
                                                With New Collections, The Latest Lookbooks And Exclusive
                                                Offers..</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-row mt-20">
                                <input type="button" style="cursor: pointer" class="btn-secondary" id="reg"
                                       value="Register">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#reg").click(function (e) {
            let formData = formToJson($("#reg_form"));
            validateRequire($(".input-form"));
            ajax(
                {
                    'data': formData,
                    'url': 'register_submit',
                    'type': 'post',
                    'dataType':'json'
                }
            )
        });
    </script>
@endsection
