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
                                <h1><a href="/">首页</a></h1>
                            </li>
                            <li>注册</li>
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
                            <h5 class="last-title mb-10 text-center">注册</h5>
                            <div class="col-lg-12 text-left mb-20">
                                <p class="register-page"> 已经有账号? <a href="/member/login.html">去登录!</a></p>
                            </div>
                            <div class="form_group col-12">
                                <label class="form-label">昵称<span>*</span></label>
                                <input class="input-form" data-tip="昵称" required name="name" type="text">
                            </div>
                            <div class="form_group col-12">
                                <label class="form-label">邮箱<span>*</span></label>
                                <input class="input-form" data-tip="邮件" name="email" type="email" required>
                            </div>

                            <div class="form_group col-12">
                                <label class="form-label">密码 <span>*</span></label>
                                <input class="input-form input-login" data-tip="密码" name="password" required
                                       type="password">
                                <a class="show-btn" style="color: white;" onclick="show_pass(1)">Show</a>
                            </div>
                            <div class="form_group col-12">
                                <label class="form-label">确认密码<span>*</span></label>
                                <input class="input-form input-login" data-tip="确认密码" required
                                       name="password_confirmation" type="password">
                                <a class="show-btn" style="color: white;" onclick="show_pass(2)">Show</a>
                            </div>

                            {{--                            <div class="form-row">--}}
                            {{--                                <div class="form-group col-12">--}}
                            {{--                                    <div class="form-check">--}}
                            {{--                                        <div class="custom-checkbox">--}}
                            {{--                                            <input class="form-check-input" type="checkbox" id="agree-condition">--}}
                            {{--                                            <span class="checkmark"></span>--}}
                            {{--                                            <label class="form-check-label" for="agree-condition">Receive Offers From--}}
                            {{--                                                Our Partners</label>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="form-row">--}}
                            {{--                                <div class="form-group col-12">--}}
                            {{--                                    <div class="form-check">--}}
                            {{--                                        <div class="custom-checkbox">--}}
                            {{--                                            <input class="form-check-input" type="checkbox" id="agree-condition-2">--}}
                            {{--                                            <span class="checkmark"></span>--}}
                            {{--                                            <label class="form-check-label" for="agree-condition-2">Sign Up For Our--}}
                            {{--                                                Newsletter <br> Subscribe To Our Newsletters Now And Stay Up-To-Date--}}
                            {{--                                                With New Collections, The Latest Lookbooks And Exclusive--}}
                            {{--                                                Offers..</label>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-row mt-20">
                                <input type="button" style="cursor: pointer" class="btn-secondary" id="reg"
                                       value="注册">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let pass = document.getElementsByName('password');
        let confirm_pass = document.getElementsByName('password_confirmation');
        function show_pass(n) {
            if (n == 1 && pass[0].type === 'password') {
                pass[0].type = 'text';
                setTimeout(function () {
                    pass[0].type = 'password';
                }, 2000)
            }
            if (n == 2 && confirm_pass[0].type === 'password') {
                confirm_pass[0].type = 'text';
                setTimeout(function () {
                    confirm_pass[0].type = 'password';
                }, 2000)
            }
        }

        $("#reg").click(function (e) {
            console.log(111)
            let formData = formToJson($("#reg_form"));
            if (validateRequire($(".input-form"))) {
                ajax(
                    {
                        'data': formData,
                        'url': 'register_submit',
                        'type': 'post',
                        'dataType': 'json'
                    }
                )
            }
        });
    </script>
@endsection
