<?php

namespace App\Http\Controllers;

use App\Model\TaskDetail;
use App\Model\TaskDetailReport;
use App\Model\TaskDetailFile;
use App\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Illuminate\Support\Facades\Route;
use App\Enum;
use Carbon\Carbon ;
use Storage;
class TaskDetailController extends Controller
{

    public function accessToken(Request $request)
    {
        $validate = $this->validations($request,"login");
        if($validate["error"]){
            return $this->prepareResult(false, [], $validate['errors'],"Error while validating user");
        }
        $user = User::where("email",$request->email)->first();
        if($user){
            if (Hash::check($request->password,$user->password)) {
                return $this->prepareResult(true, ["accessToken" => $user->createToken('Todo App')->accessToken], [],"User Verified");
            }else{
                return $this->prepareResult(false, [], ["password" => "Wrong passowrd"],"Password not matched");
            }
        }else{
            return $this->prepareResult(false, [], ["email" => "Unable to find user"],"User not found");
        }

    }
    private function prepareResult($status, $data, $errors,$msg)
    {
        return ['status' => $status,'data'=> $data,'message' => $msg,'errors' => $errors];
    }
    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $todo_id = $request->id_todo;


        //Get report
        $array_report =  array();
        $result_report= TaskDetail::where('id_todo', '=', $todo_id)->where('status','=','REPORT')
                                    ->orderBy('updated_at', 'desc')
                                    ->get();
        foreach ($result_report as $rs_report) {
            $report = $rs_report->taskDetailReport()->orderBy('count_report', 'desc')->get();
            $report_ar =  array();
            foreach ($report as $rp )
            {
                $file_rp = $rp->taskDetailFile()->orderBy('created_at', 'desc')->get();
                $report_ar[]=['report'=>$rp,
                            'file_report'=> $file_rp];
            }
            $log = $rs_report->taskDetailLog()->orderBy('created_at', 'desc')->get();
            $file = $rs_report->taskDetailFile()->orderBy('created_at', 'desc')->get();
            $comment = $rs_report->taskDetailComment()->orderBy('created_at', 'asc')->get();

            // $rs_report->status_report = -1;
            // if($rs_report->status == 'DONE') {
            //     $ngay = Carbon::parse($rs_report->);
            //     $rs_report->status_report = 1;
            // }
            // dd($rs_report);

            $array_report[] = ['task_detail'=>$rs_report,
                                'task_detail_log'=>$log,
                                'task_detail_file'=>$file,
                                'task_detail_comment'=>$comment,
                                'task_detail_report'=>$report_ar ];

        }

        //dd($array_report,$result_report);


        //Get dth
        $array_dth =  array();
        $result_dth= TaskDetail::where('id_todo', '=', $todo_id)->where(function ($query) {
                                                $query->where('status','=','CREATE')->orWhere('status', 'REJECT');
                                            })->orderBy('updated_at', 'desc')->get();

        foreach ($result_dth as $rs_dth) {
            $report = $rs_dth->taskDetailReport()->orderBy('count_report', 'desc')->get();
            $report_ar =  array();
            foreach ($report as $rp )
            {
                $file_rp = $rp->taskDetailFile()->orderBy('created_at', 'desc')->get();
                $report_ar[]=['report'=>$rp,
                    'file_report'=> $file_rp];
            }
            $log = $rs_dth->taskDetailLog()->orderBy('created_at', 'desc')->get();
            $file = $rs_dth->taskDetailFile()->orderBy('created_at', 'desc')->get();
            $comment = $rs_dth->taskDetailComment()->orderBy('created_at', 'asc')->get();


            $array_dth[] = ['task_detail'=>$rs_dth,
                'task_detail_log'=>$log,
                'task_detail_file'=>$file,
                'task_detail_comment'=>$comment,
                'task_detail_report'=>$report_ar ];

        }

