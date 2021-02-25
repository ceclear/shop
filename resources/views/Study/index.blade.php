@extends("layouts.main")
@section('title','作业')
@section("content")
    <style>
        .step_div {
            width: 7%;
            float: left;
        }

        .step_div > label {
            margin-left: 10px;
        }

        .op_div {
            width: 15%;
            float: left;
        }

    </style>
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li>
                                <h1><a href="/">首页</a></h1>
                            </li>
                            <li>作业</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-account-area mt-50">
        <div class="container">
            @if(count($errors->all())>0)
                <div style="background: #ff8f8f;line-height: 40px;height: 40px;text-align: center;margin-bottom: 20px">
                    {{$errors->first()}}
                </div>
            @endif
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-2">
                    <ul class="nav flex-column dashboard-list mb-20 role=" tablist
                    ">
                    <li><a class="nav-link active show" onclick="$('.btn-secondary').removeClass('active')"
                           data-toggle="tab" href="#dashboard">年级选择</a></li>
                    <li><a class="nav-link " data-toggle="tab" onclick="$('.btn-secondary').removeClass('active')"
                           href="#need-step">几步运算</a></li>
                    <li><a class="nav-link " data-toggle="tab" onclick="$('.btn-secondary').removeClass('active')"
                           href="#operation">运算符</a></li>
                    <li><a class="nav-link" data-toggle="tab" onclick="$('.btn-secondary').removeClass('active')"
                           href="#account-details">定义运算</a></li>
                    </ul>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-10">
                    <!-- Tab panes -->
                    <form action="{{route('study.detail')}}" method="post">
                        <div class="tab-content dashboard-content mb-20">

                            <div id="dashboard" class="tab-pane fade active show">
                                <h3 class="last-title">年级选择</h3>
                                <div class="checkout_info form-row">

                                    <div class="col-lg-12 text-left mb-20">
                                        <p class="register-page"> 还没有登录? <a href="{{route('member.login')}}">Log in!</a>
                                        </p>
                                    </div>

                                    <div class="form_group col-12 position-relative">
                                        <label class="form-label">请选择年级</label>
                                        <select id="level" name="level"
                                                class="niceselect-option nice-select select-option">

                                        </select>
                                    </div>

                                    <div class="form-row mt-20">
                                        <a href="#need-step" data-toggle="tab" class="btn-secondary">下一步</a>
                                    </div>

                                </div>
                            </div>
                            <div id="need-step" class="tab-pane fade">
                                <h3 class="last-title">选择几步运算</h3>
                                <div class="checkout_info form-row">

                                    <div class="form_group col-12 position-relative">
                                        <div class="step_div">
                                            <input type="radio" checked value="1" id="one" name="step"><label
                                                for="one">1步</label>
                                        </div>
                                        <div class="step_div">
                                            <input type="radio" value="2" id="two" name="step"><label
                                                for="two">2步</label>
                                        </div>
{{--                                        <div class="step_div">--}}
{{--                                            <input type="radio" value="3" id="three" name="step"><label--}}
{{--                                                for="three">3步</label>--}}
{{--                                        </div>--}}
                                    </div>
                                    <div class="form-row mt-20" style="margin-right: 10px;">
                                        <a href="#dashboard" data-toggle="tab" class="btn-secondary">上一步</a>
                                    </div>
                                    <div class="form-row mt-20">
                                        <a href="#operation" data-toggle="tab" class="btn-secondary">下一步</a>
                                    </div>

                                </div>
                            </div>
                            <div id="operation" class="tab-pane fade">
                                <h3 class="last-title">运算符选择</h3>
                                <div class="checkout_info form-row">
                                    <label>(选择多个将会随机生成操作运算)</label>
                                    <div class="form_group col-12 position-relative ">

                                        <div class="op_div">
                                            <input type="checkbox" value="1"  checked id="op_add" name="op_str[]">
                                            <label class="form-check-label"
                                                   for="op_add">加法(+)</label>
                                        </div>
                                        <div class="op_div">
                                            <input type="checkbox" value="2" checked id="op_desc" name="op_str[]">
                                            <label class="form-check-label"
                                                   for="op_desc">减法(-)</label>
                                        </div>
                                        <div class="op_div">
                                            <input type="checkbox" value="3" id="op_mul" name="op_str[]">
                                            <label class="form-check-label"
                                                   for="op_mul">乘法(×)</label>
                                        </div>
                                        <div class="op_div">
                                            <input type="checkbox" value="4" id="op_divi" name="op_str[]">
                                            <label class="form-check-label"
                                                   for="op_divi">除法(÷)</label>
                                        </div>
                                    </div>

                                    <div class="form-row mt-20" style="margin-right: 10px">
                                        <a href="#need-step" data-toggle="tab" class="btn-secondary">上一步</a>
                                    </div>
                                    <div class="form-row mt-20">
                                        <a href="#account-details" data-toggle="tab" class="btn-secondary">下一步</a>
                                    </div>

                                </div>
                            </div>
                            <div id="account-details" class="tab-pane fade">
                                <h3 class="last-title">定义运算(3+2-1=4,即第一算数项为3 第二算数项为2 第三算数项为1)</h3>
                                <div class="checkout_info form-row">
                                    <div class="form_group col-12  col-lg-6">
                                        <label class="form-label">第一算数项最小值<span>*</span></label>
                                        <input class="input-form" min="1"  name="first_op_min"
                                               onchange="if(parseInt($(this).val())<=0){$(this).val(1)}" value="1"
                                               type="number">
                                    </div>
                                    <div class="form_group col-12 col-lg-6">
                                        <label class="form-label">第一算数项最大值<span>*</span></label>
                                        <input class="input-form" min="2" name="first_op_max"
                                               onchange="if(parseInt($(this).val())<=0){$(this).val(20)}" value="20"
                                               type="number">
                                    </div>
                                    <div class="form_group col-12  col-lg-6">
                                        <label class="form-label">第二算数项最小值<span>*</span></label>
                                        <input class="input-form" min="2"  name="second_op_min"
                                               onchange="if(parseInt($(this).val())<=0){$(this).val(1)}" value="2"
                                               type="number">
                                    </div>
                                    <div class="form_group col-12 col-lg-6">
                                        <label class="form-label">第二算数项最大值<span>*</span></label>
                                        <input class="input-form" min="2" name="second_op_max"
                                               onchange="if(parseInt($(this).val())<=0){$(this).val(20)}" value="20"
                                               type="number">
                                    </div>

                                    <div class="form_group col-12  col-lg-6">
                                        <label class="form-label">第三算数项最小值<span>(两步运算时生效)</span></label>
                                        <input class="input-form" min="3"  name="third_op_min"
                                               onchange="if(parseInt($(this).val())<=0){$(this).val(1)}" value="3"
                                               type="number">
                                    </div>
                                    <div class="form_group col-12 col-lg-6">
                                        <label class="form-label">第三算数项最大值<span>(两步运算时生效)</span></label>
                                        <input class="input-form" min="2" name="third_op_max"
                                               onchange="if(parseInt($(this).val())<=0){$(this).val(20)}" value="20"
                                               type="number">
                                    </div>
                                    <div class="form_group col-12">
                                        <label class="form-label">题目总数<span>*</span></label>
                                        <input class="input-form" min="2" name="count"
                                               onchange="if(parseInt($(this).val())<=0){$(this).val(20)}" value="20"
                                               type="number">
                                    </div>
                                    <div class="form_group col-12">
                                        <label class="form-label">结果值小于等于<span>*</span></label>
                                        <input class="input-form" min="1" name="rel_min"
                                               onchange="if(parseInt($(this).val())<=0){$(this).val(1)}" value="20"
                                               type="number">
                                    </div>
                                    <div class="form-row mt-20">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="submit" class="btn-secondary" value="生成题目">
                                    </div>

                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            //加载年级列表
            ajax(
                {
                    'data': {},
                    'url': "{{route('study.level')}}",
                    'type': 'get',
                    'dataType': 'json',
                    'callback': 'f',
                    'func': function (res) {
                        let html, option, li = '';
                        if (res.data.list.length == 0) {
                            return false;
                        }
                        option += '<option value="">请选择</option>';
                        li += "<li class='option selected'>请选择</li>";
                        $('.current').html('请选择')
                        $.each(res.data.list, function (n, v) {
                            option += '<option value="' + v.val + '">' + v.title + '</option>';
                            li += '<li data-value="' + v.val + '" class="option">' + v.title + '</li>';
                        });
                        $('.list').append(li)
                        $("#level").append(option);
                    }
                }
            )
        });
        $('.btn-secondary').bind('click', function () {
            $('.btn-secondary').removeClass('active');
            console.log(document.getElementsByName('step'));
        })
        //tab-pane fade
    </script>
@endsection
