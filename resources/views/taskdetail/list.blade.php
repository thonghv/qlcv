@extends('layouts.app')
@section('title', 'Bệnh viện đa khoa Bình Định')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <span class="glyphicon glyphicon-triangle-right"></span>
            <a class="secondary-content" href="{{url('/todo')}}">
                <span style="font-size: 18px;font-weight: 500;">{{$todo->todo}}</span>
            </a>


        </div>
        <div class="col-md-6 text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#popupnewtaskdetail_{{$todo->id}}">
                Thêm công việc <span class="glyphicon glyphicon-plus"></span>
            </button>


        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation">
                    <a href="#tab1" aria-controls="home" role="tab" data-toggle="tab">
                        <span class="glyphicon glyphicon-cloud"></span> Công việc thực hiện
                    </a>
                </li>
                <li role="presentation" class="active">
                    <a href="#tab2" aria-controls="profile" role="tab" data-toggle="tab">
                        <span class="glyphicon glyphicon-envelope"></span> Công việc chờ duyệt
                    </a>
                </li>
                <li role="presentation">
                    <a href="#tab3" aria-controls="profile" role="tab" data-toggle="tab">
                        <span class="glyphicon glyphicon-search"></span> Công việc hoàn thành
                    </a>
                </li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">

                <div role="tabpanel" class="tab-pane"
                     id="tab1">@include('taskdetail.listdetail',['taskdetail'=>$result_dth,'type'=>'dth'])</div>
                <div role="tabpanel" class="tab-pane active"
                     id="tab2">@include('taskdetail.listdetail',['taskdetail'=>$result_report, 'type'=>'report'])</div>
                <div role="tabpanel" class="tab-pane"
                     id="tab3">@include('taskdetail.listdetail',['taskdetail'=>$result_done,'type'=>'done'])</div>
            </div>
        </div>
        {{--<div class="col-md-3">
            <img class="img-responsive img-circle" src="{{asset('storage/'.$image)}}">
        </div>--}}
    </div>
    @include('taskdetail.add',['todo'=>$todo,'view'=>'taskdetail'])
@endsection