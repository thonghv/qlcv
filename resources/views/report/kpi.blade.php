@extends('layouts.app')
@section('title', 'Bệnh viện đa khoa Bình Định')
@section('content')
<div class="row">
    <div class="col-md-6">
        <h3>Báo cáo KPI</h3>
    </div>
</div>
<form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{url('/kpi/report')}}" style="padding: 10px; border: 1px solid #ddd">
{{ csrf_field() }}
<div class="row">
    <div class="col-md-4">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="option" id="exampleRadios1" value="option1" >
            <label class="form-check-label" for="exampleRadios1">
                Theo Quý
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="option" id="exampleRadios1" value="option2" checked>
            <label class="form-check-label" for="exampleRadios1">
                Theo Khoảng Thời Gian
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <button type="submit" class="btn btn-primary" style="float: right;">
                                    Báo Cáo
     </button>
    </div>
    <script>
    // Lấy tất cả các radio button vào một NodeList
    var radioButtons = document.querySelectorAll('input[type="radio"]');
    
    // Lặp qua từng radio button và thêm sự kiện "change"
    radioButtons.forEach(function(radioButton) {
      radioButton.addEventListener('change', function() {
        // Kiểm tra radio button được chọn
        if (radioButton.checked) {
            var myDiv1 = document.getElementById('div1');
            var myDiv2 = document.getElementById('div2');
            if(radioButton.value == "option1") {
                myDiv1.style.display = 'block';
                myDiv2.style.display = 'none';
            }
            if(radioButton.value == "option2") {
                myDiv2.style.display = 'block';
                myDiv1.style.display = 'none';
            }
        }
      });
    });
  </script>
</div>
<div class="row" id="div1" style="display: none">
    <div class="col-md-6">
        <div class='col-sm-6'>
        <select id='permission' name="q" class="input-large form-control">
                                    <option value="1" selected="selected">Quý 1</option>
                                    <option value="2">Quý 2</option>
                                    <option value="3">Qúy 3</option>
                                    <option value="4">Quý 4</option>
                                </select>
        </div>
    </div>
</div>
<div class="row" id="div2">
    <div class="col-md-6">
        <div class='col-sm-5'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" name="fromDate" />
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <script type="text/javascript">
                var currentDate = new Date();
                currentDate.setDate(1);
                $(function () {
                    $('#datetimepicker1').datetimepicker({
                        defaultDate: currentDate.toISOString().split('T')[0],
                        format: 'DD/MM/YYYY',
                        showClose: true,
                        icons: {
                            time: 'glyphicon glyphicon-time',
                            date: 'glyphicon glyphicon-calendar',
                            up: 'glyphicon glyphicon-chevron-up',
                            down: 'glyphicon glyphicon-chevron-down',
                            previous: 'glyphicon glyphicon-chevron-left',
                            next: 'glyphicon glyphicon-chevron-right',
                            today: 'glyphicon glyphicon-screenshot',
                            clear: 'glyphicon glyphicon-trash',
                            close: 'glyphicon glyphicon-remove'
                        }
                    });
                });
            </script>
        </div>
        <div class='col-sm-2'></div>
        <div class='col-sm-5'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker2'>
                    <input type='text' class="form-control" name="toDate"  />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <script type="text/javascript">
                var date = new Date();
                 var lastDay = new Date(date.getFullYear(), date.getMonth() + 1 , 0);
                $(function () {
                    $('#datetimepicker2').datetimepicker({
                        defaultDate: lastDay,
                        format: 'DD/MM/YYYY',
                        showClose: true,
                        icons: {
                            time: 'glyphicon glyphicon-time',
                            date: 'glyphicon glyphicon-calendar',
                            up: 'glyphicon glyphicon-chevron-up',
                            down: 'glyphicon glyphicon-chevron-down',
                            previous: 'glyphicon glyphicon-chevron-left',
                            next: 'glyphicon glyphicon-chevron-right',
                            today: 'glyphicon glyphicon-screenshot',
                            clear: 'glyphicon glyphicon-trash',
                            close: 'glyphicon glyphicon-remove'
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>
</form>

<br>
<div class="row">
    <div class="col-md-12">
    @if($todos == false)
                    <div style="color: red; margin-bottom: 5px">Không có dữ liệu nào được tìm thấy ...</div>
                @endif
        <div class="p-container">
         
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">
                            Phòng ban
                        </th>
                        <th scope="col">Tổng Nhiệm vụ</th>
                        <th scope="col">Nhiệm vụ (Trước hạn)</th>
                        <th scope="col">Nhiệm vụ (Đúng hạn)</th>
                        <th scope="col">Nhiệm vụ (Trễ hạn)</th>
                        <th scope="col">Nhiệm vụ (Chưa hoàn thành)</th>
                        <th scope="col">Kết quả</th>
                    </tr>
                </thead>
                @if($todos != false)
                <tbody>
                    @foreach ($todos as $todo)
                    <tr>
                        <th scope="row">
                            <a href="{{'/taskdetail/'.$todo->id}}">{{$todo->todo}}</a>
                        </th>
                        <th scope="row">{{$todo->viecdagiao}}</th>
                        <td>{{$todo->viectruocdeadline}}</td>
                        <td>{{$todo->viecdungdeadline}}</td>

                        @if($todo->ketqua == 'Trễ Hạn')
                        <td class="r-error">
                        @endif
                        @if($todo->ketqua != 'Trễ Hạn')
                        <td>
                        @endif
                            {{$todo->viectredeadline}}
                        </td>
                        <td>{{$todo->viecchuahoanthanh}}</td>

                        @if($todo->ketqua == 'Đúng Hạn')
                        <td class="r-info">
                            <span class="label label-info">Hoàn Thành Đúng Hạn</span>
                        @endif

                        @if($todo->ketqua == 'Trước Hạn')
                        <td class="r-success">
                            <span class="label label-success">Hoàn Thành Trước Hạn</span>
                        @endif

                        @if($todo->ketqua == 'Trễ Hạn')
                        <td class="r-error">
                            <span class="label label-danger">Hoàn Thành Trễ Hạn</span>
                        @endif
                        </td>
                    
                    </tr>
                    @endforeach
                </tbody>
                @endif
            </table>

           
        </div>
    </div>
</div>
@endsection
