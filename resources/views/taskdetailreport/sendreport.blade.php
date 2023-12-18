<div class="modal fade" id="popupnewsendreport_{{$task_detail->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-horizontal" method="post" action="{{url('/taskdetail/report/'.$task_detail->id)}}" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Gửi báo cáo</h4>
                </div>

                <div class="modal-body">

                    <div class="col-m-12">


                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="title" class="col-sm-4 control-label">Nội dung</label>
                            <div class="col-md-6">
                                <textarea type="text" class="form-control" id="comment" name="comment"
                                          placeholder="Nội dung"></textarea>

                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                                                <strong>{{ $errors->first('comment') }}</strong>
                                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <input type="file" name="file[]" multiple><br />
                                {{--<div class="fileupload fileupload-new" data-provides="fileupload">
                                    <span class="btn btn-primary btn-file"><span class="fileupload-new">Đính kèm file</span>
                                     <span class="fileupload-exists">Đổi file</span>
                                        <input id='fileupload' name="fileupload"  type="file"/></span>
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


<div class="modal fade" id="popupremovecv_{{$task_detail->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-horizontal" method="post" action="{{url('/taskdetail/removecv')}}" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Bạn có chắc chắn muốn xóa công việc {{$task_detail->title}} ?</h4>
                    {{ csrf_field() }}
                    <input type="hidden" id="id_task" name="id_task" value="{{$task_detail->id}}">
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
