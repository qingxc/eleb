@extends('./layout/app')
@section('content')
    @include('layout._tips')
    <script src="https://cdn.bootcss.com/echarts/4.1.0-release/echarts.min.js"></script>
    <h1>最近一周订单量统计</h1>
    <table class="table table-bordered">
        <tr>
            @foreach($data1 as $date=>$amount)
                <th>{{ $amount }}</th>
            @endforeach
        </tr>
        <tr>
            @foreach($data2 as $date=>$amount)
                <td>{{ $amount }}</td>
            @endforeach
        </tr>
    </table>

    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="main" style="width: 1000px;height:400px;"></div>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '最近一周订单量统计'
            },
            tooltip: {},
            legend: {
                data:['订单量']
            },
            xAxis: {
                data: {!! json_encode(array_values($data1)) !!}
            },
            yAxis: {},
            series: [{
                name: '订单量',
                type: 'line',
                data: {!! json_encode(array_values($data2)) !!}
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
@stop