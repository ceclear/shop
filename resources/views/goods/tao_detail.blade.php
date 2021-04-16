@extends("layouts.main")
@section('title','淘女郎详情')
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
                            <li>淘女郎详情</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-area product-details-section">
        <div class="container">
            <div class="row" style="height: 800px">
                <iframe src="{{route('goods.iframe',['id'=>$id])}}" scrolling="no" style="margin: 0 auto;display: block;padding: 0;width: 100%;height: 100%;background-color: #fff; border: none;"></iframe>
                {{--                <div id="gallery" class="fullscreen" style="position: absolute;height: 800px;max-width: 1200px" >--}}
                {{--                </div>--}}
                {{--                <div id="nav" class="navbar" style="position: relative;height: 60px;background-color: #fff;z-index: 0;bottom: 10px">--}}
                {{--                    <a id="preview">&lt; 前一张</a>--}}
                {{--                    <a id="next">下一张 &gt;</a>--}}
                {{--                </div>--}}

            </div>
        </div>
    </div>



@endsection
