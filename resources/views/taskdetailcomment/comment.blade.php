<div class="modal fade" id="popupnewcomment_{{$task_detail->id}}_{{$type}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
       <?php
            $title="Bình luận";
            $label="Bình luận";
            $url= url('/taskdetail/comment');
            if($type=='REJECT')
            {
                $title="Lý do không đạt";
                $label="Lý do không đạt";
                $url= url('/taskdetail/reject');
            }

       ?>



        <form class="form-horizontal" method="post" action="{{$url}}">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title">{{$title}}</h4>


                </div>

                <div class="modal-body">

                    <div class="col-m-12">


                        {{ csrf_field() }}

                        <div class="form-group">

                                <label for="title" class="col-sm-4 control-label">{{$label}}</label>

                            <div class="col-md-6">
                                <textarea type="text" class="form-control" id="comment" name="comment"
                                          placeholder="Nội dung"></textarea>
                                <input type="hidden" id="id_task_detail" name="id_task_detail" value="{{$task_detail->id}}">
                                <input type="hidden" id="type" name="type" value="{{$type}}">
                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                       <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @if($type=='REJECT')
                            <div class="form-group">
                                <label for="deadline" class="col-sm-4 control-label">Hạn xử lý</label>
                                <div class="col-md-6" >
                                    <div class="input-group date"  id='datetimepicker{{$task_detail->id}}' data-provide="datepicker">
                                        <input name="deadline" type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-calendar"></i>
                                        </span>
                                    </div>
                                    <script >
                                        $(function(e){
                                            $('#datetimepicker{{$task_detail->id}}').datetimepicker({

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
                        @endif
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
