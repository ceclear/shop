<div class="header-area">
    <!-- Header Top Start -->
    <div class="header-top full-border">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="header-top-left">
                        <p><span>7*24在线: </span> (800) 123 456 789</p>
                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <div class="box-right">
                        <ul>
                            <li class="settings">
                                <a href="{{route('goods.cart')}}">购物车</a>
                            </li>
                            <li class="settings">
                                <a href="{{route('goods.wish')}}">收藏列表</a>
                            </li>
                            {{--                            <li class="settings">--}}
                            {{--                                <a href="#" class="drop-toggle">--}}
                            {{--                                    <span>RMB ￥</span>--}}
                            {{--                                    <i class="fa fa-angle-down"></i>--}}
                            {{--                                </a>--}}
                            {{--                                <ul class="box-dropdown drop-dropdown">--}}
                            {{--                                    @if(!empty($rateList))--}}
                            {{--                                        @foreach($rateList as $item)--}}
                            {{--                                            <li><a href="#">{{$item['name']}} {{$item['symbol']}}</a></li>--}}
                            {{--                                        @endforeach--}}
                            {{--                                    @endif--}}
                            {{--                                </ul>--}}
                            {{--                            </li>--}}

                            <li class="settings">
                                <a href="#" class="drop-toggle">
                                    个人中心
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="box-dropdown drop-dropdown">
                                    <li><a href="#">个人中心</a></li>
                                    <li><a href="#">结算</a></li>
                                    @if(empty(session('user_info')))
                                        <li><a href="{{route('member.login')}}">登录</a></li>
                                    @else
                                        <li><a href="{{route('member.logout')}}">退出</a></li>
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Top End -->
    <!-- Header Middle Start -->
    <div class="header-middle space-40">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-6" style="margin-left: -82px">
                    <div class="logo">
                        <a href="/"><img data-src="https://97fish-private.oss-cn-zhangjiakou.aliyuncs.com/admin_images/logo.png" alt="" class="img-fluid"></a>
                    </div>
                </div>
                <div class="col-lg-9 col-6">
                    <div class="header-middle-inner">
                        <div class="search-container">
                            <form action="#" style="width: 750px">

                                <div class="search_box">
                                    <input class="header-search" style="width: 665px;border-radius: 23px"
                                           placeholder="请输入关键字" type="text">
                                    <button class="header-search-button" type="submit">搜索</button>
                                </div>
                            </form>
                        </div>
                        <div class="blockcart" style="padding-left: 73px">
                            <a href="javascript:" class="drop-toggle" style="width: 246px">
                                <img data-src="/assets/images/cart/cart.png" alt="" class="img-fluid">
                                <span class="my-cart" style="padding-left: 10px">购物车</span>
                                @if(!empty($cart)) <span class="count"
                                                         style="left: 87px"> {{$cart['order_total_num']}} </span>@endif
                                <span
                                    class="total-item">￥@if(!empty($cart)) {{number_format($cart['order_total_price']??0,2)}}  @endif</span>
                            </a>
                            <div class="cart-dropdown drop-dropdown">
                                <ul>
                                    @if(!empty($cart['goods_list']))
                                        @foreach($cart['goods_list'] as $item)
                                            <li class="mini-cart-details">
                                                <div class="innr-crt-img">
                                                    <img data-src="{{$item['discover']}}" height="70px" width="70px" alt="">
                                                    <span>{{$item['num']}}x</span>
                                                </div>
                                                <div class="innr-crt-content">
                                                <span class="product-name">
                                                <a title="{{$item['title']}}"
                                                   href="{{route('goods.detail',['id'=>$item['id']])}}">{{str_limit($item['title'])}}</a>
                                            </span>
                                                    <span class="product-price">￥ {{$item['price']}}</span>
                                                    {{--                                                    <span class="product-size">Size:  S</span>--}}
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                    <li>
                                        <span class="subtotal-text">商品总价</span>
                                        <span
                                            class="subtotal-price">￥@if(!empty($cart)) {{$cart['order_total_price']}} @else
                                                0.00 @endif</span>
                                    </li>
                                    <li>
                                        <span class="subtotal-text">邮费</span>
                                        <span class="subtotal-price">￥ 0.00</span>
                                    </li>
                                    <li>
                                        <span class="subtotal-text">合计</span>
                                        <span
                                            class="subtotal-price">￥@if(!empty($cart)) {{$cart['order_total_price']}} @else
                                                0.00 @endif</span>
                                    </li>
                                </ul>
                                <div class="checkout-cart">
                                    <a href="checkout.html">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Middle End -->
    <!-- Header Bottom Start -->
    <div class="header-menu header-bottom-area theme-bg sticker">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Category Menu Start -->
                    <div class="categoryes-menu-bar">
                        <div class="categoryes-menu-btn category-toggle">
                            <div class="float-left">
                                <a href="javascript:">所有分类</a>
                            </div>
                            <div class="float-right">
                                <i class="fa fa-bars"></i>
                            </div>
                        </div>
                        <nav class="categorye-menus category-dropdown" @if(!$categoryShow)style="display: none"@endif>
                            <ul class="categories-expand">
                                @if(!empty($categoryList))
                                    @foreach($categoryList as $item)

                                        <li class="categories-hover-right">
                                            <a href="{{route('goods.shop',['cid1'=>$item['id'],'name'=>$item['name']])}}">{{$item['name']}}
                                                <i
                                                    class="fa fa-angle-right float-right"></i></a>
                                            <ul class="cat-submenu category-mega">
                                                @if(!empty($item['child']))
                                                    @foreach($item['child'] as $value)
                                                        @if(empty($value['child']))
                                                            @continue
                                                        @endif
                                                        <li class="cat-mega-title"><a
                                                                href="{{route('goods.shop',['cid2'=>$value['id'],'name'=>$value['name']])}}">{{$value['name']}}</a>
                                                            @if(!empty($value['child']))
                                                                <ul>
                                                                    @foreach($value['child'] as $vv)
                                                                        <li>
                                                                            <a href="{{route('goods.shop',['cid3'=>$vv['id'],'name'=>$vv['name']])}}">{{$vv['name']}}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>

                                                            @endif
                                                        </li>
                                                    @endforeach
                                                @endif

                                            </ul>
                                        </li>
                                        <!--------dropdown-------->
                                        <li class="menu-item-has-children"><span class="menu-expand"><i
                                                    class="fa fa-angle-down"></i></span>
                                            <a href="javascript:">{{$item['name']}}</a>
                                            <ul class="sub-menu">
                                                @if(!empty($item['child']))
                                                    @foreach($item['child'] as $value)
                                                        @if(empty($value['child']))
                                                            @continue
                                                        @endif
                                                        <li class="menu-item-has-children"><span class="menu-expand"><i
                                                                    class="fa fa-angle-down"></i></span>
                                                            <a href="javascript:">{{$value['name']}}</a>
                                                            @if(!empty($value['child']))
                                                                <ul class="sub-menu">
                                                                    @foreach($value['child'] as $vv)
                                                                        <li><a href="javascript:">{{$vv['name']}}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                            @endforeach
                                                            @endif
                                                        </li>

                                            </ul>
                                        </li>
                                    @endforeach
                                @endif
                                <li class="category-item-parent">
                                    <a href="javascript:" class="more-btn">More Category</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Category Menu End -->
                </div>
                <div class="col-lg-9">
                    <!-- Main Menu Start -->
                    <div class="header-menu add-sticky">
                        <div class="sticky-container">

                            <nav class="main-menu">
                                <ul>
                                    <li><a>淘女郎<i class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown dropdown-width">
                                            @if(!empty($taoCategory))
                                                @foreach($taoCategory as $item)
                                                    <li>
                                                        <a href="{{route('goods.tao_girl',['type'=>$item])}}">{{$item}}</a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </li>
                                    <li><a href="{{route('news.list')}}">新闻</a></li>
                                    <li><a href="{{route('news.joke')}}">笑话大全</a></li>
                                    <li><a href="/article/list.html">文章</a></li>
                                    <li><a>数学<i class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown dropdown-width">
                                            <li><a href="{{route('study')}}">一年级</a></li>
                                            <li><a>二年级</a></li>
                                        </ul>
                                    </li>
                                    {{--                                    <li><a href="about.html">关于我们</a></li>--}}
                                    <li><a href="{{route('contact')}}">联系我们</a></li>

                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- Main Menu End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Header Bottom End  -->
</div>

