@extends("layouts.main")
@section('title','商品详情')
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
                            <li>
                                <h1><a href="{{route('goods.shop')}}">商品</a></h1>
                            </li>
                            <li>商品详情</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-area product-details-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-12 mt-50">
                    <!-- Product Zoom Image start -->
                    <div class="product-slider-container arrow-center text-center">
                        @if($detail['images'])
                            @foreach($detail['images'] as $item)
                                <div class="product-item">
                                    <a href="{{$item}}"><img
                                            src="{{$item}}" class="img-fluid"
                                            alt=""/></a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <!-- Product Zoom Image End -->
                    <!-- Product Thumb Zoom Image Start -->


                    <div class="product-details-thumbnail arrow-center text-center">
                        @if($detail['images'])
                            @foreach($detail['images'] as $item)
                                <div class="product-item-thumb">
                                    <img src="{{$item}}" class="img-fluid"
                                         alt=""/>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
                <div class="col-lg-7 col-12 mt-45">
                    <!-- Product Summery Start -->
                    <div class="product-summery position-relative">
                        <div class="product-head">
                            <h1 title="{{$detail['title']}}"
                                class="product-title">{{str_limit($detail['title'],25)}}</h1>
{{--                            <div class="product-arrows text-right">--}}
{{--                                <a href="#"><i class="fa fa-long-arrow-left"></i></a>--}}
{{--                                <a href="#"><i class="fa fa-long-arrow-right"></i></a>--}}
{{--                            </div>--}}
                        </div>
                        <div class="rating-meta d-flex">
                            <div class="rating">
                                @if($detail['star'])
                                    @for($i=0;$i<$detail['star'];$i++)
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    @endfor
                                    @for($i=0;$i<5-$detail['star'];$i++)
                                        <span class="default-star"><i class="fa fa-star"></i></span>
                                    @endfor
                                @endif

                            </div>
                            <ul class="meta d-flex">
                                <li>
                                    <a href="#"><i class="fa fa-commenting-o"></i>Read reviews(3)</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-edit"></i>Write a review</a>
                                </li>
                            </ul>
                        </div>
                        <div class="price-box">
                            <span class="regular-price">￥{{$detail['price']}}</span>
                        </div>
                        {{--                        <div class="product-description">--}}
                        {{--                            <p>Porro first 4K UHD Camcorder, the GX10 has a compact and portable design that delivers--}}
                        {{--                                outstanding video quality with remarkable detail. With a combination of incredible--}}
                        {{--                                features and functionality, the GX10 is the ideal camcorder for aspiring filmmakers.</p>--}}
                        {{--                        </div>--}}
                        <div class="product-tax mb-20">
                            <ul>
                                <li><span><strong>分类 : </strong>{{$detail['cid1_name']}} > {{$detail['cid2_name']}} > {{$detail['cid3_name']}}</span>
                                </li>
                                <li><span><strong>品牌 : </strong>{{$detail['brand_code']}}</span></li>
                                <li><span><strong>SKU : </strong>{{$detail['sku']}}</span></li>
                                <li><span><strong>库存 : </strong>{{$detail['stock']}}</span></li>
                                <li><span><strong>销量 : </strong>{{$detail['sale']}}</span></li>
                            </ul>
                        </div>
                        <div class="product-packeges">
                            <table>
                                <tbody>
                                <tr>
                                    <td class="label"><span>Size</span></td>
                                    <td class="value">
                                        <div class="product-sizes">
                                            <a href="#">Large</a>
                                            <a href="#">Medium</a>
                                            <a href="#">Small</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label"><span>Color</span></td>
                                    <td class="value">
                                        <div class="product-colors">
                                            <a href="#" data-bg-color="#000000"
                                               style="background-color: rgb(0, 0, 0);"></a>
                                            <a href="#" data-bg-color="#ffffff"
                                               style="background-color: rgb(255, 255, 255);"></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label"><span>Quantity</span></td>
                                    <td class="value">
                                        <div class="product-quantity">
                                            <span class="qty-btn minus"><i class="fa fa-angle-down"></i></span>
                                            <input type="text" class="input-qty" value="1">
                                            <span class="qty-btn plus"><i class="fa fa-angle-up"></i></span>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="product-buttons grid_list">
                            <div class="action-link">
                                <a class="quick-view same-link" href="#" title="Quick view" data-toggle="modal"
                                   data-target="#modal_box" data-original-title="quick view"><i
                                        class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                <button data-product="{{$detail['id']}}" class="btn-secondary">加入购物车</button>
                                <a class="wishlist-add same-link" href="javascript:" data-product="{{$detail['id']}}"
                                   title="Add to wishlist"><i
                                        class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                            </div>
                        </div>
                        <div class="product-meta">
                            <div class="desc-content">
                                <div class="social_sharing d-flex">
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
                    </div>
                    <!-- Product Summery End -->
                </div>
            </div>
            <div class="row mt-40">
                <div class="col-lg-3 col-sm-3 col-md-2">
                    <!-- Product Description Tab Start -->
                    <div class="product-desc-tab">
                        <ul class="nav flex-column" role="tablist">
                            <li><a class="active" href="#description" role="tab" data-toggle="tab"
                                   aria-selected="false">描述</a></li>
                            <li><a href="#reviews" role="tab" data-toggle="tab" aria-selected="true">评论</a></li>
                        </ul>
                    </div>
                    <!-- Product Description Tab End -->
                </div>
                <div class="col-lg-9 col-sm-9 col-md-10">
                    <div class="product-desc-tab-content">
                        <!-- Start Single Content -->
                        <div role="tabpanel" id="description" class="product_tab_content fade active show">
                            <div class="product_description_wrap mt-20">
                                <div class="product_desc">
                                    <h2 class="last-title mb-20">描述</h2>
                                    <p>{{$detail['title']}}</p>
                                </div>

                            </div>
                        </div>
                        <!-- End Single Content -->
                        <!-- Start Single Content -->
                        <div role="tabpanel" id="reviews" class="product_tab_content fade">
                            <div class="review_address_inner mt-20">
                                <!-- Start Single Review -->
                                <div class="pro_review">
                                    <div class="review_thumb">
                                        <img src="/assets/images/blog/comment/comment-3.jpg" alt="review images">
                                    </div>
                                    <div class="review_details">
                                        <div class="review_info">
                                            <a class="last-title" href="#">Gerald Barnes</a>
                                            <div class="rating">
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                            </div>
                                            <div class="rating_send">
                                                <a href="#"><i class="zmdi zmdi-mail-reply"></i></a>
                                                <a href="#"><i class="zmdi zmdi-close"></i></a>
                                            </div>
                                        </div>
                                        <div class="review_date">
                                            <span>27 Jun, 2016 at 2:30pm</span>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan
                                            egestas elese ifend. Phasellus a felis at estei to bibendum feugiat ut eget
                                            eni Praesent et messages in con sectetur posuere dolor non.</p>
                                    </div>
                                </div>
                                <!-- End Single Review -->
                                <!-- Start Single Review -->
                                <div class="pro_review pro-second">
                                    <div class="review_thumb">
                                        <img src="/assets/images/blog/comment/comment-3.jpg" alt="review images">
                                    </div>
                                    <div class="review_details">
                                        <div class="review_info">
                                            <a class="last-title" href="#">Gerald Barnes</a>
                                            <div class="rating">
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                                <span class="yellow"><i class="fa fa-star"></i></span>
                                            </div>
                                            <div class="rating_send">
                                                <a href="#"><i class="zmdi zmdi-mail-reply"></i></a>
                                                <a href="#"><i class="zmdi zmdi-close"></i></a>
                                            </div>
                                        </div>
                                        <div class="review_date">
                                            <span>27 Jun, 2016 at 2:30pm</span>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan
                                            egestas elese ifend. Phasellus a felis at estei to bibendum feugiat ut eget
                                            eni Praesent et messages in con sectetur posuere dolor non.</p>
                                    </div>
                                </div>
                                <!-- End Single Review -->
                            </div>
                            <!-- Start RAting Area -->
                            <div class="rating_wrap mt-20">
                                <h4 class="last-title">Your Rating</h4>
                                <div class="rating_list mt-20">
                                    <!-- Start Single List -->
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="rating">
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                        <span class="yellow"><i class="fa fa-star"></i></span>
                                    </div>
                                    <!-- End Single List -->
                                </div>
                            </div>
                            <!-- End RAting Area -->
                            <div class="comments_form">
                                <h3>Leave a Reply </h3>
                                <p>Your email address will not be published. Required fields are marked *</p>
                                <form action="#">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="review_comment">Comment </label>
                                            <textarea name="comment" id="review_comment" spellcheck="false"
                                                      data-gramm="false"></textarea>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label for="author">Name</label>
                                            <input id="author" type="text">

                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label for="email">Email </label>
                                            <input id="email" type="text">
                                        </div>
                                    </div>
                                    <button class="button" type="submit">Post Comment</button>
                                </form>
                            </div>
                        </div>
                        <!-- End Single Content -->
                    </div>
                </div>
            </div>
            @if(!empty($release))

                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-details-home2 mt-45 mb-15">
                            <div class="block-title">
                                <h6>相关商品</h6>
                            </div>
                            <div class="product-carousel-home2 slick-custom slick-custom-default nav-top">
                                @foreach($release as $key=>$item)
                                    <div class="product-row">
                                        <!-- Single-Product-Start -->
                                        <div class="item-product">
                                            <div class="product-thumb">
                                                <a href="{{route('goods.detail',['id'=>$item['id']])}}">
                                                    <img src="{{$item['images'][0]}}" alt="" class="img-fluid">
                                                </a>
                                                <div class="box-label">
                                                    @if($item['is_new']==1)
                                                        <div class="label-product-new">
                                                            <span>New</span>
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="product-caption">
                                                <div class="product-name">
                                                    <a href="{{route('goods.detail',['id'=>$item['id']])}}">{{str_limit($item['title'],25)}}</a>
                                                </div>
                                                <div class="rating">
                                                    @if($item['star'])
                                                        @for($i=0;$i<$item['star'];$i++)
                                                            <span class="yellow"><i class="fa fa-star"></i></span>
                                                        @endfor
                                                        @for($i=0;$i<5-$item['star'];$i++)
                                                            <span class="default-star"><i class="fa fa-star"></i></span>
                                                        @endfor
                                                    @endif
                                                </div>
                                                <div class="price-box">
                                                    <span class="regular-price">￥{{$item['price']}}</span>
                                                </div>
                                                <div class="cart">
                                                    <div class="add-to-cart">
                                                        <a class="cart-plus" href="javascript:"
                                                           data-product="{{$detail['id']}}"
                                                           title="加入购物车"><i
                                                                class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single-Product-End -->
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="modal fade" id="modal_box" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="zmdi zmdi-close"></i></span>
                </button>
                <div class="modal_body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="modal_tab">
                                    <div class="tab-content product-details-large">
                                        @if(!empty($detail['images']))
                                            @foreach($detail['images'] as $key=>$item)
                                                <div class="tab-pane fade show @if($key==0) active @else @endif"
                                                     id="tab{{$key}}" role="tabpanel">
                                                    <div class="modal_tab_img">
                                                        <a href="#"><img
                                                                src="{{$item}}"
                                                                alt="" class="img-fluid" style="height: 70%;width: 70%"></a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                    <div class="modal_tab_button">
                                        <ul class="nav product_navactive" role="tablist">
                                            @if(!empty($detail['images']))
                                                @foreach($detail['images'] as $key=>$item)
                                                    <li style="margin-top: 10px">
                                                        <a class="nav-link @if($key==0) active @else @endif"
                                                           data-toggle="tab" href="#tab{{$key}}" role="tab"
                                                           aria-controls="tab1" aria-selected="false"><img
                                                                src="{{$item}}"
                                                                alt="" class="img-fluid"
                                                                style="width: 100px;height: 100px;"></a>
                                                    </li>
                                                @endforeach
                                            @endif


                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <!-- Product Summery Start -->
                                <div class="product-summery mt-50">
                                    <div class="product-head">
                                        <h1 class="product-title">{{$detail['title']}}</h1>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">￥ {{$detail['price']}}</span>
                                    </div>

                                    <div class="product-tax mb-20">
                                        <ul>
                                            <li><span><strong>分类 : </strong>{{$detail['cid1_name']}} > {{$detail['cid2_name']}} > {{$detail['cid3_name']}}</span>
                                            </li>
                                            <li><span><strong>品牌 : </strong>{{$detail['brand_code']}}</span></li>
                                            <li><span><strong>SKU : </strong>{{$detail['sku']}}</span></li>
                                            <li><span><strong>库存 : </strong>{{$detail['stock']}}</span></li>
                                            <li><span><strong>销量 : </strong>{{$detail['sale']}}</span></li>
                                        </ul>
                                    </div>
                                    <div class="product-buttons grid_list">
                                        <div class="action-link">
                                            <button class="btn-secondary" data-product="{{$detail['id']}}">加入购物车
                                            </button>
                                            <a href="javascript:" class="wishlist-add" data-product="{{$detail['id']}}" title="加入收藏"><i
                                                    class="zmdi zmdi-favorite-outline zmdi-hc-fw "></i></a>
                                        </div>
                                    </div>
                                    <div class="product-meta">
                                        <div class="desc-content">
                                            <div class="social_sharing d-flex">
                                                <h5>share this post:</h5>
                                                <ul>
                                                    <li><a href="#" title="facebook"><i class="fa fa-facebook"></i></a>
                                                    </li>
                                                    <li><a href="#" title="twitter"><i class="fa fa-twitter"></i></a>
                                                    </li>
                                                    <li><a href="#" title="pinterest"><i
                                                                class="fa fa-pinterest"></i></a></li>
                                                    <li><a href="#" title="google+"><i
                                                                class="fa fa-google-plus"></i></a></li>
                                                    <li><a href="#" title="linkedin"><i class="fa fa-linkedin"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Summery End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    相关商品查看--}}

    <link rel="stylesheet" type="text/css" href="/assets/css/normalize2.css"/>
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
        $('.btn-secondary,.cart-plus').click(function () {
            let product = $(this).data('product');
            let num = $('.input-qty').val();
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
