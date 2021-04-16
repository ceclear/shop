@extends("layouts.main")
@section('title','淘女郎列表')
@section("content")
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li>
                                <h1><a href="{{route('index')}}">首页</a></h1>
                            </li>
                            <li>
                                <h1><a href="{{route('goods.shop')}}">淘女郎列表</a></h1>
                            </li>
                            @if(request('cid1')||request('cid2')||request('cid3'))
                                <li>
                                    <h1><a>{{request('name')}}</a></h1>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="shop-fullwidth-area mt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Shop Toolbar Start -->
                    <div class="toolbar-shop mb-50">
                        <div class="shop_toolbar_btn">
                            <button data-role="grid_4" class="btn-grid-4 active"></button>
                            <button data-role="grid_3" class="btn-grid-3"></button>
                        </div>
                        @if(request('type'))
                            <div class="page-amount">
                                <p>共计 {{$count}} 位</p>
                            </div>
                        @endif
                        <div>
                            <ul class="menu">
                                <li class="list"><a
                                        href="javascript:">@if(!empty(request('sort'))){{\App\Models\TaoGirl::Sort[request('sort')]}} @else
                                            排序 @endif</a>
                                    <ul class="items">
                                        @foreach($sort as $key=>$item)
                                            @if(empty(request()->query()))
                                                <li><a href="{{route('goods.tao_girl',['sort'=>$key])}}">{{$item}}</a></li>
                                            @else
                                                <li>
                                                    <a href="{{route('goods.tao_girl',array_merge(request()->query(),['sort'=>$key]))}}">{{$item}}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!----------排序end------>
                    </div>
                    <!-- Shop Toolbar End -->
                    <!-- Shop Wrapper Start -->
                    <div class="row shop-wrapper grid_4">
                        @if(!empty($list))
                            @foreach($list as $item)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-20">
                                    <!-- Single-Product-Start -->
                                    <div class="item-product pt-0">
                                        <div class="product-thumb" style="margin-right: 36px">
                                            <a href="{{route('goods.tao_girl_detail',['id'=>$item['id']])}}">
                                                <img src="{{$item['avatarUrl']}}" alt=""
                                                     class="img-fluid">
                                            </a>
                                            <div class="box-label">
                                                <div class="label-product-new">
                                                    <span>Hot</span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="product-caption">
                                            <div class="product-name">
                                                <a title="{{$item['title']}}"
                                                   href="{{route('goods.tao_girl_detail',['id'=>$item['id']])}}">{{str_limit($item['realName'],30)}}</a>
                                            </div>
                                            <div class="rating">
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                            </div>
                                            <div class="price-box">
                                                <span class="regular-price">粉丝数 {{$item['totalFanNum']}}</span>
                                                <span class="regular-price">城市 {{$item['city']}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single-Product-End -->
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <!-- Shop Wrapper End -->
                    <!-- Shop Toolbar Start -->
                    @if(!empty($list) && $list->lastPage() !=1)
                        <div class="toolbar-shop toolbar-bottom">
                            {{$list->links()}}
                        </div>
                @endif
                <!-- Shop Toolbar End -->
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" type="text/css" href="/assets/css/normalize2.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/css/accord.css"/>
    <script>
        var list = document.querySelectorAll('.list');

        function accordion(e) {
            e.stopPropagation();
            if (this.classList.contains('active')) {
                this.classList.remove('active');
            } else if (this.parentElement.parentElement.classList.contains('active')) {
                this.classList.add('active');
            } else {
                for (i = 0; i < list.length; i++) {
                    list[i].classList.remove('active');
                }
                this.classList.add('active');
            }
        }

        for (i = 0; i < list.length; i++) {
            list[i].addEventListener('click', accordion);
        }
    </script>
@endsection
