@extends("layouts.main")
@section('title','联系我们')
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
                            <li>联系我们</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="contact-page-map mt-50">--}}
{{--        <!-- Google Map Start -->--}}
{{--        <div class="container">--}}
{{--            <div class="google-map">--}}
{{--                <iframe class="contact-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.9772263135424!2d-122.4022085487543!3d37.76713217966151!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80857def0232b13f%3A0x9026f3d4985937e9!2sCalifornia%20College%20of%20the%20Arts%20(CCA)!5e0!3m2!1sen!2sbd!4v1586673392151!5m2!1sen!2sbd" aria-hidden="false" tabindex="0"></iframe>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- Google Map End -->--}}
{{--    </div>--}}
    <div class="contact-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mt-40">
                    <div class="contact-address">
                        <div class="address-title">
                            <h3 class="last-title mb-20">Contact Us</h3>
                        </div>
                        <div class="contact-message">
                            <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram anteposuerit litterarum formas human. qui sequitur mutationem consuetudium lectorum. Mirum est notare quam</p>
                            <ul>
                                <li><i class="fa fa-fax"></i> 地址 : 九龙坡区谢家湾正街56号</li>
                                <li><i class="fa fa-phone"></i> <a >594652523@qq.com</a></li>
                                <li><i class="fa fa-envelope-o"></i><a>(800) 123 456 789</a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 contact-margin mb-20">
                    <div class="contact-information">
                        <form class="form-row" action="assets/php/contact-mail.php" id="contact-form" method="post">
                            <div class="information-title">
                                <h3 class="last-title mb-20">合作联系</h3>
                            </div>
                            <div class="form_group col-12">
                                <label class="form-label">称呼 <span>*</span></label>
                                <input class="input-form" type="text" placeholder="你的称呼" autocomplete="off" name="name">
                            </div>
                            <div class="form_group col-12">
                                <label class="form-label">邮箱<span>*</span></label>
                                <input class="input-form" type="email" placeholder="邮箱" autocomplete="off" name="email">
                            </div>
                            <div class="form_group mb-0 col-12">
                                <label class="form-label" for="order-note">Your Message <span>*</span></label>
                                <textarea class="form-textarea" id="order-note" name="message"></textarea>
                            </div>
                            <div class="form_group mt-20 mb-0 col-12">
                                <button type="submit" class="btn-secondary">提交</button>
                            </div>
                        </form>
                        <p class="form-message"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
