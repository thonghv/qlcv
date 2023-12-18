@extends('layouts.app')
@section('title', "Bệnh viện đa khoa Bình Định")
@section('content')
@if (Auth::user()->permission != "USER")
<div id="container"></div>
<script type="text/javascript">
    var $colName = <?php echo json_encode($colChart); ?>;
    var $todos = [
        {
            name: 'Chưa hoàn thành',
            data: <?php echo json_encode($chuahoanthanhDataChart); ?>,
            color: '#ddd'
        },
        {
            name: 'Đạt yêu cầu',
            data: <?php echo json_encode($viechoanthanhDataChart); ?>,
            color: 'green'
        },
        {
            name: 'Chờ duyệt',
            data: <?php echo json_encode($viecchoduyetDataChart); ?>,
            color: '#3097d1'
        },
        {
            name: 'Trễ hạn',
            data: <?php echo json_encode($viectrehanDataChart); ?>,
            color: '#a94442'
        },
        {
            name: 'Không đạt',
            data: <?php echo json_encode($vieckhongdatDataChart); ?>,
            color: '#f31410'
        }
    ]
    Highcharts.chart('container', {
        chart: {
            style: {
                fontSize: '12px'
            },
            type: 'column'
        },
        title: {
            text: '',
            align: 'left'
        },
        xAxis: {
            categories: $colName,
            labels: {
                style: {
                    fontSize:'14px'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Số lượng công việc'
            },
            stackLabels: {
                enabled: true
            },
            labels: {
                style: {
                    fontSize:'10px'
                }
            }
        },
        legend: {
            align: 'left',
            x: 70,
            verticalAlign: 'top',
            y: -10,
            floating: true,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false,
            itemStyle: {
                 fontSize:'10px',
              }
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Tổng số: {point.stackTotal}',
            style: {
                    fontSize:'12px'
                }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: $todos
    });

</script>
<br>
@endif
@if (Auth::user()->permission != "USER")
<div class="row">
    <div class="col-md-4 col-md-offset-8 text-right" style="padding-bottom:10px;padding-right:30px">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#popupnew">Thêm bảng mới <span class="glyphicon glyphicon-plus"></span>
        </button>
    </div>
    @include('todo.addtodo')
</div>
@endif
@if($todos != false)
@foreach ($todos as $todo)

<div class="col-md-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            {{-- <h4>{{title_case($todo->todo)}}</h4>--}}

            <a href="{{'/taskdetail/'.$todo->id}}">
                <h4>{{$todo->todo}}</h4>
            </a>


            <!-- Split button -->
            <div class="icon-right" style="">
                @if (Auth::user()->permission == 'ADMIN')
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#popupremovetask_{{$todo->id}}">
                    <span class="glyphicon glyphicon-remove"></span>
                </button>
                @endif
                <!-- Button Add User -->
                @if (Auth::user()->add_user === 1)
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#popupmanageusersdetail_{{$todo->id}}">
                    <span class="glyphicon glyphicon-user"></span>
                </button>
                @endif
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#popupnewtaskdetail_{{$todo->id}}">
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </div>

        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    Đạt yêu cầu : <strong>{{$todo->viechoanthanh}}</strong>
                </div>
                <div class="col-md-3">
                    Việc chưa hoàn thành : <strong>{{$todo->chuahoanthanh}}</strong>
                </div>
                <div class="col-md-3">
                    Việc chờ duyệt : <strong>{{$todo->chopheduyet}}</strong>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Việc trễ hạn : <strong style="color: #a94442">{{$todo->viectredeadline}}</strong>
                </div>
                <div class="col-md-3">
                    Việc không đạt : <strong style="color: #f31410">{{$todo->vieckhongdat}}</strong>
                </div>
            </div>
            <div class="row">
                <div id="container_{{$todo->id}}"></div>
                <script type="text/javascript">
                    var $chuahoanthanh = <?php echo $todo->chuahoanthanh; ?>;
                    var $viechoanthanh = <?php echo $todo->viechoanthanh; ?>;
                    var $chopheduyet = <?php echo $todo->chopheduyet; ?>;
                    var $viectredeadline = <?php echo $todo->viectredeadline; ?>;
                    var $vieckhongdat = <?php echo $todo->vieckhongdat; ?>;
                    Highcharts.chart('container_{{$todo->id}}', {
                    chart: {
                        type: 'pie',
                        style: {
                            fontSize: '13px'
                        },
                    },
                    title: {
                        text: ' '
                    },
                    tooltip: {
                        enabled: false,
                        valueSuffix: '%'
                    },
                    subtitle: {
                        text:''
                    },
                    plotOptions: {
                        series: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: [{
                                enabled: true,
                                distance: 20
                            }, {
                                enabled: true,
                                distance: -40,
                                format: '{point.percentage:.0f}%',
                                style: {
                                    fontSize: '1.2em',
                                    textOutline: 'none',
                                    opacity: 0.7
                                },
                                filter: {
                                    operator: '>',
                                    property: 'percentage',
                                    value: 10
                                }
                            }]
                        }
                    },
                    series: [
                        {
                            name: 'Tỷ lệ',
                            colorByPoint: true,
                            data: [
                                {
                                    name: 'Chưa hoàn thành ({{$todo->chuahoanthanh}})',
                                    y: $chuahoanthanh,
                                    color: '#ddd'
                                },
                                {
                                    name: 'Đạt yêu cầu ({{$todo->viechoanthanh}})',
                                    y: $viechoanthanh,
                                    color: 'green'
                                },
                                {
                                    name: 'Chờ duyệt ({{$todo->chopheduyet}})',
                                    y: $chopheduyet,
                                    color: '#3097d1'
                                },
                                {
                                    name: 'Trễ hạn ({{$todo->viectredeadline}})',
                                    y: $viectredeadline,
                                    color: '#a94442'
                                },
                                {
                                    name: 'Không đạt ({{$todo->vieckhongdat}})',
                                    y: $vieckhongdat,
                                    color: '#f31410',
                                    sliced: true,
                                    selected: true,
                                }
                            ]
                        }
                    ]
                });
                </script>
            </div>

        </div>
        <div class="panel-footer"><strong>Tổng số việc đã giao: {{$todo->tongviecdagiao}} </strong></div>
    </div>

</div>

@include('taskdetail.add',['todo'=>$todo,'view'=>'todo'])
@include('taskdetail.users',['todo'=>$todo,'view'=>'todo'])
@endforeach
@endif

@endsection