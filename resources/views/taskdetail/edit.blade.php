<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-horizontal" method="post" action="{{url('/todo/'.$todo->id)}}">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Chỉnh sửa phòng ban</h4>
            </div>
            <div class="modal-body">

                <div class="col-m-6">


                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="todo" class="col-sm-2 control-label">Todo</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="todo" name="todo" placeholder="todo"
                                       value="{{$todo->todo}}">
                                @if ($errors->has('todo'))
                                    <span class="help-block">
                                                                <strong>{{ $errors->first('todo') }}</strong>
                                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category" class="col-sm-2 control-label">Category</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="category" name="category"
                                       placeholder="category" value="{{$todo->category}}">
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
                                <textarea class="form-control" id="description" name="description"
                                          placeholder="description">{{$todo->description}}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                                                <strong>{{ $errors->first('description') }}</strong>
                                                            </span>
                                @endif
                            </div>
                        </div>


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
