@extends("layouts.main")
@section('title','文章列表')
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
                            <li>文章列表</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="blog-grid-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-lg-2">
                    <div class="row mt-20 mb-20">
                        @if(!empty($lists))
                            @foreach($lists as $item)
                                <div class="col-lg-6 col-md-6">
                                    <!-- Single Blog Start -->
                                    <div class="single-blog mt-30">
                                        <div class="blog-image mb-30">
                                            <a href="blog-details.html"><img src="{{$item['image']}}"
                                                                             alt="" class="img-fluid"></a>
                                        </div>
                                        <div class="blog-content">
                                            <ul class="meta">
                                                <li><i class="fa fa-calendar"></i><a href="#">{{date("M d,Y",strtotime($item['created_at']))}}</a></li>
                                                <li><i class="fa fa-user-circle"></i> Posts by : {{$item['author']}}</li>
                                                <li><i class="fa fa-folder-open"></i><a href="#"> {{$item['cat_info']['name']}}</a></li>
                                            </ul>
                                            <h5 class="title"><a href="blog-details.html">{{$item['title']}}</a></h5>
                                            <div class="desc">
                                                <p>{{$item['content']}}</p>
                                            </div>
                                            <a href="blog-details.html" class="link">Read More</a>
                                        </div>
                                    </div>
                                    <!-- Single Blog End -->
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <!-- Blog Toolbar Start -->
                    <div class="toolbar-shop toolbar-bottom">
                        <div class="page-amount">
                            <p>Showing 1-8 of 20 results</p>
                        </div>
                        <div class="pagination">
                            <ul>
                                <li class="previous"><a href="#"><i class="fa fa-angle-left"></i> Previous</a></li>
                                <li class="current">1</li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li class="next"><a href="#">Next <i class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Blog Toolbar End -->
                </div>

                <div class="col-lg-3 order-lg-1">
                    <div class="widget-sidebar margin-blog">
                        <div class="widget-search">
                            <div class="sidebar-title">
                                <h4 class="title-shop">Search</h4>
                            </div>
                            <div class="category-search">
                                <input class="search-hear" placeholder="Search......" type="text">
                                <a class="srch-btn" href="#"><i class="zmdi zmdi-search"></i></a>
                            </div>
                        </div>
                        <div class="widget-thumb mt-30">
                            <div class="sidebar-title">
                                <h4 class="title-shop">Recent Post</h4>
                            </div>
                            <div class="thumb-wrapper">
                                <!-- Single Blog Thumb Start -->
                                <div class="single-blog-thumb d-flex">
                                    <div class="blog-thumb">
                                        <a href="blog-details-fullwidth.html"><img
                                                src="assets/images/blog/widget/blog-thumb-1.jpg" alt=""></a>
                                    </div>
                                    <div class="blog-info">
                                        <h5 class="info-title"><a href="blog-details-fullwidth.html">Blog image post</a>
                                        </h5>
                                        <span>March 16, 2020 </span>
                                    </div>
                                </div>
                                <!-- Single Blog Thumb End -->
                                <!-- Single Blog Thumb Start -->
                                <div class="single-blog-thumb d-flex">
                                    <div class="blog-thumb">
                                        <a href="blog-details-fullwidth.html"><img
                                                src="assets/images/blog/widget/blog-thumb-2.jpg" alt=""></a>
                                    </div>
                                    <div class="blog-info">
                                        <h5 class="info-title"><a href="blog-details-fullwidth.html">Blog Video</a></h5>
                                        <span>January 1, 2020 </span>
                                    </div>
                                </div>
                                <!-- Single Blog Thumb End -->
                                <!-- Single Blog Thumb Start -->
                                <div class="single-blog-thumb d-flex">
                                    <div class="blog-thumb">
                                        <a href="blog-details-fullwidth.html"><img
                                                src="assets/images/blog/widget/blog-thumb-3.jpg" alt=""></a>
                                    </div>
                                    <div class="blog-info">
                                        <h5 class="info-title"><a href="blog-details-fullwidth.html">Blog Gallery
                                                post</a></h5>
                                        <span>April 20, 2020 </span>
                                    </div>
                                </div>
                                <!-- Single Blog Thumb End -->
                                <!-- Single Blog Thumb Start -->
                                <div class="single-blog-thumb d-flex">
                                    <div class="blog-thumb">
                                        <a href="blog-details-fullwidth.html"><img
                                                src="assets/images/blog/widget/blog-thumb-4.jpg" alt=""></a>
                                    </div>
                                    <div class="blog-info">
                                        <h5 class="info-title"><a href="blog-details-fullwidth.html">Blog image post</a>
                                        </h5>
                                        <span>May 26, 2020 </span>
                                    </div>
                                </div>
                                <!-- Single Blog Thumb End -->
                            </div>
                        </div>
                        <div class="widget_list widget_categories mt-30">
                            <div class="sidebar-title">
                                <h4 class="title-shop">Categories</h4>
                            </div>
                            <ul>
                                <li>
                                    <input type="checkbox">
                                    <a href="#">Audio</a>
                                    <span class="checkmark"></span>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <a href="#">Video</a>
                                    <span class="checkmark"></span>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <a href="#">Gallery</a>
                                    <span class="checkmark"></span>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <a href="#">Images</a>
                                    <span class="checkmark"></span>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <a href="#">Categoryes</a>
                                    <span class="checkmark"></span>
                                </li>

                            </ul>
                        </div>
                        <div class="widget-tag mt-30">
                            <div class="sidebar-title">
                                <h4 class="title-shop">Recent Post</h4>
                            </div>
                            <div class="tag-widget">
                                <ul>
                                    <li><a href="#">Design</a></li>
                                    <li><a href="#">Fashion</a></li>
                                    <li><a href="#">Women</a></li>
                                    <li><a href="#">Accessories</a></li>
                                    <li><a href="#">Headphones</a></li>
                                    <li><a href="#">Watch</a></li>
                                    <li><a href="#">Shirts</a></li>
                                    <li><a href="#">Cables</a></li>
                                    <li><a href="#">Cameras</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="banner-area">
                            <div class="single-banner mt-30 mb-20 text-center">
                                <a href="#"><img src="assets/images/banner/shop-banner-2.jpg" alt="" class="img-fluid"></a>
                            </div>
                        </div>
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
                    'dataType': 'json'
                }
            )
        });
    </script>
@endsection
