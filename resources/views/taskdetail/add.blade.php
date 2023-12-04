<div class="modal fade" id="popupnewtaskdetail_{{$todo->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-horizontal" method="post" action="{{url('/taskdetail/create')}}" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Giao việc cho {{$todo->todo}}</h4>
                </div>

                <div class="modal-body">

                    <div class="col-m-12">


                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="title" class="col-sm-4 control-label">Tiêu đề công việc</label>
                            <div class="col-md-6">
                                <textarea type="text" class="form-control" id="title" name="title"
                                          placeholder="Nhập tiêu đề công việc"></textarea>
                                <input type="hidden" id="view" name="view" value="{{$view}}">
                                <input type="hidden" id="id_todo" name="id_todo" value="{{$todo->id}}">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                                                <strong>{{ $errors->first('title') }}</strong>
                                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content_task" class="col-sm-4 control-label">Mô tả chi tiết công việc</label>
                            <div class="col-md-6">
                                <textarea type="text" class="form-control" id="content_task" name="content_task"
                                          placeholder="Mô tả chi tiết công việc"></textarea>
                                @if ($errors->has('content_task'))
                                    <span class="help-block">
                                                                <strong>{{ $errors->first('content_task') }}</strong>
                                                            </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="deadline" class="col-sm-4 control-label">Hạn xử lý</label>
                            <div class="col-md-6" >
                                <div class="input-group date"  id='datetimepicker{{$todo->id}}' data-provide="datepicker">
                                    <input name="deadline" type="text" class="form-control">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                </div>
                                <script >
                                    $(function(e){
                                        $('#datetimepicker{{$todo->id}}').datetimepicker({
                                            locale: 'vi',
                                            viewMode: 'days',
                                            format: 'DD/MM/YYYY'
                                        });
                                    });
                                </script>
                                @if ($errors->has('deadline'))
                                    <span class="help-block">
                                                                <strong>{{ $errors->first('deadline') }}</strong>
                                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="deadline" class="col-sm-4 control-label">Tính KPI</label>
                            <div class="col-md-6" >
                                <input name="is_kpi" checked type="checkbox" value="1">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <input type="file" name="file[]" multiple><br />
                                {{--<div class="fileupload fileupload-new" data-provides="fileupload">
                                    <span class="btn btn-primary btn-file"><span class="fileupload-new">Đính kèm file</span>
                                     <span class="fileupload-exists">Đổi file</span>
                                        <input id='fileupload' name="fileupload[]"  type="file"/></span>
                                    <span class="fileupload-preview"></span>
                                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload"
                                       style="float: none">×</a>
                                </div>--}}

                            </div>
                        </div>
                        {{--<div class="form-group">
                          <label for="category" class="col-sm-2 control-label">Category</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="category" name="category" placeholder="category" value="{{$todo->category}}">
                           @if ($errors->has('category'))
                                                          <span class="help-block">
                                                              <strong>{{ $errors->first('category') }}</strong>
                                                          </span>
                           @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="category" class="col-sm-2 control-label">Description</label>
                          <div class="col-md-5">
                            <textarea class="form-control" id="description" name="description" placeholder="description">{{$todo->description}}</textarea>
                           @if ($errors->has('description'))
                                                          <span class="help-block">
                                                              <strong>{{ $errors->first('description') }}</strong>
                                                          </span>
                           @endif
                          </div>
                        </div>--}}


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
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
