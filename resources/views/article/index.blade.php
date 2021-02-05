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
                                            <a href="{{route('article.detail',['id'=>$item['id']])}}"><img
                                                    src="{{$item['image']}}"
                                                    alt="" class="img-fluid"></a>
                                        </div>
                                        <div class="blog-content">
                                            <ul class="meta">
                                                <li><i class="fa fa-calendar"></i><a
                                                    >{{date("M d,Y",strtotime($item['created_at']))}}</a>
                                                </li>
                                                <li><i class="fa fa-user-circle"></i> Posts by : {{$item['author']}}
                                                </li>
                                                <li><i class="fa fa-folder-open"></i><a
                                                        href="{{route('article.list',['cat'=>$item['catInfo']['name']])}}"> {{$item['catInfo']['name']}}</a>
                                                </li>
                                            </ul>
                                            <h5 class="title"><a
                                                    href="{{route('article.detail',['id'=>$item['id']])}}">{{$item['title']}}</a>
                                            </h5>
                                            <div class="desc">
                                                <p>{!! str_limit($item['content'],100) !!}</p>
                                            </div>
                                            <a href="{{route('article.detail',['id'=>$item['id']])}}" class="link">Read
                                                More</a>
                                        </div>
                                    </div>
                                    <!-- Single Blog End -->
                                </div>
                            @endforeach
                        @endif
                    </div>

                    @if(!empty($lists) && $lists->lastPage() !=1)
                        <div class="toolbar-shop toolbar-bottom">
                            {{--                        <div class="page-amount">--}}
                            {{--                            <p>Showing 1-8 of 20 results</p>--}}
                            {{--                        </div>--}}
                            {{--                        <div class="pagination">--}}
                            {{--                            <ul>--}}
                            {{--                                <li class="previous"><a href="#"><i class="fa fa-angle-left"></i> Previous</a></li>--}}
                            {{--                                <li class="current">1</li>--}}
                            {{--                                <li><a href="#">2</a></li>--}}
                            {{--                                <li><a href="#">3</a></li>--}}
                            {{--                                <li class="next"><a href="#">Next <i class="fa fa-angle-right"></i></a></li>--}}
                            {{--                            </ul>--}}
                            {{--                        </div>--}}
                            {{$lists->links()}}
                        </div>
                    @endif
                </div>

                <div class="col-lg-3 order-lg-1">
                    <div class="widget-sidebar margin-blog">
                        <div class="widget-search">
                            <div class="sidebar-title">
                                <h4 class="title-shop">搜索</h4>
                            </div>
                            <div class="category-search">
                                <input class="search-hear" placeholder="想搜索点啥......" type="text">
                                <a class="srch-btn" href="#"><i class="zmdi zmdi-search"></i></a>
                            </div>
                        </div>
                        <div class="widget-thumb mt-30">
                            <div class="sidebar-title">
                                <h4 class="title-shop">最新发表</h4>
                            </div>
                            <div class="thumb-wrapper">
                                @if(!empty($recentLists))
                                    @foreach($recentLists as $item)
                                        <div class="single-blog-thumb d-flex">
                                            <div class="blog-thumb">
                                                <a href="blog-details-fullwidth.html"><img
                                                        src="{{$item['image']}}" width="100" height="66" alt=""></a>
                                            </div>
                                            <div class="blog-info">
                                                <h5 class="info-title"><a href="blog-details-fullwidth.html"
                                                                          title="{{$item['title']}}">{{str_limit($item['title'],8)}}</a>
                                                </h5>
                                                <span>{{date("M d,Y",strtotime($item['created_at']))}}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="widget_list widget_categories mt-30">
                            <div class="sidebar-title">
                                <h4 class="title-shop">分类</h4>
                            </div>
                            <ul>
                                @if(!empty($catLists))
                                    @foreach($catLists as $item)
                                        <li>
                                            {{--                                            <input type="checkbox">--}}
                                            <a href="{{route('article.list',['cat'=>$item['name']])}}"
                                               title="{{$item['name']}}">{{$item['name']}}</a>
                                            <span class="checkmark"></span>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="widget-tag mt-30">
                            <div class="sidebar-title">
                                <h4 class="title-shop">最近发表人</h4>
                            </div>
                            <div class="tag-widget">
                                <ul>
                                    @if(!empty($recentAuthor))
                                        @foreach($recentAuthor as $item)
                                            <li>
                                                <a href="{{route('article.list',['author'=>$item['author']])}}">{{$item['author']}}</a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="banner-area">
                            <div class="single-banner mt-30 mb-20 text-center">
                                <a href="#"><img src="/assets/images/banner/shop-banner-2.jpg" alt="" class="img-fluid"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
