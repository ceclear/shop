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
                                <h1><a href="/">首页</a></h1>
                            </li>
                            <li>登录</li>
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
                            <h1 class="last-title mb-30 text-center">登录你的账号</h1>
                            <div class="form_group col-12">
                                <label class="form-label">邮箱<span>*</span></label>
                                <input class="input-form" type="text" data-tip="username" name="username">
                            </div>
                            <div class="form_group col-12 position-relative">
                                <label class="form-label">密码 <span>*</span></label>
                                <input class="input-form input-login" data-tip="password"  type="password" name="password">
                                <a style="color: white" onclick="show_pass(1)" class="show-btn">Show</a>
                            </div>
                            <div class="form_group group_3 col-lg-3">
                                <button class="login-register" type="button" id="login">Login</button>
                            </div>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
{{--                            <div class="form_group group_3 col-lg-9">--}}
{{--                                <label for="remember_box">--}}
{{--                                    <input id="remember_box" type="checkbox">--}}
{{--                                    <span> Remember me </span>--}}
{{--                                </label>--}}
{{--                            </div>--}}
                            <div class="col-lg-12 text-left">
                                <a class="lost-password" href="#">忘记密码?</a>
                            </div>
                            <div class="col-lg-12 text-left">
                                <p class="register-page"> 没有账号? <a href="/member/register.html">去注册</a>.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let pass = document.getElementsByName('password');
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
