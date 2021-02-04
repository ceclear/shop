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
{{--                            <li class="settings">--}}
{{--                                <a href="#">Compare (2)</a>--}}
{{--                            </li>--}}
                            <li class="settings">
                                <a href="#" class="drop-toggle">
                                    <span>RMB ￥</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="box-dropdown drop-dropdown">
                                    @if(!empty($rateList))
                                        @foreach($rateList as $item)
                                            <li><a href="#">{{$item['name']}} {{$item['symbol']}}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </li>
                            <li class="settings">
                                <a href="#" class="drop-toggle">
                                    <img src="/assets/images/cuntry/1.jpg" alt="">
                                    English
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="box-dropdown drop-dropdown">
                                    <li>
                                        <a href="#"><img src="/assets/images/cuntry/1.jpg" alt=""> English</a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="/assets/images/cuntry/2.jpg" alt=""> Francis</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="settings">
                                <a href="#" class="drop-toggle">
                                    个人中心
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="box-dropdown drop-dropdown">
                                    <li><a href="#">个人中心</a></li>
                                    <li><a href="#">结算</a></li>
                                    <li><a href="/member/login.html">登录</a></li>
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
                <div class="col-lg-3 col-6">
                    <div class="logo">
                        <a href="/"><img src="/assets/images/logo/logo.png" alt="" class="img-fluid"></a>
                    </div>
                </div>
                <div class="col-lg-9 col-6">
                    <div class="header-middle-inner">
                        <div class="search-container">
                            <form action="#">
                                <div class="top-cat">
                                    <select class="select-option" name="select" id="category2">
                                        {{--                                        <option value="1">All categories22</option>--}}
                                        <option value="">所有分类</option>
                                        @if(!empty($categoryList))
                                            @foreach($categoryList as $item)

                                                <option value="{{$item['id']}}">- -{{$item['name']}}</option>

                                                        @if(!empty($item['child']))
                                                            @foreach($item['child'] as $value)
                                                                @if(empty($value['child']))
                                                                    @continue
                                                                @endif
                                                                    <option value="{{$value['id']}}">- - -{{$value['name']}}</option>
                                                                    @if(!empty($value['child']))

                                                                            @foreach($value['child'] as $vv)
                                                                            <option value="{{$vv['id']}}">- - - -{{$vv['name']}}</option>
                                                                            @endforeach


                                                                    @endif

                                                            @endforeach
                                                        @endif
                                            @endforeach
                                        @endif

                                    </select>
                                </div>
                                <div class="search_box">
                                    <input class="header-search" placeholder="请输入关键字" type="text">
                                    <button class="header-search-button" type="submit">搜索</button>
                                </div>
                            </form>
                        </div>
                        <div class="blockcart">
                            <a href="#" class="drop-toggle">
                                <img src="/assets/images/cart/cart.png" alt="" class="img-fluid">
                                <span class="my-cart">购物车</span>
                                <span class="count">2</span>
                                <span class="total-item">$200.00</span>
                            </a>
                            <div class="cart-dropdown drop-dropdown">
                                <ul>
                                    <li class="mini-cart-details">
                                        <div class="innr-crt-img">
                                            <img src="/assets/images/cart/ear-headphones.jpg" alt="">
                                            <span>1x</span>
                                        </div>
                                        <div class="innr-crt-content">
                                                <span class="product-name">
                                                <a href="#">SonicFuel Wireless Over-Ear Headphones </a>
                                            </span>
                                            <span class="product-price">$32.30</span>
                                            <span class="product-size">Size:  S</span>
                                        </div>
                                    </li>
                                    <li class="mini-cart-details mb-30">
                                        <div class="innr-crt-img">
                                            <img src="/assets/images/cart/720-degree-cameras-dual.jpg" alt="">
                                            <span>1x</span>
                                        </div>
                                        <div class="innr-crt-content">
                                                <span class="product-name">
                                                <a href="#">720 Degree Panoramic HD 360.. </a>
                                            </span>
                                            <span class="product-price">$29.00</span>
                                            <span class="product-size">Dimension:  40cm X 60cm</span>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="subtotal-text">Subtotal</span>
                                        <span class="subtotal-price">$61.30</span>
                                    </li>
                                    <li>
                                        <span class="subtotal-text">Shipping</span>
                                        <span class="subtotal-price">$40.20</span>
                                    </li>
                                    <li>
                                        <span class="subtotal-text">Taxes</span>
                                        <span class="subtotal-price">$10.07</span>
                                    </li>
                                    <li>
                                        <span class="subtotal-text">Total</span>
                                        <span class="subtotal-price">$111.57</span>
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
                                <a href="#">所有分类</a>
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
                                            <a href="#">{{$item['name']}} <i
                                                    class="fa fa-angle-right float-right"></i></a>
                                            <ul class="cat-submenu category-mega">
                                                @if(!empty($item['child']))
                                                    @foreach($item['child'] as $value)
                                                        @if(empty($value['child']))
                                                            @continue
                                                        @endif
                                                        <li class="cat-mega-title"><a
                                                                href="#">{{$value['name']}}</a>
                                                            @if(!empty($value['child']))
                                                                <ul>
                                                                    @foreach($value['child'] as $vv)
                                                                        <li><a href="#">{{$vv['name']}}</a></li>
                                                                    @endforeach
                                                                </ul>

                                                            @endif
                                                        </li>
                                                    @endforeach
                                                @endif

                                            </ul>
                                        </li>
                                    @endforeach
                                @endif
                                <li class="category-item-parent">
                                    <a href="#" class="more-btn">More Category</a>
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
{{--                                    <li>--}}
{{--                                        <a href="index.html">首页 <i class="fa fa-angle-down"></i></a>--}}
{{--                                        <ul class="dropdown dropdown-width">--}}
{{--                                            <li><a href="index.html">Home Version 1</a></li>--}}
{{--                                            <li><a href="index-2.html">Home Version 2</a></li>--}}
{{--                                            <li><a href="index-3.html">Home Version 3</a></li>--}}
{{--                                            <li><a href="index-4.html">Home Version 4</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a href="shop.html">Shop <i class="fa fa-angle-down"></i></a>--}}
{{--                                        <div class="mega-menu dropdown">--}}
{{--                                            <ul class="mega-menu-inner d-flex">--}}
{{--                                                <li>--}}
{{--                                                    <a href="">Shop Layouts</a>--}}
{{--                                                    <ul>--}}
{{--                                                        <li><a href="shop.html">Shop</a></li>--}}
{{--                                                        <li><a href="shop-fullwidth.html">Full Width</a></li>--}}
{{--                                                        <li><a href="shop-fullwidth-list.html">Full Width list</a></li>--}}
{{--                                                        <li><a href="shop-right-sidebar.html">Right Sidebar </a></li>--}}
{{--                                                        <li><a href="shop-right-sidebar-list.html"> Right Sidebar--}}
{{--                                                                list</a></li>--}}
{{--                                                        <li><a href="shop-list.html">List View</a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <a href="">Other Pages</a>--}}
{{--                                                    <ul>--}}
{{--                                                        <li><a href="shopping-cart.html">Cart</a></li>--}}
{{--                                                        <li><a href="wishlist.html">Wishlist</a></li>--}}
{{--                                                        <li><a href="checkout.html">Checkout</a></li>--}}
{{--                                                        <li><a href="my-account.html">My Account</a></li>--}}
{{--                                                        <li><a href="faq.html">FAQs</a></li>--}}
{{--                                                        <li><a href="404.html">Error 404</a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <a href="">Product Types</a>--}}
{{--                                                    <ul>--}}
{{--                                                        <li><a href="product-details.html">Product details</a></li>--}}
{{--                                                        <li><a href="product-details-external.html">Product external</a>--}}
{{--                                                        </li>--}}
{{--                                                        <li><a href="product-details-grouped.html">Product grouped</a>--}}
{{--                                                        </li>--}}
{{--                                                        <li><a href="product-details-variable.html">Product variable</a>--}}
{{--                                                        </li>--}}
{{--                                                        <li><a href="product-details-bottomtab.html">Tab style - 1</a>--}}
{{--                                                        </li>--}}
{{--                                                        <li><a href="product-details-lefttab.html">Tab style - 2</a>--}}
{{--                                                        </li>--}}
{{--                                                    </ul>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <a href="">Other Product Types</a>--}}
{{--                                                    <ul>--}}
{{--                                                        <li><a href="product-details-righttab.html">Tab style - 3</a>--}}
{{--                                                        </li>--}}
{{--                                                        <li><a href="product-details-stickyleft.html">Product sticky--}}
{{--                                                                left</a></li>--}}
{{--                                                        <li><a href="product-details-stickyright.html">Product sticky--}}
{{--                                                                right</a></li>--}}
{{--                                                        <li><a href="product-details-galleryleft.html">Product leftside--}}
{{--                                                                Gallery</a></li>--}}
{{--                                                        <li><a href="product-details-galleryright.html">Product--}}
{{--                                                                rightside Gallery</a></li>--}}
{{--                                                        <li><a href="product-details-sliderbox.html">Product--}}
{{--                                                                Sliderbox</a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                            <div class="mega-menu-banner mt-30">--}}
{{--                                                <a href="shop.html"><img src="/assets/images/bg/custom_banner.jpg"--}}
{{--                                                                         alt=""></a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a href="#">Blog <i class="fa fa-angle-down"></i></a>--}}
{{--                                        <ul class="dropdown dropdown-width">--}}
{{--                                            <li>--}}
{{--                                                <a href="blog-grid-right-sidebar.html">Blog Grid<i--}}
{{--                                                        class="fa fa-angle-right float-right"></i></a>--}}
{{--                                                <ul class="sub-dropdown dropdown dropdown-width">--}}
{{--                                                    <li><a href="blog-grid-right-sidebar.html">Right Sidebar</a></li>--}}
{{--                                                    <li><a href="blog-grid-left-sidebar.html">Left Sidebar</a></li>--}}
{{--                                                    <li><a href="blog-grid-fullwidth.html">Full Width</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </li>--}}
{{--                                            <li>--}}
{{--                                                <a href="blog-list-right-sidebar.html">Blog List<i--}}
{{--                                                        class="fa fa-angle-right float-right"></i></a>--}}
{{--                                                <ul class="sub-dropdown dropdown dropdown-width">--}}
{{--                                                    <li><a href="blog-list-right-sidebar.html">Right Sidebar</a></li>--}}
{{--                                                    <li><a href="blog-list-left-sidebar.html">Left Sidebar</a></li>--}}
{{--                                                    <li><a href="blog-list-fullwidth.html">Full Width</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </li>--}}
{{--                                            <li>--}}
{{--                                                <a href="blog-details-right-sidebar.html">Blog Single Post<i--}}
{{--                                                        class="fa fa-angle-right float-right"></i></a>--}}
{{--                                                <ul class="sub-dropdown dropdown dropdown-width">--}}
{{--                                                    <li><a href="blog-details.html">Right Sidebar</a></li>--}}
{{--                                                    <li><a href="blog-details-left-sidebar.html">Left Sidebar</a></li>--}}
{{--                                                    <li><a href="blog-details-fullwidth.html">Full Width</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </li>--}}
{{--                                            <li>--}}
{{--                                                <a href="blog-right-sidebar.html">Standard Blog<i--}}
{{--                                                        class="fa fa-angle-right float-right"></i></a>--}}
{{--                                                <ul class="sub-dropdown dropdown dropdown-width">--}}
{{--                                                    <li><a href="blog-right-sidebar.html">Right Sidebar</a></li>--}}
{{--                                                    <li><a href="blog-left-sidebar.html">Left Sidebar</a></li>--}}
{{--                                                    <li><a href="blog-fullwidth.html">Full Width</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a href="#">Pages <i class="fa fa-angle-down"></i></a>--}}
{{--                                        <ul class="dropdown dropdown-width">--}}
{{--                                            <li><a href="about">About Us</a></li>--}}
{{--                                            <li><a href="shop.html">Shop</a></li>--}}
{{--                                            <li><a href="product-details.html">Product</a></li>--}}
{{--                                            <li><a href="shopping-cart.html">Shopping Cart</a></li>--}}
{{--                                            <li><a href="wishlist.html">Wishlist</a></li>--}}
{{--                                            <li><a href="checkout.html">Checkout</a></li>--}}
{{--                                            <li><a href="compare.html">Compare</a></li>--}}
{{--                                            <li><a href="contact.html">Contact Us</a></li>--}}
{{--                                            <li><a href="faq.html">Frequently Question</a></li>--}}
{{--                                            <li><a href="my-account.html">My Account</a></li>--}}
{{--                                            <li><a href="login.html">Login</a></li>--}}
{{--                                            <li><a href="register.html">Register</a></li>--}}
{{--                                            <li><a href="404.html">404 Error</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
                                    <li><a href="/article/list.html">文章</a></li>
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="contact.html">Contact Us</a></li>
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

