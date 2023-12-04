@extends('layouts.app')
@section('title', 'Bệnh viện đa khoa Bình Định')
@section('content')
<div class="row">
    <div class="col-md-6">
        <h3>Báo cáo KPI</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="p-container">
            @if($todos != false)

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Phòng ban</th>
                        <th scope="col">CV (KPI)</th>
                        <th scope="col">CV (Trước hạn)</th>
                        <th scope="col">CV (Đúng hạn)</th>
                        <th scope="col">CV (Trễ hạn)</th>
                        <th scope="col">Kết quả</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todos as $todo)
                    @if($todo->ketqua == 'Đúng Hạn')
                    <tr class="r-info">
                    @endif
                    @if($todo->ketqua == 'Trước Hạn')
                    <tr class="r-success">
                    @endif
                    @if($todo->ketqua == 'Trễ Hạn')
                    <tr class="r-error">
                    @endif
                        <th scope="row">{{$todo->todo}}</th>
                        <th scope="row">{{$todo->viecdagiao}}</th>
                        <td>{{$todo->viectruocdeadline}}</td>
                        <td>{{$todo->viecdungdeadline}}</td>
                        <td>{{$todo->viectredeadline}}</td>
                        <td><strong>{{$todo->ketqua}}</strong></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @endif
        </div>
    </div>
</div>
@endsection