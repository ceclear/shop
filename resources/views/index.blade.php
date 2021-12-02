@extends("layouts.main")
@section('title','钓鱼视频|钓鱼分享|钓鱼交流上97fish.cn')
@section('keywords','钓鱼视频|钓鱼分享|钓鱼交流上97fish.cn111')
@section('description','钓鱼视频|钓鱼分享|钓鱼交流上97fish.cn222')
@section("content")
    <div class="slider_section mb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-9">
                    <div class="slider_area slider-one mt-30">
                        <!-- Single Slider Start -->
                        <div class="single_slider">
                            <img data-src="https://97fish-private.oss-cn-zhangjiakou.aliyuncs.com/admin_images/slider-1.jpg" alt="" class="img-fluid">
                            <div class="slider_content color_one">
                                <h5>The Hottest <br> Trend</h5>
                                <h2>Laptop <br> Tablets Outlet</h2>
                                <div class="pt-des">
                                    <p><span>25%</span>Starting at <span>$340.00</span></p>
                                </div>
                                <a href="javascript:">Shop Now</a>
                            </div>
                        </div>
                        <!-- Single Slider End -->
                        <!-- Single Slider Start -->
                        <div class="single_slider">
                            <img data-src="https://97fish-private.oss-cn-zhangjiakou.aliyuncs.com/admin_images/slider-2.jpg" alt="" class="img-fluid">
                            <div class="slider_content color_two">
                                <h5>The Hottest <br> Trend</h5>
                                <h2>Cellphone <br> Smartphone Not 2</h2>
                                <div class="pt-des">
                                    <p><span>35%</span>Starting at <span>$120.00</span></p>
                                </div>
                                <a href="javascript:">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="shipping-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-9">
                    <div class="row all-shipping">
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="single-shipping">
                                <div class="block-wrapper">
                                    <div class="shipping-content">
                                        <h5 class="ship-title">免费送货</h5>
                                        <p>所有订单免运费</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="single-shipping">
                                <div class="block-wrapper2">
                                    <div class="shipping-content">
                                        <h5 class="ship-title">7*24小时在线</h5>
                                        <p>7*24小时人工在线</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="single-shipping single-shipping-last">
                                <div class="block-wrapper3">
                                    <div class="shipping-content">
                                        <h5 class="ship-title">退款</h5>
                                        <p>无理由退款</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-area mt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs theme-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="one-tab" data-toggle="tab" href="#one" role="tab"
                               aria-controls="one" aria-selected="true">新品</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab"
                               aria-controls="two" aria-selected="false">热销</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab"
                               aria-controls="three" aria-selected="false">推荐</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="one" role="tabpanel" aria-labelledby="one-tab">
                            <div class="product-thing slick-custom slick-custom-default">
                                @if(!empty($newList))
                                    @foreach($newList as $item)
                                        <div class="item-product">
                                            <div class="product-thumb">
                                                <a href="{{route('goods.detail',['id'=>$item['id']])}}">
                                                    <img data-src="{{$item['discover']}}" alt="" class="img-fluid">
                                                </a>
                                                <div class="box-label">
                                                    <div class="label-product-new">
                                                        <span>New</span>
                                                    </div>
                                                    @if(!empty($item['discount']))
                                                        <div class="label-product-discount">
                                                            <span>-{{$item['discount']}}%</span>
                                                        </div>
                                                    @endif

                                                </div>
                                                <div class="action-link">

                                                    <a class="wishlist-add same-link" href="javascript:"
                                                       data-product="{{$item['id']}}"
                                                       title="加入收藏"><i
                                                            class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-caption">
                                                <div class="product-name">
                                                    <a href="{{route('goods.detail',['id'=>$item['id']])}}"
                                                       title="{{$item['title']}}">{{str_limit($item['title'],25)}}</a>
                                                </div>
                                                <div class="rating">
                                                    @for($i=0;$i<$item['star'];$i++)
                                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                                    @endfor
                                                    @for($i=0;$i<5-$item['star'];$i++)
                                                        <span class="block-one"><i class="fa fa-star"></i></span>
                                                    @endfor

                                                </div>
                                                <div class="price-box">
                                                    <span class="regular-price">￥{{$item['discount_price']}}</span>
                                                    @if($item['discount_price']!=$item['price'])
                                                        <span class="old-price"><del>￥{{$item['price']}}</del></span>
                                                    @endif
                                                </div>
                                                <div class="cart">
                                                    <div class="add-to-cart">
                                                        <a class="cart-plus" data-product="{{$item['id']}}"
                                                           href="javascript:"
                                                           title="加入购物车"><i
                                                                class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane" id="two" role="tabpanel" aria-labelledby="two-tab">
                            <div class="product-thing slick-custom slick-custom-default">
                                @if(!empty($bestList))
                                    @foreach($bestList as $item)
                                        <div class="item-product">
                                            <div class="product-thumb">
                                                <a href="{{route('goods.detail',['id'=>$item['id']])}}">
                                                    <img data-src="{{$item['discover']}}" alt="" class="img-fluid">
                                                </a>
                                                <div class="box-label">
                                                    @if($item['is_new']==1)
                                                        <div class="label-product-new">
                                                            <span>New</span>
                                                        </div>
                                                    @endif
                                                    @if(!empty($item['discount']))
                                                        <div class="label-product-discount">
                                                            <span>-{{$item['discount']}}%</span>
                                                        </div>
                                                    @endif

                                                </div>
                                                <div class="action-link">

                                                    <a class="wishlist-add same-link" href="javascript:"
                                                       data-product="{{$item['id']}}"
                                                       title="加入收藏"><i
                                                            class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-caption">
                                                <div class="product-name">
                                                    <a href="{{route('goods.detail',['id'=>$item['id']])}}"
                                                       title="{{$item['title']}}">{{str_limit($item['title'])}}</a>
                                                </div>
                                                <div class="rating">
                                                    @for($i=0;$i<$item['star'];$i++)
                                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                                    @endfor
                                                    @for($i=0;$i<5-$item['star'];$i++)
                                                        <span class="block-one"><i class="fa fa-star"></i></span>
                                                    @endfor

                                                </div>
                                                <div class="price-box">
                                                    <span class="regular-price">￥{{$item['discount_price']}}</span>
                                                    @if($item['discount_price']!=$item['price'])
                                                        <span class="old-price"><del>￥{{$item['price']}}</del></span>
                                                    @endif
                                                </div>
                                                <div class="cart">
                                                    <div class="add-to-cart">
                                                        <a class="cart-plus" data-product="{{$item['id']}}"
                                                           href="javascript:"
                                                           title="加入购物车"><i
                                                                class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane" id="three" role="tabpanel" aria-labelledby="three-tab">
                            <div class="product-thing slick-custom slick-custom-default">
                                @if(!empty($recList))
                                    @foreach($recList as $item)
                                        <div class="item-product">
                                            <div class="product-thumb">
                                                <a href="{{route('goods.detail',['id'=>$item['id']])}}">
                                                    <img data-src="{{$item['discover']}}" alt="" class="img-fluid">
                                                </a>
                                                <div class="box-label">
                                                    @if($item['is_new']==1)
                                                        <div class="label-product-new">
                                                            <span>New</span>
                                                        </div>
                                                    @endif
                                                    @if(!empty($item['discount']))
                                                        <div class="label-product-discount">
                                                            <span>-{{$item['discount']}}%</span>
                                                        </div>
                                                    @endif

                                                </div>
                                                <div class="action-link">

                                                    <a class="wishlist-add same-link" href="javascript:"
                                                       data-product="{{$item['id']}}"
                                                       title="加入收藏"><i
                                                            class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-caption">
                                                <div class="product-name">
                                                    <a href="{{route('goods.detail',['id'=>$item['id']])}}"
                                                       title="{{$item['title']}}">{{str_limit($item['title'])}}</a>
                                                </div>
                                                <div class="rating">
                                                    @for($i=0;$i<$item['star'];$i++)
                                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                                    @endfor
                                                    @for($i=0;$i<5-$item['star'];$i++)
                                                        <span class="block-one"><i class="fa fa-star"></i></span>
                                                    @endfor

                                                </div>
                                                <div class="price-box">
                                                    <span class="regular-price">￥{{$item['discount_price']}}</span>
                                                    @if($item['discount_price']!=$item['price'])
                                                        <span class="old-price"><del>￥{{$item['price']}}</del></span>
                                                    @endif
                                                </div>
                                                <div class="cart">
                                                    <div class="add-to-cart">
                                                        <a class="cart-plus" data-product="{{$item['id']}}"
                                                           href="javascript:"
                                                           title="加入购物车"><i
                                                                class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sales-offer-area mb-45 mt-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-12">
                    <div class="product-offer-slider slick-custom-default">
                        @if(!empty($saleOff))
                            @foreach($saleOff as $item)
                                <div class="flash-single-item">
                                    <div class="product-item">
                                    <span class="offer-bar"><img data-src="assets/images/product/sale-offer.png"
                                                                 alt=""></span>
                                        <div class="product-thumb">
                                            <a href="{{route('goods.detail',['id'=>$item['id']])}}">
                                                <img data-src="{{$item['discover']}}" alt=""
                                                     class="img-fluid">
                                            </a>
                                            <div class="box-label">
                                                <div class="label-product-discount">
                                                    <span>-{{$item['discount']}}%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-caption">
                                            <div class="product-name mb-20">
                                                <a href="{{route('goods.detail',['id'=>$item['id']])}}">
                                                    <h6>{{$item['brand_code']}}</h6>
                                                </a>
                                            </div>
                                            <div class="rating">
                                                @for($i=0;$i<$item['star'];$i++)
                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                @endfor
                                                @for($i=0;$i<5-$item['star'];$i++)
                                                    <span class="default-star"><i class="fa fa-star"></i></span>
                                                @endfor
                                            </div>
                                            <div class="price-box mt-15 mb-15">
                                                <span class="regular-price">￥{{$item['discount_price']}}</span>
                                                @if($item['discount_price']!=$item['price'])
                                                    <span class="old-price"><del>￥{{$item['price']}}</del></span>
                                                @endif
                                            </div>
                                            <div class="product-pre-content mb-30">
                                                <p>{{str_limit($item['title'],60)}}</p>
                                            </div>
                                            <div class="countdown">
                                                <div class="box-countdown">
                                                    <div class="title-countdown">
                                                        <h6 class="mb-20">Hurry Up! Offer ends in:</h6>
                                                    </div>
                                                    <div data-countdown="2021/12/24">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-12 text-center">
                    <div class="single-banner mt-40">
                        <a href="javascript:"><img data-src="assets/images/banner/banner-1.jpg" alt=""
                                                   class="img-fluid"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-category-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs category-tabs">
                        @if(!empty($categoryGoodList))
                            @foreach($categoryGoodList as $key=>$item)
                                <li class="nav-item">
                                    <a class="nav-link @if($key==0) active @else @endif" id="show_{{$key}}-tab"
                                       data-toggle="tab" href="#show_{{$key}}">
                                        <span><img data-src="assets/images/category/thumb-{{$key+1}}.png" alt=""
                                                   class="img-fluid"></span>
                                        <span>{{$item['name']}}</span>
                                    </a>
                                </li>
                            @endforeach
                        @endif

                    </ul>
                    <div class="tab-content">
                        @if(!empty($categoryGoodList))
                            @foreach($categoryGoodList as $key=>$item)
                                <div
                                    class="product-thing-tab slick-custom-default tab-pane fade show @if($key==0) active @else @endif"
                                    id="show_{{$key}}">
                                    @foreach($item['goods'] as $value)
                                        <div class="item-product">
                                            <div class="product-thumb">
                                                <a href="{{route('goods.detail',['id'=>$value['id']])}}">
                                                    <img data-src="{{$value['discover']}}" alt=""
                                                         class="img-fluid">
                                                </a>
                                                <div class="box-label">
                                                    <div class="label-product-new">
                                                        <span>New</span>
                                                    </div>
                                                </div>
                                                {{--                                                <div class="action-link">--}}
                                                {{--                                                    <a class="wishlist-add same-link" data-product="{{$value['id']}}"--}}
                                                {{--                                                       title="Add to wishlist"><i--}}
                                                {{--                                                            class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>--}}
                                                {{--                                                </div>--}}
                                            </div>
                                            <div class="product-caption">
                                                <div class="product-name">
                                                    <a href="{{route('goods.detail',['id'=>$value['id']])}}">{{str_limit($value['title'],25)}}</a>
                                                </div>
                                                <div class="rating">
                                                    @for($i=0;$i<$value['star'];$i++)
                                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                                    @endfor
                                                    @for($i=0;$i<5-$value['star'];$i++)
                                                        <span class="default-star"><i class="fa fa-star"></i></span>
                                                    @endfor
                                                </div>
                                                <div class="price-box">
                                                    <span class="regular-price">￥{{$value['price']}}</span>
                                                </div>
                                                <div class="cart">
                                                    <div class="add-to-cart">
                                                        <a class="cart-plus" data-product="{{$item['id']}}"
                                                           href="javascript:"
                                                           title="加入购物车"><i
                                                                class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    <div style="display: none" class="banner-area mt-10">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-lg-4 col-md-4 col-12 text-center">--}}
    {{--                    <div class="single-banner mt-40">--}}
    {{--                        <a href="#"><img data-src="assets/images/banner/banner-2.jpg" alt="" class="img-fluid"></a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-lg-4 col-md-4 col-12 text-center">--}}
    {{--                    <div class="single-banner mt-40">--}}
    {{--                        <a href="#"><img data-src="assets/images/banner/banner-3.jpg" alt="" class="img-fluid"></a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-lg-4 col-md-4 col-12 text-center">--}}
    {{--                    <div class="single-banner mt-40">--}}
    {{--                        <a href="#"><img data-src="assets/images/banner/banner-4.jpg" alt="" class="img-fluid"></a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <div class="feature-category-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mt-50">
                    <div class="block-title">
                        <h6>新品</h6>
                    </div>
                    <div class="feature-carousel slick-custom slick-custom-default nav-top">
                        @if(!empty($newList))

                            <div class="product-list-content">
                                @for($i=0;$i<3;$i++)
                                    <div class="single-product-list @if($i==2) mb-20 @endif">
                                        <div class="product-list-image">
                                            <a href="{{route('goods.detail',['id'=>$newList[$i]['id']])}}">
                                                <img data-src="{{$newList[$i]['images'][0]}}" alt=""
                                                     class="img-fluid block-one">
                                                @if(!empty($newList[$i]['images'][1]))
                                                    <img data-src="{{$newList[$i]['images'][1]}}" alt=""
                                                         class="img-fluid block-two">
                                                @else
                                                    <img data-src="{{$newList[$i]['images'][0]}}" alt=""
                                                         class="img-fluid block-two">
                                                @endif

                                            </a>
                                        </div>
                                        <div class="product-caption">
                                            <div class="product-name">
                                                <a href="{{route('goods.detail',['id'=>$newList[$i]['id']])}}"
                                                   title="{{$newList[$i]['title']}}">{{str_limit($newList[$i]['title'],35)}}</a>
                                            </div>
                                            <div class="rating">
                                                @for($j=0;$j<$newList[$i]['star'];$j++)
                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                @endfor
                                                @for($j=0;$j<5-$newList[$i]['star'];$j++)
                                                    <span class="block-one"><i class="fa fa-star"></i></span>
                                                @endfor
                                            </div>
                                            <div class="price-box">
                                                <span class="regular-price">￥{{$newList[$i]['price']}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>

                            <div class="product-list-content">
                                @for($i=3;$i<6;$i++)
                                    <div class="single-product-list @if($i==2) mb-20 @endif">
                                        <div class="product-list-image">
                                            <a href="{{route('goods.detail',['id'=>$newList[$i]['id']])}}">
                                                <img data-src="{{$newList[$i]['images'][0]}}" alt=""
                                                     class="img-fluid block-one">
                                                @if(!empty($newList[$i]['images'][1]))
                                                    <img data-src="{{$newList[$i]['images'][1]}}" alt=""
                                                         class="img-fluid block-two">
                                                @else
                                                    <img data-src="{{$newList[$i]['images'][0]}}" alt=""
                                                         class="img-fluid block-two">
                                                @endif

                                            </a>
                                        </div>
                                        <div class="product-caption">
                                            <div class="product-name">
                                                <a href="{{route('goods.detail',['id'=>$newList[$i]['id']])}}"
                                                   title="{{$newList[$i]['title']}}">{{str_limit($newList[$i]['title'],35)}}</a>
                                            </div>
                                            <div class="rating">
                                                @for($j=0;$j<$newList[$i]['star'];$j++)
                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                @endfor
                                                @for($j=0;$j<5-$newList[$i]['star'];$j++)
                                                    <span class="block-one"><i class="fa fa-star"></i></span>
                                                @endfor
                                            </div>
                                            <div class="price-box">
                                                <span class="regular-price">￥{{$newList[$i]['price']}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-50">
                    <div class="block-title">
                        <h6>热销</h6>
                    </div>
                    <div class="feature-carousel slick-custom slick-custom-default nav-top">
                        @if(!empty($bestList))

                            <div class="product-list-content">
                                @for($i=0;$i<3;$i++)
                                    <div class="single-product-list @if($i==2) mb-20 @endif">
                                        <div class="product-list-image">
                                            <a href="{{route('goods.detail',['id'=>$bestList[$i]['id']])}}">
                                                <img data-src="{{$bestList[$i]['images'][0]}}" alt=""
                                                     class="img-fluid block-one">
                                                @if(!empty($bestList[$i]['images'][1]))
                                                    <img data-src="{{$bestList[$i]['images'][1]}}" alt=""
                                                         class="img-fluid block-two">
                                                @else
                                                    <img data-src="{{$bestList[$i]['images'][0]}}" alt=""
                                                         class="img-fluid block-two">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="product-caption">
                                            <div class="product-name">
                                                <a href="{{route('goods.detail',['id'=>$bestList[$i]['id']])}}"
                                                   title="{{$bestList[$i]['title']}}">{{str_limit($bestList[$i]['title'],35)}}</a>
                                            </div>
                                            <div class="rating">
                                                @for($j=0;$j<$bestList[$i]['star'];$j++)
                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                @endfor
                                                @for($j=0;$j<5-$bestList[$i]['star'];$j++)
                                                    <span class="block-one"><i class="fa fa-star"></i></span>
                                                @endfor
                                            </div>
                                            <div class="price-box">
                                                <span class="regular-price">￥{{$bestList[$i]['price']}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>

                            <div class="product-list-content">
                                @for($i=3;$i<6;$i++)
                                    <div class="single-product-list @if($i==2) mb-20 @endif">
                                        <div class="product-list-image">
                                            <a href="{{route('goods.detail',['id'=>$bestList[$i]['id']])}}">
                                                <img data-src="{{$bestList[$i]['images'][0]}}" alt=""
                                                     class="img-fluid block-one">
                                                @if(!empty($bestList[$i]['images'][1]))
                                                    <img data-src="{{$bestList[$i]['images'][1]}}" alt=""
                                                         class="img-fluid block-two">
                                                @else
                                                    <img data-src="{{$bestList[$i]['images'][0]}}" alt=""
                                                         class="img-fluid block-two">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="product-caption">
                                            <div class="product-name">
                                                <a href="{{route('goods.detail',['id'=>$bestList[$i]['id']])}}"
                                                   title="{{$bestList[$i]['title']}}">{{str_limit($bestList[$i]['title'],35)}}</a>
                                            </div>
                                            <div class="rating">
                                                @for($j=0;$j<$bestList[$i]['star'];$j++)
                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                @endfor
                                                @for($j=0;$j<5-$bestList[$i]['star'];$j++)
                                                    <span class="block-one"><i class="fa fa-star"></i></span>
                                                @endfor
                                            </div>
                                            <div class="price-box">
                                                <span class="regular-price">￥{{$bestList[$i]['price']}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-50">
                    <div class="block-title">
                        <h6>推荐</h6>
                    </div>
                    <div class="feature-carousel slick-custom slick-custom-default nav-top">
                        @if(!empty($recList))

                            <div class="product-list-content">
                                @for($i=0;$i<3;$i++)
                                    <div class="single-product-list @if($i==2) mb-20 @endif">
                                        <div class="product-list-image">
                                            <a href="{{route('goods.detail',['id'=>$recList[$i]['id']])}}">
                                                <img data-src="{{$recList[$i]['images'][0]}}" alt=""
                                                     class="img-fluid block-one">
                                                @if(!empty($recList[$i]['images'][1]))
                                                    <img data-src="{{$recList[$i]['images'][1]}}" alt=""
                                                         class="img-fluid block-two">
                                                @else
                                                    <img data-src="{{$recList[$i]['images'][0]}}" alt=""
                                                         class="img-fluid block-two">
                                                @endif

                                            </a>
                                        </div>
                                        <div class="product-caption">
                                            <div class="product-name">
                                                <a href="{{route('goods.detail',['id'=>$recList[$i]['id']])}}"
                                                   title="{{$recList[$i]['title']}}">{{str_limit($recList[$i]['title'],35)}}</a>
                                            </div>
                                            <div class="rating">
                                                @for($j=0;$j<$recList[$i]['star'];$j++)
                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                @endfor
                                                @for($j=0;$j<5-$recList[$i]['star'];$j++)
                                                    <span class="block-one"><i class="fa fa-star"></i></span>
                                                @endfor
                                            </div>
                                            <div class="price-box">
                                                <span class="regular-price">￥{{$recList[$i]['price']}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>

                            <div class="product-list-content">
                                @for($i=3;$i<6;$i++)
                                    <div class="single-product-list @if($i==2) mb-20 @endif">
                                        <div class="product-list-image">
                                            <a href="{{route('goods.detail',['id'=>$recList[$i]['id']])}}">
                                                <img data-src="{{$recList[$i]['images'][0]}}" alt=""
                                                     class="img-fluid block-one">
                                                @if(!empty($recList[$i]['images'][1]))
                                                    <img data-src="{{$recList[$i]['images'][1]}}" alt=""
                                                         class="img-fluid block-two">
                                                @else
                                                    <img data-src="{{$recList[$i]['images'][0]}}" alt=""
                                                         class="img-fluid block-two">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="product-caption">
                                            <div class="product-name">
                                                <a href="{{route('goods.detail',['id'=>$recList[$i]['id']])}}"
                                                   title="{{$recList[$i]['title']}}">{{str_limit($recList[$i]['title'],35)}}</a>
                                            </div>
                                            <div class="rating">
                                                @for($j=0;$j<$recList[$i]['star'];$j++)
                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                @endfor
                                                @for($j=0;$j<5-$recList[$i]['star'];$j++)
                                                    <span class="block-one"><i class="fa fa-star"></i></span>
                                                @endfor
                                            </div>
                                            <div class="price-box">
                                                <span class="regular-price">￥{{$recList[$i]['price']}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    <div style="display: none" class="brand-area mt-35">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-lg-12 text-center">--}}
    {{--                    <div class="brand-logo">--}}
    {{--                        <div class="single-brand">--}}
    {{--                            <a href="#">--}}
    {{--                                <img data-src="assets/images/brand/3.jpg" alt="" class="img-fluid">--}}
    {{--                            </a>--}}
    {{--                        </div>--}}
    {{--                        <div class="single-brand">--}}
    {{--                            <a href="#">--}}
    {{--                                <img data-src="assets/images/brand/2.jpg" alt="" class="img-fluid">--}}
    {{--                            </a>--}}
    {{--                        </div>--}}
    {{--                        <div class="single-brand">--}}
    {{--                            <a href="#">--}}
    {{--                                <img data-src="assets/images/brand/1.jpg" alt="" class="img-fluid">--}}
    {{--                            </a>--}}
    {{--                        </div>--}}
    {{--                        <div class="single-brand">--}}
    {{--                            <a href="#">--}}
    {{--                                <img data-src="assets/images/brand/4.jpg" alt="" class="img-fluid">--}}
    {{--                            </a>--}}
    {{--                        </div>--}}
    {{--                        <div class="single-brand">--}}
    {{--                            <a href="#">--}}
    {{--                                <img data-src="assets/images/brand/5.jpg" alt="" class="img-fluid">--}}
    {{--                            </a>--}}
    {{--                        </div>--}}
    {{--                        <div class="single-brand">--}}
    {{--                            <a href="#">--}}
    {{--                                <img data-src="assets/images/brand/6.jpg" alt="" class="img-fluid">--}}
    {{--                            </a>--}}
    {{--                        </div>--}}
    {{--                        <div class="single-brand">--}}
    {{--                            <a href="#">--}}
    {{--                                <img data-src="assets/images/brand/1.jpg" alt="" class="img-fluid">--}}
    {{--                            </a>--}}
    {{--                        </div>--}}
    {{--                        <div class="single-brand">--}}
    {{--                            <a href="#">--}}
    {{--                                <img data-src="assets/images/brand/3.jpg" alt="" class="img-fluid">--}}
    {{--                            </a>--}}
    {{--                        </div>--}}
    {{--                        <div class="single-brand">--}}
    {{--                            <a href="#">--}}
    {{--                                <img data-src="assets/images/brand/4.jpg" alt="" class="img-fluid">--}}
    {{--                            </a>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <link rel="stylesheet" type="text/css" href="/assets/css/normalize2.css"/>
    <script src="/assets/js/jquery.animate_from_to-1.0.js"></script>
    <script src="/assets/js/index.js" type="text/javascript" charset="utf-8"></script>
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
    </script>
@endsection
