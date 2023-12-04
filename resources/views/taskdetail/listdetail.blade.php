<div id="tabdagiaiquyet">
    <div class="row">
        <div class="col-md-12">
            <ul class="list-group">

                <?php $i = 0;

                ?>
                @if($taskdetail != false && count($taskdetail) > 0)
                @foreach ($taskdetail as $array)
                <?php $i++;

                $task_detail = $array['task_detail'];
                $task_detail_log = $array['task_detail_log'];
                $task_detail_file = $array['task_detail_file'];
                $task_detail_comment = $array['task_detail_comment'];
                $task_detail_report = $array['task_detail_report'];

                ?>
                <li class="list-group-item">

                    <table class="table_task">
                        <thead>
                            <tr>
                                <th width="2%"> {{$i.'.'}}</th>
                                <th width="30%"><strong>{{$task_detail->title}}</strong><br /></th>
                                <th width="30%" style="color: red">
                                    @if($task_detail->status =="REJECT")
                                    Làm lại lần {{$task_detail->count_retask}} -
                                    <a href="#" data-toggle="modal" data-target="#popupviewreport_{{$task_detail->id}}">Xem chi tiết</a>
                                    @endif
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>Nội dung: {{$task_detail->content_task}}</td>
                                <td>
                                    @if(count($task_detail_file) > 0)
                                    <small class="text-muted"> File Đính kèm:<br />
                                        @foreach($task_detail_file as $file)

                                        <a href="{{ url('/download/'.$file->file.'/'.$file->name_file)  }}">
                                            {{ str_limit($file->name_file, $limit = 30, $end = '...') }}
                                        </a>
                                        <br />

                                        @endforeach
                                    </small>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>

                                </td>
                                <td @if($task_detail->deadline < date("Y-m-d") && $type !='done' ) style="color: red" @endif @if($task_detail->late_deadline)
                                        style="color: red"
                                        @endif
                                        >
                                        Ngày hết hạn: {{Carbon\Carbon::parse($task_detail->deadline)->format('d/m/Y')}}

                                </td>
                            </tr>
                        </tbody>
                    </table>

                    @if(count($task_detail_report)>0)
                    <?php
                    $rp = $task_detail_report[count($task_detail_report) - 1];
                    $report = $rp['report'];
                    $file = $rp['file_report'];
                    ?>
                    <table class="table-report" style="max-width: 600px">
                        <thead>
                            <tr>

                                <th width="30%" colspan="2">
                                    <a href="#" data-toggle="modal" data-target="#popupviewreport_{{$task_detail->id}}">
                                        <strong>Báo cáo lần {{$report->count_report}}</strong></a>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>{{$report->comment_report}}</td>
                                <td>
                                </td>
                            </tr>
                            <tr>

                                <td>
                                    @if(count($file)>0)

                                    <small class="text-muted"> File Đính kèm:
                                        @foreach($file as $fl)
                                        <a href="{{ url('/download/'.$fl->file.'/'.$fl->name_file)  }}">
                                            {{ str_limit($fl->name_file, $limit = 10, $end = '...') }}
                                        </a>
                                        |
                                        @endforeach
                                    </small>
                                    @endif
                                </td>
                                <td>
                                    Nộp báo cáo ngày: {{Carbon\Carbon::parse($report->date_report)->format('d/m/Y')}}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    @endif

                    <div class="main_detail">
                        <div style=" position: absolute;right:20px;top:5px;">
                            @if ($type == 'done')
                                @if(Carbon\Carbon::parse($report->date_report) < Carbon\Carbon::parse($task_detail->deadline))
                                    <span class="label label-success">Hoàn Thành Trước Hạn</span>
                                @endif
                                @if(Carbon\Carbon::parse($report->date_report) > Carbon\Carbon::parse($task_detail->deadline))
                                    <span class="label label-danger">Hoàn Thành Trễ Hạn</span>
                                @endif
                                @if(Carbon\Carbon::parse($report->date_report) == Carbon\Carbon::parse($task_detail->deadline))
                                    <span class="label label-info">Hoàn Thành Đúng Hạn</span>
                                @endif
                            @endif
                            @if (Auth::user()->permission != "MANAGER" && $type == "dth")
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#popupnewsendreport_{{$task_detail->id}}">
                                <span class="glyphicon glyphicon-send"></span> Gửi báo cáo
                            </button>
                            @endif
                            {{-- <button type="button" class="btn btn-default">
                                         <span class="glyphicon glyphicon-comment"></span> Bình luận
                                     </button>--}}
                            @if (Auth::user()->permission != "USER" && $type == 'report')
                            <button id='btndat{{$task_detail->id}}' type="button" class="btn btn-success">
                                <span class="glyphicon glyphicon-ok"></span> Đạt
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#popupnewcomment_{{$task_detail->id}}_REJECT">
                                <span class="glyphicon glyphicon-remove"></span> Không đạt
                            </button>
                            @endif
                        </div>
                    </div>
                </li>

                <script>
                    $(function(e) {
                        $('#btndat{{$task_detail->id}}').click(function() {
                            $.ajax({
                                    method: "POST",
                                    url: "/taskdetail/success",
                                    data: {
                                        _token: "{{ csrf_token() }}",
                                        id_task_detail: "{{$task_detail->id}}"
                                    }
                                })
                                .done(function(msg) {
                                    if (msg == 'true') {
                                        location.reload();
                                    }
                                    //alert( "Công việc đạt yêu cầu. Và sẽ được đóng lại");
                                });
                        });
                    });
                </script>
                @include('taskdetailreport.view',['$task_detail'=>$task_detail,'task_detail_report'=>$task_detail_report])
                @include('taskdetailcomment.comment',['$task_detail'=>$task_detail,'type'=>'REJECT'])
                @include('taskdetailcomment.comment',['$task_detail'=>$task_detail,'type'=>'COMMENT'])
                @include('taskdetailreport.sendreport',['$task_detail'=>$task_detail])
                @endforeach
                @else
                <li class="list-group-item"> Không có công việc
                </li>
                @endif
            </ul>
        </div>

        {{--<div class="col-md-3">
            <img class="img-responsive img-circle" src="{{asset('storage/'.$image)}}">
    </div>--}}
</div>
</div>