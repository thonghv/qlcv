@extends('layouts.app')
@section('title', "Bệnh viện đa khoa Bình Định")
@section('content')
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

<div class="col-md-3">
    <div class="panel panel-primary">
        <div class="panel-heading">
            {{-- <h4>{{title_case($todo->todo)}}</h4>--}}

            <a href="{{'/taskdetail/'.$todo->id}}">
                <h4>{{$todo->todo}}</h4>
            </a>


            <!-- Split button -->
            <div class="icon-right" style="">
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
                <div class="col-md-6">
                    Việc đã giao : <strong>{{$todo->viecdagiao}}</strong>
                </div>
                <div class="col-md-6">
                    Việc chờ duyệt : <strong>{{$todo->chopheduyet}}</strong>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Việc trễ hạn : <strong style="color: #a94442">{{$todo->viectredeadline}}</strong>
                </div>
                <div class="col-md-6">
                    Việc không đạt : <strong style="color: #f31410">{{$todo->vieckhongdat}}</strong>
                </div>
            </div>

        </div>
        <div class="panel-footer"><strong>Tổng số việc đã làm:</strong> {{$todo->tongsodauviec}}</div>
    </div>

</div>

@include('taskdetail.add',['todo'=>$todo,'view'=>'todo'])
@include('taskdetail.users',['todo'=>$todo,'view'=>'todo'])
@endforeach
@endif

@endsection