        //Get dth
        $array_done =  array();
        $result_done= TaskDetail::where('id_todo', '=', $todo_id)->where('status','=','DONE')->orderBy('updated_at', 'desc')->get();
        foreach ($result_done as $rs_done) {
            $report = $rs_done->taskDetailReport()->orderBy('count_report', 'desc')->get();
            $report_ar =  array();
            foreach ($report as $rp )
            {
                $file_rp = $rp->taskDetailFile()->orderBy('created_at', 'desc')->get();
                $report_ar[]=['report'=>$rp,
                    'file_report'=> $file_rp];
            }
            $log = $rs_done->taskDetailLog()->orderBy('created_at', 'desc')->get();
            $file = $rs_done->taskDetailFile()->orderBy('created_at', 'desc')->get();
            $comment = $rs_done->taskDetailComment()->orderBy('created_at', 'asc')->get();


            $array_done[] = ['task_detail'=>$rs_done,
                'task_detail_log'=>$log,
                'task_detail_file'=>$file,
                'task_detail_comment'=>$comment,
                'task_detail_report'=>$report_ar ];

        }

        $todo = Todo::find($todo_id);
        //dd($result);
        //$result = Auth::user()->todo()->get();

            return view('taskdetail.list',['todo'=>$todo,
                                                    'result_dth'=>$array_dth,
                                                    'result_report'=>$array_report,
                                                    'result_done'=>$array_done]);

    }

    /**
     * Get a validator for an incoming Todo request.
     *
     * @param  array  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $request)
    {
        return Validator::make($request, [
            'todo' => 'required'
        ]);
    }    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.addtodo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_todo = $request->id_todo;
        $isKpi = 1;
        if($request->is_kpi == null) {
            $isKpi = 0;
        }
        $detail= new TaskDetail();
        $detail->id_todo=$id_todo;
        $detail->title=$request->title;
        $detail->is_kpi=$isKpi;
        $detail->content_task=$request->content_task;
        if(!empty($request->deadline)) {
            $detail->deadline = Carbon::createFromFormat('d/m/Y', $request->deadline);
        }
        //$detail->content_task=$request->content_task;
        $detail->date_create = new DateTime;
        $detail->status = "CREATE";
        $detail->is_read = false;
        $detail->save();


        $files = $request->file('file');

        if(!empty($files)):
            foreach($files as $file):

                $filename = $file->store('upload');
                TaskDetailFile::create([
                    'id_task_detail'=>$detail->id,
                    'id_user'=>Auth::user()->id,
                    'name_file'=>$file->getClientOriginalName(),
                    'file'=> $file->hashName()

                ]);

            endforeach;

        endif;


        //dd($files);


        //dd($detail);


        return \Redirect::back()->with('message','Operation Successful !');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateUserManage(Request $request)
    {
        $id_todo = $request->id_todo;

        Todo::where('id', $id_todo)
        ->update(['managers' => $request->managers_user_id]);

        return \Redirect::back()->with('message','Operation Successful !');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskDetail $taskDetail)
    {

        dd('update');

        $this->validator($request->all())->validate();
        if($taskDetail->fill($request->all())->save()){
            $result = Auth::user()->todo()->get();
            if(!$result->isEmpty()){
                return view('todo.todo',['todos'=>$result,'image'=>Auth::user()->userimage]);
            }else{
                return view('todo.todo',['todos'=>false,'image'=>Auth::user()->userimage]);
            }

        }
    }
    public function success(Request $request)
    {
        //dd($request->task_id);
        $id_task_detail= $request->id_task_detail;

        $taskDetail= TaskDetail::find($id_task_detail);
        //dd($id_task_detail);


        if($taskDetail->deadline > $taskDetail->taskDetailReport()->orderBy('count_report','desc')->first()->date_report)
        {
            $taskDetail->update(['status' => 'DONE','late_deadline'=>'true']);
        }
        else
        {
            $taskDetail->update(['status' => 'DONE','late_deadline'=>'true']);
        }


        $detailReport =  TaskDetailReport::where('id_task_detail',$id_task_detail)->orderBy('count_report', 'desc')->first();
        $detailReport->comment_reject= "Đạt";
        $detailReport->date_reject = new DateTime;
        $detailReport->id_user_reject = Auth::user()->id;
        $detailReport->save();
        return 'true';

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        /*if($todo->delete()){
            return back();
        }*/
    }

    public function download( $filename = '',$name='' )
    {
        // Check if file exists in app/storage/file folder
        $file_path = storage_path() . "/app/public/upload/" . $filename;
        $headers = array(
            'Content-Disposition: attachment; filename=' . $filename,
        );
        if (file_exists($file_path)) {
            // Send Download
            return \Response::download($file_path, $name, $headers);
        } else {
            // Error
            exit('Requested file does not exist on our server!');
        }
    }
}
