@extends("layouts.main")
@section('title','商品列表')
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
                                <h1><a href="{{route('goods.shop')}}">商品列表</a></h1>
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
                            <button data-role="grid_list" class="btn-list"></button>
                        </div>
                        @if(request('cid1')||request('cid2')||request('cid3'))
                            <div class="page-amount">
                                <p>共计 {{$count}} 商品</p>
                            </div>
                        @endif
                        <div>
                            <ul class="menu">
                                <li class="list"><a href="javascript:">@if(!empty(request('sort'))){{\App\Models\Goods::Sort[request('sort')]}} @else 排序 @endif</a>
                                    <ul class="items">
                                        @foreach($sort as $key=>$item)
                                            @if(empty(request()->query()))
                                                <li><a href="{{route('goods.shop',['sort'=>$key])}}">{{$item}}</a></li>
                                            @else
                                                <li>
                                                    <a href="{{route('goods.shop',array_merge(request()->query(),['sort'=>$key]))}}">{{$item}}</a>
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
                                            <a href="{{route('goods.detail',['id'=>$item['id']])}}">
                                                <img data-src="{{$item['discover']}}" alt=""
                                                     class="img-fluid">
                                            </a>
                                            <div class="box-label">
                                                <div class="label-product-new">
                                                    <span>New</span>
                                                </div>
                                            </div>
                                            <div class="action-link">
                                                <a class="wishlist-add same-link" data-product="{{$item['id']}}"
                                                   href="javascript:"
                                                   title="加入收藏"><i
                                                        class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-caption">
                                            <div class="product-name">
                                                <a title="{{$item['title']}}"
                                                   href="{{route('goods.detail',['id'=>$item['id']])}}">{{str_limit($item['title'],30)}}</a>
                                            </div>
                                            <div class="rating">
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                            </div>
                                            <div class="price-box">
                                                @if(!empty($item['discount_price']))
                                                    <span class="regular-price">￥ {{$item['discount_price']}}</span>
                                                    <span class="old-price"><del>￥ {{$item['price']}}</del></span>
                                                @else
                                                    <span class="regular-price">￥ {{$item['price']}}</span>
                                                @endif
                                            </div>
                                            <div class="cart">
                                                <div class="add-to-cart">
                                                    <a href="javascript:" class="cart-plus"
                                                       data-product="{{$item['id']}}" title="加入购物车"><i
                                                            class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="grid-list-caption align-items-center">
                                            <div class="product-name">
                                                <a title="{{$item['title']}}"
                                                   href="{{route('goods.detail',['id'=>$item['id']])}}">{{str_limit($item['title'],30)}}</a>
                                            </div>
                                            <div class="rating">
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                            </div>
                                            <div class="price-box">
                                                @if(!empty($item['discount_price']))
                                                    <span class="regular-price">￥ {{$item['discount_price']}}</span>
                                                    <span class="old-price"><del>￥ {{$item['price']}}</del></span>
                                                @else
                                                    <span class="regular-price">￥ {{$item['price']}}</span>
                                                @endif
                                            </div>

                                            <div class="text-available">
                                                <p><strong>库存 : </strong><span> {{$item['stock']}} In Stock</span></p>
                                            </div>
                                            <div class="action-link">
                                                <a class="quick-view same-link" href="#" title="Quick view"
                                                   data-toggle="modal" data-target="#modal_box"
                                                   data-original-title="quick view"><i
                                                        class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                                <a class="compare-add same-link" href="compare.html"
                                                   title="Add to compare"><i class="zmdi zmdi-refresh-alt"></i></a>
                                                <a class="wishlist-add same-link" href="wishlist.html"
                                                   title="Add to wishlist"><i
                                                        class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                            </div>
                                            <div class="cart-list-button">
                                                <a href="shopping-cart.html" class="cart-btn">Add To Cart</a>
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
                            {{--                        <div class="page-amount">--}}
                            {{--                            <p>Showing 1-10 of 30 results</p>--}}
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
    <script src="/assets/js/jquery.animate_from_to-1.0.js"></script>
    <script>
        $('.wishlist-add').click(function () {
            let product = $(this).data('product');
            ajax(
                {
                    'data': {id: product, _token: '{{csrf_token()}}'},
                    'url': "{{route('goods.wish_add')}}",
                    'type': 'post',
                    'dataType': 'json',
                    'need_alert': 1
                }
            )
        });
        $('.cart-plus').click(function () {
            let product = $(this).data('product');
            let num = 1;
            let that = $(this);
            ajax(
                {
                    'data': {id: product, num: num, _token: '{{csrf_token()}}'},
                    'url': "{{route('goods.cart_add')}}",
                    'type': 'post',
                    'dataType': 'json',
                    'need_alert': 1,
                    'need_hide': 2,
                    'callback': 'f',
                    'func': function () {
                        that.animate_from_to(".my-cart");
                    }
                }
            )
        });
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
