@extends("layouts.main")
@section('title','购物车')
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
                            <li>购物车</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cart-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form action="#" class="cart-form">
                        <!-- Cart Title Start -->
                        <div class="cart-title">
                            <h5 class="last-title mt-50 mb-20">购物车</h5>
                        </div>
                        <!-- Cart Title End -->
                        <!-- Cart Table Area Start -->
                        <div class="table-desc">
                            <div class="cart-page table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="product-image">图片</th>
                                        <th class="product-name">商品</th>
                                        <th class="product-price">价格</th>
                                        <th class="product-quantity">数量</th>
                                        <th class="product-remove">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($cart['goods_list']))
                                        @foreach($cart['goods_list'] as $item)
                                            <tr>
                                                <td class="product-image"><a
                                                        href="{{route('goods.detail',['id'=>$item['id']])}}"><img
                                                            src="{{$item['discover']}}" width="100px" height="100px"
                                                            alt=""></a></td>
                                                <td class="product-name"><a
                                                        href="{{route('goods.detail',['id'=>$item['id']])}}">{{str_limit($item['title'],20)}}</a>
                                                </td>
                                                <td class="product-price">￥ {{$item['price']}}</td>
                                                <td class="product-quantity"><label>数量</label> <input min="1"
                                                                                                      max="100"
                                                                                                      value="{{$item['num']}}"
                                                                                                      type="number">
                                                </td>
                                                <td class="product-remove" data-product="{{$item['id']}}"><a
                                                        href="javascript:"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">购物车还是空的哦!</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
{{--                            @if(!empty($cart['goods_list']))--}}
{{--                                <div class="cart-submit">--}}
{{--                                    <button type="submit">update cart</button>--}}
{{--                                </div>--}}
{{--                            @endif--}}
                        </div>
                        <!-- Cart Table Area End -->
                        <!-- Coupon Area Start -->
                        @if(!empty($cart['goods_list']))
                            <div class="coupon-area">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="coupon-code left">
                                            <h3>Coupon</h3>
                                            <div class="coupon-inner">
                                                <p>Enter your coupon code if you have one.</p>
                                                <input placeholder="Coupon code" type="text">
                                                <button type="submit">Apply coupon</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="coupon-code right">
                                            <h3>购物车总计</h3>
                                            <div class="coupon-inner">
                                                <div class="cart-subtotal">
                                                    <p>商品总计</p>
                                                    <p class="cart-amount">
                                                        ￥ {{number_format($cart['order_total_price']??0,2)}}</p>
                                                </div>
                                                <div class="cart-subtotal ">
                                                    <p>邮费</p>
                                                    <p class="cart-amount"> ￥ 0.00</p>
                                                </div>
                                                {{--                                            <a href="#">Calculate shipping</a>--}}

                                                <div class="cart-subtotal">
                                                    <p>总计</p>
                                                    <p class="cart-amount">
                                                        ￥ {{number_format($cart['order_total_price']??0.00,'2')}}</p>
                                                </div>
                                                <div class="checkout-btn">
                                                    <a href="#">去结算</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endif
                    <!-- Coupon Area End -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.product-remove').click(function () {
            let product = $(this).data('product');
            ajax(
                {
                    'data': {id: product, _token: '{{csrf_token()}}'},
                    'url': "{{route('goods.cart_delete')}}",
                    'type': 'post',
                    'dataType': 'json',
                    'need_alert': 1,
                    'need_hide': 2,
                    'callback': 'f',
                    'func': function () {
                        setTimeout(function () {
                            window.location.reload();
                        }, 1500)
                    }
                }
            )
        })
    </script>
@endsection
