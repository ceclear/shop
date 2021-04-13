@extends("layouts.main")
@section('title','收藏列表')
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
                                <h1><a>收藏列表</a></h1>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wishlist-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form action="#" class="cart-form">
                        <!-- Wishlist Title Start -->
                        <div class="wishlist-title">
                            <h5 class="last-title mt-50 mb-20">收藏列表</h5>
                        </div>
                        <!-- Wishlist Title End -->
                        <!-- Wishlist Table Area Start -->
                        <div class="table-desc wishlist-margin">
                            <div class="wishlist-page cart-page table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="product-image">图片</th>
                                        <th class="product-name">商品</th>
                                        <th class="product-price">价格</th>
                                        <th class="product-stock">状态</th>
                                        <th class="product-remove">操作</th>
                                        <th class="product-cart">添加购物车</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($list))
                                        @foreach($list as $item)
                                            <tr>
                                                <td class="product-image"><a
                                                        href="{{route('goods.detail',['id'=>$item['goods']['id']])}}"><img
                                                            src="{{$item['goods']['discover']}}" alt="" width="100px"
                                                            height="100px"></a></td>
                                                <td class="product-name"><a
                                                        href="{{route('goods.detail',['id'=>$item['goods']['id']])}}">{{$item['goods']['title']}}</a>
                                                </td>
                                                <td class="product-price">￥ {{$item['goods']['price']}}</td>
                                                <td class="product-stock">有库存</td>
                                                <td class="product-remove"><a href="#"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                                <td class="product-cart"><input type="submit" class="btn-secondary"
                                                                                value="Add to Cart"></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="6">没有数据</td></tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div  class="wishlist-shear desc-content justify-content-center no-border-bottom mt-20 no-margin-bottom">
                                @if(!empty($list) && $list->lastPage() !=1)
                                    {{$list->links()}}
                                @endif
                            </div>
                            <div
                                class="wishlist-shear desc-content justify-content-center no-border-bottom mt-20 no-margin-bottom">
                                <div class="social_sharing">
                                    <h5 class="text-center">share this post</h5>
                                    <ul class="mt-0">
                                        <li><a href="#" title="facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" title="twitter"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" title="pinterest"><i class="fa fa-pinterest"></i></a></li>
                                        <li><a href="#" title="google+"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#" title="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>


                        </div>
                        <!-- Wishlist Table Area End -->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
