@extends("layouts.main")
@section('title','首页')
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
                            <img src="assets/images/slider/slider-1.jpg" alt="" class="img-fluid">
                            <div class="slider_content color_one">
                                <h5>The Hottest <br> Trend</h5>
                                <h2>Laptop <br> Tablets Outlet</h2>
                                <div class="pt-des">
                                    <p><span>25%</span>Starting at <span>$340.00</span></p>
                                </div>
                                <a href="#">Shop Now</a>
                            </div>
                        </div>
                        <!-- Single Slider End -->
                        <!-- Single Slider Start -->
                        <div class="single_slider">
                            <img src="assets/images/slider/slider-2.jpg" alt="" class="img-fluid">
                            <div class="slider_content color_two">
                                <h5>The Hottest <br> Trend</h5>
                                <h2>Cellphone <br> Smartphone Not 2</h2>
                                <div class="pt-des">
                                    <p><span>35%</span>Starting at <span>$120.00</span></p>
                                </div>
                                <a href="#">Shop Now</a>
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
                                                <a href="product-details.html">
                                                    <img src="{{$item['discover']}}" alt="" class="img-fluid">
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
                                                    <a class="quick-view same-link" href="#" title="Quick view"
                                                       data-toggle="modal" data-target="#modal_box"
                                                       data-original-title="quick view"><i
                                                            class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                                    <a class="wishlist-add same-link" href="wishlist.html"
                                                       title="Add to wishlist"><i
                                                            class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-caption">
                                                <div class="product-name">
                                                    <a href="product-details.html"
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
                                                        <a class="cart-plus" href="shopping-cart.html"
                                                           title="Add to cart"><i
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
                                                <a href="product-details.html">
                                                    <img src="{{$item['discover']}}" alt="" class="img-fluid">
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
                                                    <a class="quick-view same-link" href="#" title="Quick view"
                                                       data-toggle="modal" data-target="#modal_box"
                                                       data-original-title="quick view"><i
                                                            class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                                    <a class="wishlist-add same-link" href="wishlist.html"
                                                       title="Add to wishlist"><i
                                                            class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-caption">
                                                <div class="product-name">
                                                    <a href="product-details.html"
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
                                                        <a class="cart-plus" href="shopping-cart.html"
                                                           title="Add to cart"><i
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
                                                <a href="product-details.html">
                                                    <img src="{{$item['discover']}}" alt="" class="img-fluid">
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
                                                    <a class="quick-view same-link" href="#" title="Quick view"
                                                       data-toggle="modal" data-target="#modal_box"
                                                       data-original-title="quick view"><i
                                                            class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                                    <a class="wishlist-add same-link" href="wishlist.html"
                                                       title="Add to wishlist"><i
                                                            class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-caption">
                                                <div class="product-name">
                                                    <a href="product-details.html"
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
                                                        <a class="cart-plus" href="shopping-cart.html"
                                                           title="Add to cart"><i
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
                                    <span class="offer-bar"><img src="assets/images/product/sale-offer.png"
                                                                 alt=""></span>
                                        <div class="product-thumb">
                                            <a href="product-details.html">
                                                <img src="{{$item['discover']}}" alt=""
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
                                                <a href="product-details.html">
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
                        <a href="#"><img src="assets/images/banner/banner-1.jpg" alt="" class="img-fluid"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="display: none" class="product-category-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs category-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="four-tab" data-toggle="tab" href="#four">
                                <span><img src="assets/images/category/thumb-1.png" alt="" class="img-fluid"></span>
                                <span>Computer - Laptop</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="five-tab" data-toggle="tab" href="#five">
                                <span><img src="assets/images/category/thumb-2.png" alt="" class="img-fluid"></span>
                                <span>Electronics</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="six-tab" data-toggle="tab" href="#six">
                                <span><img src="assets/images/category/thumb-3.png" alt="" class="img-fluid"></span>
                                <span>Toys & Hobbies</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="seven-tab" data-toggle="tab" href="#seven">
                                <span><img src="assets/images/category/thumb-4.png" alt="" class="img-fluid"></span>
                                <span>Sports & Outdores</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="eight-tab" data-toggle="tab" href="#eight">
                                <span><img src="assets/images/category/thumb-5.png" alt="" class="img-fluid"></span>
                                <span>Smartphone & Tablets</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nine-tab" data-toggle="tab" href="#nine">
                                <span><img src="assets/images/category/thumb-6.png" alt="" class="img-fluid"></span>
                                <span>Health & Beauty</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="product-thing-tab slick-custom-default tab-pane fade show active" id="four">
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-1.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="box-label">
                                        <div class="label-product-new">
                                            <span>New</span>
                                        </div>
                                    </div>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Natus erro at congue massa commodo sit
                                            dignissim</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$30.00</span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a class="cart-plus" href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-2.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="box-label">
                                        <div class="label-product-new">
                                            <span>New</span>
                                        </div>
                                    </div>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Mirum est notare tellus eu nibh iaculis
                                            pretium</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$30.00</span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a class="cart-plus" href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-3.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="#">Porro quisquam eget feugiat pretium sodales</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                        <span class="old-price"><del>$55.50</del></span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-4.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="box-label">
                                        <div class="label-product-new">
                                            <span>New</span>
                                        </div>
                                        <div class="label-product-discount">
                                            <span>-20%</span>
                                        </div>
                                    </div>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Natus erro at congue massa commodo sit
                                            dignissim</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                        <span class="old-price"><del>$55.50</del></span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shoppint-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-5.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Mirum est notare tellus eu nibh iaculis
                                            pretium</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-6.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Porro quisquam eget feugiat pretium sodales</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                        <span class="old-price"><del>$55.50</del></span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                        </div>
                        <div class="product-thing-tab slick-custom-default tab-pane fade" id="five">
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-10.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="box-label">
                                        <div class="label-product-new">
                                            <span>New</span>
                                        </div>
                                    </div>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Natus erro at congue massa commodo sit
                                            dignissim</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$30.00</span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a class="cart-plus" href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-11.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="box-label">
                                        <div class="label-product-new">
                                            <span>New</span>
                                        </div>
                                    </div>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Mirum est notare tellus eu nibh iaculis
                                            pretium</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$30.00</span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a class="cart-plus" href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-3.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="#">Porro quisquam eget feugiat pretium sodales</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                        <span class="old-price"><del>$55.50</del></span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-7.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="box-label">
                                        <div class="label-product-new">
                                            <span>New</span>
                                        </div>
                                        <div class="label-product-discount">
                                            <span>-20%</span>
                                        </div>
                                    </div>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Natus erro at congue massa commodo sit
                                            dignissim</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                        <span class="old-price"><del>$55.50</del></span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shoppint-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-5.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Mirum est notare tellus eu nibh iaculis
                                            pretium</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-6.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Porro quisquam eget feugiat pretium sodales</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                        <span class="old-price"><del>$55.50</del></span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                        </div>
                        <div class="product-thing-tab slick-custom-default tab-pane fade" id="six">
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-1.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="box-label">
                                        <div class="label-product-new">
                                            <span>New</span>
                                        </div>
                                    </div>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Natus erro at congue massa commodo sit
                                            dignissim</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$30.00</span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a class="cart-plus" href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-12.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="box-label">
                                        <div class="label-product-new">
                                            <span>New</span>
                                        </div>
                                    </div>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Mirum est notare tellus eu nibh iaculis
                                            pretium</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$30.00</span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a class="cart-plus" href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-3.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="#">Porro quisquam eget feugiat pretium sodales</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                        <span class="old-price"><del>$55.50</del></span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-4.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="box-label">
                                        <div class="label-product-new">
                                            <span>New</span>
                                        </div>
                                        <div class="label-product-discount">
                                            <span>-20%</span>
                                        </div>
                                    </div>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Natus erro at congue massa commodo sit
                                            dignissim</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                        <span class="old-price"><del>$55.50</del></span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shoppint-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-10.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Mirum est notare tellus eu nibh iaculis
                                            pretium</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-6.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Porro quisquam eget feugiat pretium sodales</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                        <span class="old-price"><del>$55.50</del></span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                        </div>
                        <div class="product-thing-tab slick-custom-default tab-pane fade" id="seven">
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-11.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="box-label">
                                        <div class="label-product-new">
                                            <span>New</span>
                                        </div>
                                    </div>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Natus erro at congue massa commodo sit
                                            dignissim</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$30.00</span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a class="cart-plus" href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-2.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="box-label">
                                        <div class="label-product-new">
                                            <span>New</span>
                                        </div>
                                    </div>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Mirum est notare tellus eu nibh iaculis
                                            pretium</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$30.00</span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a class="cart-plus" href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-3.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="#">Porro quisquam eget feugiat pretium sodales</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                        <span class="old-price"><del>$55.50</del></span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-8.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="box-label">
                                        <div class="label-product-new">
                                            <span>New</span>
                                        </div>
                                        <div class="label-product-discount">
                                            <span>-20%</span>
                                        </div>
                                    </div>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Natus erro at congue massa commodo sit
                                            dignissim</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                        <span class="old-price"><del>$55.50</del></span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shoppint-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-5.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Mirum est notare tellus eu nibh iaculis
                                            pretium</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-6.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Porro quisquam eget feugiat pretium sodales</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                        <span class="old-price"><del>$55.50</del></span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                        </div>
                        <div class="product-thing-tab slick-custom-default tab-pane fade" id="eight">
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-10.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="box-label">
                                        <div class="label-product-new">
                                            <span>New</span>
                                        </div>
                                    </div>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Natus erro at congue massa commodo sit
                                            dignissim</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$30.00</span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a class="cart-plus" href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-2.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="box-label">
                                        <div class="label-product-new">
                                            <span>New</span>
                                        </div>
                                    </div>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Mirum est notare tellus eu nibh iaculis
                                            pretium</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$30.00</span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a class="cart-plus" href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-3.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="#">Porro quisquam eget feugiat pretium sodales</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                        <span class="old-price"><del>$55.50</del></span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-4.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="box-label">
                                        <div class="label-product-new">
                                            <span>New</span>
                                        </div>
                                        <div class="label-product-discount">
                                            <span>-20%</span>
                                        </div>
                                    </div>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Natus erro at congue massa commodo sit
                                            dignissim</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                        <span class="old-price"><del>$55.50</del></span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shoppint-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-9.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Mirum est notare tellus eu nibh iaculis
                                            pretium</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-6.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Porro quisquam eget feugiat pretium sodales</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                        <span class="old-price"><del>$55.50</del></span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                        </div>
                        <div class="product-thing-tab slick-custom-default tab-pane fade" id="nine">
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-9.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="box-label">
                                        <div class="label-product-new">
                                            <span>New</span>
                                        </div>
                                    </div>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Natus erro at congue massa commodo sit
                                            dignissim</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$30.00</span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a class="cart-plus" href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-2.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="box-label">
                                        <div class="label-product-new">
                                            <span>New</span>
                                        </div>
                                    </div>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Mirum est notare tellus eu nibh iaculis
                                            pretium</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$30.00</span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a class="cart-plus" href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-3.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="#">Porro quisquam eget feugiat pretium sodales</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                        <span class="old-price"><del>$55.50</del></span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-4.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="box-label">
                                        <div class="label-product-new">
                                            <span>New</span>
                                        </div>
                                        <div class="label-product-discount">
                                            <span>-20%</span>
                                        </div>
                                    </div>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Natus erro at congue massa commodo sit
                                            dignissim</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                        <span class="old-price"><del>$55.50</del></span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shoppint-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-5.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Mirum est notare tellus eu nibh iaculis
                                            pretium</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                            <!-- Single-Product-Start -->
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/images/product/product-8.jpg" alt="" class="img-fluid">
                                    </a>
                                    <div class="action-link">
                                        <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                           data-target="#modal_box" data-original-title="quick view"><i
                                                class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i
                                                class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html"
                                           title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="product-details.html">Porro quisquam eget feugiat pretium sodales</a>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">$50.67</span>
                                        <span class="old-price"><del>$55.50</del></span>
                                    </div>
                                    <div class="cart">
                                        <div class="add-to-cart">
                                            <a href="shopping-cart.html" title="Add to cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="display: none" class="banner-area mt-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12 text-center">
                    <div class="single-banner mt-40">
                        <a href="#"><img src="assets/images/banner/banner-2.jpg" alt="" class="img-fluid"></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12 text-center">
                    <div class="single-banner mt-40">
                        <a href="#"><img src="assets/images/banner/banner-3.jpg" alt="" class="img-fluid"></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12 text-center">
                    <div class="single-banner mt-40">
                        <a href="#"><img src="assets/images/banner/banner-4.jpg" alt="" class="img-fluid"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                            <a href="product-details.html">
                                                <img src="{{$newList[$i]['images'][0]}}" alt=""
                                                     class="img-fluid block-one">
                                                <img src="{{$newList[$i]['images'][1]}}" alt=""
                                                     class="img-fluid block-two">
                                            </a>
                                        </div>
                                        <div class="product-caption">
                                            <div class="product-name">
                                                <a href="product-details.html" title="{{$newList[$i]['title']}}">{{str_limit($newList[$i]['title'],25)}}</a>
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
                                            <a href="product-details.html">
                                                <img src="{{$newList[$i]['images'][0]}}" alt=""
                                                     class="img-fluid block-one">
                                                <img src="{{$newList[$i]['images'][1]}}" alt=""
                                                     class="img-fluid block-two">
                                            </a>
                                        </div>
                                        <div class="product-caption">
                                            <div class="product-name">
                                                <a href="product-details.html" title="{{$newList[$i]['title']}}">{{str_limit($newList[$i]['title'],25)}}</a>
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
                                            <a href="product-details.html">
                                                <img src="{{$bestList[$i]['images'][0]}}" alt=""
                                                     class="img-fluid block-one">
                                                <img src="{{$bestList[$i]['images'][1]}}" alt=""
                                                     class="img-fluid block-two">
                                            </a>
                                        </div>
                                        <div class="product-caption">
                                            <div class="product-name">
                                                <a href="product-details.html" title="{{$bestList[$i]['title']}}">{{str_limit($bestList[$i]['title'],25)}}</a>
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
                                            <a href="product-details.html">
                                                <img src="{{$bestList[$i]['images'][0]}}" alt=""
                                                     class="img-fluid block-one">
                                                <img src="{{$bestList[$i]['images'][1]}}" alt=""
                                                     class="img-fluid block-two">
                                            </a>
                                        </div>
                                        <div class="product-caption">
                                            <div class="product-name">
                                                <a href="product-details.html" title="{{$bestList[$i]['title']}}">{{str_limit($bestList[$i]['title'],25)}}</a>
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
                                            <a href="product-details.html">
                                                <img src="{{$recList[$i]['images'][0]}}" alt=""
                                                     class="img-fluid block-one">
                                                <img src="{{$recList[$i]['images'][1]}}" alt=""
                                                     class="img-fluid block-two">
                                            </a>
                                        </div>
                                        <div class="product-caption">
                                            <div class="product-name">
                                                <a href="product-details.html" title="{{$recList[$i]['title']}}">{{str_limit($recList[$i]['title'],25)}}</a>
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
                                            <a href="product-details.html">
                                                <img src="{{$recList[$i]['images'][0]}}" alt=""
                                                     class="img-fluid block-one">
                                                <img src="{{$recList[$i]['images'][1]}}" alt=""
                                                     class="img-fluid block-two">
                                            </a>
                                        </div>
                                        <div class="product-caption">
                                            <div class="product-name">
                                                <a href="product-details.html" title="{{$recList[$i]['title']}}">{{str_limit($recList[$i]['title'],25)}}</a>
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
    <div style="display: none" class="brand-area mt-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="brand-logo">
                        <div class="single-brand">
                            <a href="#">
                                <img src="assets/images/brand/3.jpg" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="single-brand">
                            <a href="#">
                                <img src="assets/images/brand/2.jpg" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="single-brand">
                            <a href="#">
                                <img src="assets/images/brand/1.jpg" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="single-brand">
                            <a href="#">
                                <img src="assets/images/brand/4.jpg" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="single-brand">
                            <a href="#">
                                <img src="assets/images/brand/5.jpg" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="single-brand">
                            <a href="#">
                                <img src="assets/images/brand/6.jpg" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="single-brand">
                            <a href="#">
                                <img src="assets/images/brand/1.jpg" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="single-brand">
                            <a href="#">
                                <img src="assets/images/brand/3.jpg" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="single-brand">
                            <a href="#">
                                <img src="assets/images/brand/4.jpg" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
