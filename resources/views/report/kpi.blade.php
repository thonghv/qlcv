@extends('layouts.app')
@section('title', 'Bệnh viện đa khoa Bình Định')
@section('content')
<div class="row">
    <div class="col-md-6">
        <h3>Báo cáo KPI</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
            <label class="form-check-label" for="exampleRadios1">
                Theo Quý
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option2">
            <label class="form-check-label" for="exampleRadios1">
                Từ ngày ... Đến ngày
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <button type="submit" class="btn btn-primary" style="float: right;">
                                    Thống Kê
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

<div class="row" id="div1">
    <div class="col-md-6">
        <div class='col-sm-6'>
        <select id='permission' name="permission" class="input-large form-control">
                                    <option value="q1" selected="selected">Quý 1</option>
                                    <option value="q2">Quý 2</option>
                                    <option value="q3">Qúy 3</option>
                                    <option value="q4">Quý 4</option>
                                </select>
        </div>
    </div>
</div>
<div class="row" id="div2" style="display: none">
    <div class="col-md-6">
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#datetimepicker1').datetimepicker({
                        locale: 'vi'
                    });
                });
            </script>
        </div>
    
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker2'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#datetimepicker2').datetimepicker({
                        locale: 'vi'
                    });
                });
            </script>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="p-container">
            @if($todos != false)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">
                            Phòng ban
                        </th>
                        <th scope="col">Nhiệm vụ</th>
                        <th scope="col">CV (Trước hạn)</th>
                        <th scope="col">CV (Đúng hạn)</th>
                        <th scope="col">CV (Trễ hạn)</th>
                        <th scope="col">CV (Chưa HT)</th>
                        <th scope="col">Kết quả</th>
                    </tr>
                </thead>
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
            </table>

            @endif
        </div>
    </div>
</div>
@endsection