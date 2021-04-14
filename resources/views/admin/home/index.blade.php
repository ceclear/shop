<script type="text/javascript">
    //埋点全局变量
    var gDataGather = {
        systemCode: "dataanalysis",
        systemName: "CRM数据分析",
        moduleCode: "dataanalysis-m001",
        moduleName: "稳定运营",
        pageCode: "dataanalysis-m001-p0007",
        pageName: "厅店效能分析",
        param: "{}"
    }
</script>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info" style="background: #17a2b8">
                    <div class="inner">
                        <h3>{{$member}}</h3>

                        <p>会员数</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="javascript:" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success" style="background: #28a745">
                    <div class="inner">
                        <h3>{{$goods}}</h3>

                        <p>商品数量</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="javascript:" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning" style="background: #ffc107">
                    <div class="inner">
                        <h3>{{$news}}</h3>

                        <p>新闻数量</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="javascript:" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger" style="background: #dc3545">
                    <div class="inner">
                        <h3>{{$joke}}</h3>

                        <p>笑话数量</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="javascript:" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- ./col -->
        </div>

    </div>
    {{--    charts--}}
    <div class="col-sm-6 col-md-6 pd"
         style="width: 98%;background: #181C41;padding: 0 15px 0 15px;margin: 0 15px 0 15px;">
        <div class="col-info">
            <div class="title"
                 style="height: 4rem;    line-height: 4rem;vertical-align: middle;padding-left: 15px;font-size: 16px;font-weight: 600;color: #03C2EC;text-align: left;">
                数据抓取分析
            </div>
            <div class="content" id="channel_handle_detail" style="min-height: 400px"></div>
        </div>
    </div>
</section>
<script src='https://cdn.bootcdn.net/ajax/libs/echarts/4.2.1/echarts.min.js'></script>
<script src="/assets/js/office_efficiency_index.js" type="text/javascript" charset="utf-8"></script>
