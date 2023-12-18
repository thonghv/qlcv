<div class="modal fade" id="popupmanageusersdetail_{{$todo->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-horizontal" method="post" action="{{url('/taskdetail/updateUserManage')}}" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Nhân viên thuộc {{$todo->todo}}</h4>
                </div>

                <div class="modal-body">
                    <div class="col-m-12">

                        {{ csrf_field() }}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="70">Họ Tên</th>
                                    <th width="30%">Quản Lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todo->users as $u)
                                <tr>
                                    <td>{{$u->name}}</td>
                                    <td>
                                        @if ($u->is_manager === 1)
                                        <input class="myCheckbox" name="{{$todo->id}}_{{$u->id}}" checked="checked" type="checkbox" value="1">
                                        @endif
                                        @if ($u->is_manager === 0)
                                        <input class="myCheckbox" name="{{$todo->id}}_{{$u->id}}" type="checkbox" value="1">
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach

                        </table>
                        <input type="hidden" id="id_todo" name="id_todo" value="{{$todo->id}}">
                        <input type="hidden" id="managers_user_by_task_{{$todo->id}}" name="managers_user_id" value="{{$todo->managers}}">

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-md-5">
                            <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-floppy-disk"></span> Lưu</button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
        <!-- JavaScript Code -->
        <script>
            // Lấy tất cả các checkbox theo class
            var checkboxes = document.querySelectorAll('.myCheckbox');

            // Thêm sự kiện click listener cho từng checkbox
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('click', function() {

                    var arrTemp = checkbox.name.split('_');
                    var inputElement = document.getElementById('managers_user_by_task_' + arrTemp[0]);
                    console.log('Checkbox được chọn:', inputElement);
                    var userIds = JSON.parse(inputElement.value);

                    var uId = arrTemp[1];
                    
                    if (checkbox.checked) {
                        if (!userIds.includes(uId)) {
                            userIds.push(uId);
                        }
                    } else {
                        if (userIds.includes(uId)) {
                            var indexToRemove = userIds.indexOf(uId);
                            if (indexToRemove !== -1) {
                                userIds.splice(indexToRemove, 1);
                            }
                        }

                    }

                    inputElement.value = JSON.stringify(userIds);;
                });
            });
        </script>>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="popupremovetask_{{$todo->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-horizontal" method="post" action="{{url('/taskdetail/removeTask')}}" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Bạn có chắc chắn muốn xóa phòng ban {{$todo->todo}} ?</h4>
                    {{ csrf_field() }}
                    <input type="hidden" id="id_todo" name="id_todo" value="{{$todo->id}}">
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-md-5">
                            <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-floppy-disk"></span> Xóa</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>