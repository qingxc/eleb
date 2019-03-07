@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <script src="https://cdn.bootcss.com/echarts/4.1.0-release/echarts.min.js"></script>
    <h1>最近一周菜品订单量统计</h1>
    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="main" style="width: 1000px;height:400px;"></div>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));
        var option = {
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data:{!! json_encode(array_keys($data)) !!}
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            toolbox: {
                feature: {
                    saveAsImage: {}
                }
            },
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: @foreach($data as $row)
                {!! json_encode(array_keys($row)) !!}
                @break
                @endforeach
            },
            yAxis: {
                type: 'value'
            },
            series: [
                    @foreach($data as $k => $v)
                {
                    name:'{{$k}}',
                    type:'line',
                    stack: '总量',
                    data:{!! json_encode(array_values($v)) !!}
                },
                @endforeach
            ]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
@stop