@extends("layouts.main")
@section('title','文章详情')
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
                            <li>文章详情</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="blog-details-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Single Blog Start -->
                    <div class="single-blog mt-50">
                        <div class="blog-image mb-30">
                            <a><img src="{{$detail['image']}}" alt="" class="img-fluid"></a>
                        </div>
                        <div class="blog-content">
                            <h5 class="last-title mb-20">{{$detail['title']}}</h5>
                            <ul class="meta">
                                <li>
                                    <i class="fa fa-calendar"></i><a>{{date("M d,Y",strtotime($detail['created_at']))}}</a>
                                </li>
                                <li><i class="fa fa-user-circle"></i> Posts by : {{$detail['author']}}</li>
                            </ul>
                            <div class="desc">
                                {!! $detail['content'] !!}
                            </div>
                            <div class="desc-content">
                                <div class="post_meta">
                                    <span><strong>Tags:-</strong></span>
                                    @if(!empty($detail['tags']))
                                        @foreach($detail['tags'] as $item)
                                            <span><a>{{$item}}</a></span>
                                        @endforeach
                                    @endif
                                </div>
                                <div style="display: none !important;" class="social_sharing d-flex">
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
                    <!-- Single Blog End -->
                    <!-- Related post Start -->
                    <div class="related-post mb-30">
                        <h4 class="last-title mb-20">相关文章</h4>
                        <div class="row">
                            @if(!empty($release))
                                @foreach($release as $item)
                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <!-- Single Blog Start -->
                                        <div class="single-blog">
                                            <div class="blog-image mb-20">
                                                <a href="{{route('article.detail',['id'=>$item['id']])}}"><img
                                                        src="{{$item['image']}}" alt=""
                                                        class="img-fluid"></a>
                                            </div>
                                            <div class="blog-content">
                                                <h5 class="title"><a href="{{route('article.detail',['id'=>$item['id']])}}">{{$item['title']}}
                                                        -
                                                        Image</a></h5>
                                                <ul class="meta">
                                                    <li><i class="fa fa-calendar"></i><a >{{date("M d,Y",strtotime($item['created_at']))}}</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- Single Blog End -->
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <!-- Releted Post End -->
                    <!-- Comment Box Start -->
                    <div class="comments_box">
                        <h3>3 Comments </h3>
                        <div class="comment_list">
                            <div class="comment_thumb">
                                <img src="/assets/images/blog/comment/comment-3.jpg" alt="">
                            </div>
                            <div class="comment_content">
                                <div class="comment_meta">
                                    <h5><a href="#">Admin</a></h5>
                                    <span>October 16, 2018 at 1:38 am</span>
                                </div>
                                <p>But I must explain to you how all this mistaken idea of denouncing pleasure</p>
                                <div class="comment_reply">
                                    <a href="#">Reply</a>
                                </div>
                            </div>

                        </div>
                        <div class="comment_list list_two">
                            <div class="comment_thumb">
                                <img src="/assets/images/blog/comment/comment-3.jpg" alt="">
                            </div>
                            <div class="comment_content">
                                <div class="comment_meta">
                                    <h5><a href="#">Demo</a></h5>
                                    <span>October 16, 2018 at 1:38 am</span>
                                </div>
                                <p>Quisque semper nunc vitae erat pellentesque, ac placerat arcu consectetur</p>
                                <div class="comment_reply">
                                    <a href="#">Reply</a>
                                </div>
                            </div>
                        </div>
                        <div class="comment_list">
                            <div class="comment_thumb">
                                <img src="/assets/images/blog/comment/comment-3.jpg" alt="">
                            </div>
                            <div class="comment_content">
                                <div class="comment_meta">
                                    <h5><a href="#">Admin</a></h5>
                                    <span>October 16, 2018 at 1:38 am</span>
                                </div>
                                <p>Quisque orci nibh, porta vitae sagittis sit amet, vehicula vel mauris. Aenean at</p>
                                <div class="comment_reply">
                                    <a href="#">Reply</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Comment Box End -->
                    <!-- Comments Form start -->
                    <div class="comments_form mb-20">
                        <h3>Leave a Reply </h3>
                        <p>Your email address will not be published. Required fields are marked *</p>
                        <form action="#">
                            <div class="row">
                                <div class="col-12">
                                    <label for="review_comment">Comment </label>
                                    <textarea name="comment" id="review_comment" spellcheck="false"
                                              data-gramm="false"></textarea>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <label for="author">Name</label>
                                    <input id="author" type="text">

                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <label for="email">Email </label>
                                    <input id="email" type="text">
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <label for="website">Website </label>
                                    <input id="website" type="text">
                                </div>
                            </div>
                            <button class="button" type="submit">Post Comment</button>
                        </form>
                    </div>
                    <!-- Comments Form End -->
                </div>
            </div>
        </div>
    </div>
@endsection
