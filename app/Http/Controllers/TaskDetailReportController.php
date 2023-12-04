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
class TaskDetailReportController extends Controller
{


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

        $todo_id = $request->idtask;

        //
       // $result = TaskDetail::where('id_task', '=', $todo_id)->orderBy('created_at', 'desc');
        $result_report= TaskDetail::where('id_task', '=', $todo_id)->where('status','=','REPORT')->orderBy('created_at', 'desc')->get();
        $result_dth= TaskDetail::where('id_task', '=', $todo_id)->where('status','=','CREATE')->orderBy('created_at', 'desc')->orWhere('status', 'REOPEN') ->get();
        $result_done= TaskDetail::where('id_task', '=', $todo_id)->where('status','=','DONE')->orderBy('created_at', 'desc')->get();
        $todo = Todo::find($todo_id);
        //dd($result);
        //$result = Auth::user()->todo()->get();
        if($result_report->isEmpty()){
            $result_report = false;
        }
        if($result_dth->isEmpty()){
            $result_dth = false;
        }
        if($result_done->isEmpty()){
            $result_done = false;
        }
            return view('taskdetail.list',['todo'=>$todo,
                                                    'result_dth'=>$result_dth,
                                                    'result_report'=>$result_report,
                                                    'result_done'=>$result_done]);

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

    public function reject(Request $request)
    {
        $type = $request->type;
        $id_task_detail = $request->id_task_detail;

            $detail= TaskDetail::find($id_task_detail);
            $detail->status = "REJECT";
            $detail->count_retask = $detail->count_retask + 1;
            $detail->is_read = false;
            if(!empty($request->deadline))
            {
                $detail->deadline = Carbon::createFromFormat('d/m/Y',$request->deadline);
            }
            $detail->save();

            $detailReport =  TaskDetailReport::where('id_task_detail',$id_task_detail)->orderBy('count_report', 'desc')->first();
            $detailReport->comment_reject= $request->comment;
            $detailReport->date_reject = new DateTime;
            $detailReport->id_user_reject = Auth::user()->id;
            $detailReport->save();

        return \Redirect::back()->with('message','Operation Successful !');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request)
    {

        $id_task_detail = $request->id_task_detail;

        //update trang thai là báo cao cho task
        $detail= TaskDetail::find($id_task_detail);
        $detail->status = "REPORT";
        $detail->is_read = false;
        $detail->save();

        //dd($id_task_detail);
        //Update count report
        $count = TaskDetailReport::where('id_task_detail','=',$id_task_detail)->max('count_report');
        if(is_null($count))
        {
            //dd($count);
            $count = 0;
        }
        $detailReport = new TaskDetailReport();
        $detailReport->id_task_detail = $id_task_detail;
        $detailReport->id_user = Auth::user()->id;
        $detailReport->date_report = new DateTime;
        $detailReport->count_report = $count+1;
        $detailReport->comment_report= $request->comment;
        //dd($request->comment);
        $detailReport->save();


        $files = $request->file('file');

        if(!empty($files)):
            foreach($files as $file):

                $filename = $file->store('upload');
                TaskDetailFile::create([
                    'id_detail_report'=>$detailReport->id,
                    'id_user'=>Auth::user()->id,
                    'name_file'=>$file->getClientOriginalName(),
                    'file'=> $file->hashName()

                ]);

            endforeach;

        endif;

        return \Redirect::back()->with('message','Operation Successful !');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
       dd($todo->id);
        $todo_id = $todo->id;

        //
        $result = TaskDetail::where('id_task', '=', $todo_id)->get();
        $todo = Todo::find($todo_id);
        //dd($result);
        //$result = Auth::user()->todo()->get();
        if(!$result->isEmpty()){
            return view('taskdetail.list',['taskdetail'=>$result,'todo'=>$todo]);
        }else{
            return view('taskdetail.list',['taskdetail'=>false,'todo'=>$todo]);
        }
        //return view('todo.todo',['todo' => $todo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        return view('todo.edittodo',['todo' => $todo]);
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
       TaskDetail::where('id', '=', $request->task_id)->update(['status' => 'DONE']);
        return 'true';

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        if($todo->delete()){
            return back();
        }
    }

    public function writelog($description,$type)
    {

        $log= new TaskDetailLog();
        $log->description = $description;
        $log->type = $type;
    }

}
