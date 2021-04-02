@extends("layouts.main")
@section('title','笑话大全')
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
                            <li>笑话大全</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="blog-details-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-blog mt-50">
                        {{--                        <div class="blog-image mb-30">--}}
                        {{--                            <a><img src="{{$info['image']}}" alt="" class="img-fluid"></a>--}}
                        {{--                        </div>--}}
                        <div class="blog-content">
                            <h5 class="last-title mb-20">{{$info['title']}}</h5>
                            <ul class="meta">
                                <li>
                                    <i class="fa fa-calendar"></i><a>{{date("M d,Y",strtotime($info['created_at']))}}</a>
                                </li>
                            </ul>
                            <div class="desc">
                                {!! $info['content'] !!}
                            </div>
                            <div class="desc-content">

                                <div style="display: none !important;" class="social_sharing d-flex">
                                    <h5>share this post:</h5>
                                    <ul>
                                        <li><a href="#" title="facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" title="twitter"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" title="pinterest"><i class="fa fa-pinterest"></i></a></li>
                                        <li><a href="#" title="google+"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#" title="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div style="text-align: center">
                            <a id="joke" class="btn-secondary">下一个</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#joke').bind('click', function () {
                window.location.reload();
            })
        })
    </script>
@endsection
