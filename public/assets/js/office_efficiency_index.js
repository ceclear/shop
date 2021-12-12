
//门店受理详情
function loadChannelHandleDetail(data) {
    var option = {
        tooltip: {trigger: 'axis', axisPointer: {lineStyle: {color: '#fff'}}},
        legend: {
            icon: 'rect',
            itemWidth: 14, itemHeight: 5, itemGap: 10,
            data: ['商品抓取量', '新闻抓取量'],
            right: '10px', top: '0px',
            textStyle: {fontSize: 12, color: '#fff'}
        },
        grid: {x: 40, y: 50, x2: 45, y2: 40},
        xAxis: [{
            type: 'category',
            boundaryGap: false,
            axisLine: {lineStyle: {color: '#57617B'}},
            axisLabel: {textStyle: {color: '#fff'}},
            data: data.dataDateArr
        }],
        yAxis: [{
            type: 'value',
            axisTick: {
                show: false
            },
            axisLine: {lineStyle: {color: '#57617B'}},
            axisLabel: {margin: 5, textStyle: {fontSize: 12}, textStyle: {color: '#fff'}, formatter: '{value}个'},
            splitLine: {lineStyle: {color: '#57617B'}}
        }, {
            type: 'value',
            axisTick: {
                show: false
            },
            axisLine: {lineStyle: {color: '#57617B'}},
            axisLabel: {margin: 5, textStyle: {fontSize: 12}, textStyle: {color: '#fff'}, formatter: '{value}个'},
            splitLine: {show: false, lineStyle: {color: '#57617B'}}
        }],
        series: [{
            name: '商品抓取量', type: 'line', smooth: true, lineStyle: {normal: {width: 2}},
            yAxisIndex: 0,
            areaStyle: {
                normal: {
                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                        offset: 0,
                        color: 'rgba(3, 194, 236, 0.3)'
                    }, {
                        offset: 0.8,
                        color: 'rgba(3, 194, 236, 0)'
                    }], false),
                    shadowColor: 'rgba(0, 0, 0, 0.1)',
                    shadowBlur: 10
                }
            },
            itemStyle: {normal: {color: '#03C2EC'}},
            data: data.goodsData
        }, {
            name: '新闻抓取量', type: 'line', smooth: true, lineStyle: {normal: {width: 2}},
            yAxisIndex: 1,
            areaStyle: {
                normal: {
                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                        offset: 0,
                        color: 'rgba(218, 57, 20, 0.3)'
                    }, {
                        offset: 0.8,
                        color: 'rgba(218, 57, 20, 0)'
                    }], false),
                    shadowColor: 'rgba(0, 0, 0, 0.1)',
                    shadowBlur: 10
                }
            },
            itemStyle: {normal: {color: '#DA3914'}},
            data: data.newsData
        }]


    };
    var myChart = echarts.init(document.getElementById('channel_handle_detail'));
    myChart.clear();

    myChart.setOption(option);

}

$(function () {
    $.get('/admin/chart', function (res) {
        $(".no-data").remove();
        //加载门店历史受理详情
        loadChannelHandleDetail(res);
    });

})
