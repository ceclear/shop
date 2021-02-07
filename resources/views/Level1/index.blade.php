<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="no-cache">
    <title>一年级</title>
    <link href="/assets/dialog/dist/dialog.css" rel="stylesheet">
</head>
<!-- Styles -->
<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 600;
        height: 100vh;

    }

    table.gridtable {
        font-family: verdana, arial, sans-serif;
        font-size: 28px;
        color: #333333;
        border-width: 1px;
        border-color: #666666;
        border-collapse: collapse;
    }

    table.gridtable th {
        border-width: 1px;
        padding: 3px 3px;
        border-style: solid;
        border-color: #666666;
        background-color: #dedede;
    }

    table.gridtable td {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #666666;
        background-color: #ffffff;
        text-align: center;
    }

    .answer-input {
        padding: 8px;
    }
</style>
</head>
<body>
<form method="post" action="{{url('level1/submit')}}">
    <div id="form_div" style="display: none">
        <div style="margin: auto;width: 900px;">
            <table class="gridtable">
                <tr>
                    <th>题目</th>
                    <th>答案</th>
                    <th>题目</th>
                    <th>答案</th>
                </tr>
                @if(!empty($list))
                    @foreach($list as $item)
                        <tr>
                            @foreach($item as $value)

                                <td>{{$value['key_str']}}</td>
                                <td><input type="text" autocomplete="off" name="val_{{$value['key_str']}}"
                                           value=""
                                           class="answer-input"><input type="hidden" name="hi_{{$value['key_str']}}"
                                                                       value="{{$value['val']}}"></td>

                            @endforeach
                        </tr>
                    @endforeach
                @endif

            </table>
        </div>
        <div style="margin:20px auto;width: 400px;text-align: center">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="start_time" name="start_time" value="{{ $start_time }}">
            <input type="submit" value="提交" style="font-size: 18px;font-weight: bold;width: 160px">
        </div>
    </div>
</form>
<script src="assets/js/jQuery-2.1.4.min.js"></script>
{{--<script src="assets/js/layer.js"></script>--}}
<script src="assets/js/coco-message.js"></script>
<script src="assets/js/common.js"></script>
<script src="/assets/dialog/dist/mDialogMin.js"></script>
<script>
    $(function () {
        if (localStorage.getItem('token')) {
            $('#form_div').css('display', '');
            return;
        }
        login();
    })

    function login() {
        Dialog.close();
        let html = '<input type="text" placeholder="请输入用户名" autocomplete="off" id="username" style="margin:8px 0;width:100%;padding:11px 8px;font-size:15px; border:1px solid #999;"/>' +
            '<input type="password" placeholder="请输入密码"  autocomplete="off" id="password"  style="margin:8px 0;width:100%;padding:11px 8px;font-size:15px; border:1px solid #999;"/>' +
            '<a style="cursor: pointer" onclick="reg();">没有账号?去注册</a>';
        Dialog.init(html, {
            title: '请登录',
            button: {
                登录: function () {
                    let username = this.querySelector('#username').value;
                    let password = this.querySelector('#password').value;
                    if (username.length == 0 || password.length == 0) {
                        Dialog.init('请输入用户名或密码！', 1500);
                        return;
                    }
                    let that = this;

                    $.post("{{route('api.login')}}", {
                        username: username,
                        password: password,
                        _token: '{{csrf_token()}}'
                    }, function (data) {
                        if (data.code != 0) {
                            Dialog.init(data.message, 2000);
                            return;
                        }
                        loadingShow(1000);
                        localStorage.setItem('token', data.data)
                        Dialog.close(that);
                        setTimeout(function () {
                            $('#form_div').css('display', '');
                        }, 1000)

                    })

                },
                关闭: function () {
                    // Dialog.init('你取消了登录,将无法继续',2000);
                    document.body.style.textAlign = 'center';
                    document.body.style.position = 'absolute';
                    document.body.style.left = '45%';
                    document.body.style.top = '45%';
                    document.body.innerHTML = '无法加载题目,原因：你取消了登录。<a href="javascript:location.reload()">刷新</a>即可从新验证'
                    Dialog.close(this);
                }
            },
            maskClick: false
        });
    }

    function reg() {
        Dialog.close();
        let html = '<input type="text" placeholder="请输入昵称"  autocomplete="off" id="reg_nickname"  style="margin:8px 0;width:100%;padding:11px 8px;font-size:15px; border:1px solid #999;"/>' +
            '<input type="text" placeholder="请输入邮箱"  autocomplete="off" id="email"  style="margin:8px 0;width:100%;padding:11px 8px;font-size:15px; border:1px solid #999;"/>' +
            '<input type="password" placeholder="请输入密码"   autocomplete="off" id="reg_password" style="margin:8px 0;width:100%;padding:11px 8px;font-size:15px; border:1px solid #999;"/>' +
            '<input type="password" placeholder="确认密码"   autocomplete="off" id="password_confirmation" style="margin:8px 0;width:100%;padding:11px 8px;font-size:15px; border:1px solid #999;"/>' +
            '<a style="cursor: pointer" onclick="login();">已有账号?去登录</a>';
        Dialog.init(html, {
            title: '注册',
            button: {
                注册: function () {
                    let email = this.querySelector('#email').value;
                    let password = this.querySelector('#reg_password').value;
                    let password_confirmation = this.querySelector('#password_confirmation').value;
                    let nickname = this.querySelector('#reg_nickname').value;
                    $.post("{{route('api.register')}}", {
                        password: password,
                        password_confirmation: password_confirmation,
                        email: email,
                        nickname:nickname,
                        _token: '{{csrf_token()}}'
                    }, function (data) {
                        if (data.code != 0) {
                            Dialog.init(data.message, 2000);
                            return;
                        }
                        Dialog.init(data.message)
                        setTimeout(login,2000)

                    })

                },
                关闭: function () {
                    // Dialog.init('你取消了登录,将无法继续',2000);
                    login();
                    Dialog.close(this);
                }
            },
            maskClick: false
        });
    }
</script>
</body>
</html>
