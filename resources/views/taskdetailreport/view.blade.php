<div class="modal fade" id="popupviewreport_{{$task_detail->id}}" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-horizontal" method="post" action="{{url('/taskdetail/create')}}">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Báo cáo</h4>
                </div>

                <div class="modal-body">
                    @foreach ($task_detail_report as $rp)
                        <?php
                        $file = $rp['file_report'];
                        $report = $rp['report'];
                        $user_report = \App\User::find($report->id_user)->name;
                        ?>
                        <div class="col-m-12">


                            {{ csrf_field() }}

                            <ul class="media-list">

                                <li class="media">

                                    <div class="media-body">

                                        <div class="media">
                                            <a class="pull-left" href="#">
                                                <img class="media-object img-circle " src="assets/img/user.png">
                                            </a>
                                            <div class="media-body">
                                                {{$report->comment_report}}
                                                <br>
                                                <small class="text-muted">{{$user_report}} | {{$report->date_report}}
                                                    <br/>
                                                    @foreach($file as $fl)
                                                        <a href="{{ url('/download/'.$fl->file.'/'.$fl->name_file)  }}">{{$fl->name_file}}</a> |
                                                    @endforeach

                                                </small>


                                                <hr>
                                            </div>
                                        </div>

                                    </div>
                                </li>
                                @if( !empty($report->id_user_reject) )
                                    <?php
                                    $user_reject = \App\User::find($report->id_user_reject)->name;
                                    ?>
                                    <li class="media">

                                        <div class="media-body">

                                            <div class="media text-right">
                                                <a class="pull-right" href="#">
                                                    <img class="media-object img-circle " src="assets/img/user.gif">
                                                </a>
                                                <div class="media-body">
                                                    {{$report->comment_reject}}
                                                    <br>
                                                    <small class="text-muted">{{$user_reject}}
                                                        | {{$report->date_reject}} </small>
                                                    <hr>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                @endif

                            </ul>


                        </div>
                    @endforeach
                </div>

            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
