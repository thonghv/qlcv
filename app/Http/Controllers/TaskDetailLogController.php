<?php

namespace App\Http\Controllers;

use App\Model\TaskDetail;
use App\Model\TaskDetailLog;
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
class TaskDetailLogController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $detail= new TaskDetail();
        $detail->id_task=$request->id_task;
        $detail->title=$request->title;
        $detail->content_task=$request->content_task;
        $detail->deadline=Carbon::createFromFormat('d/m/Y',$request->deadline);
        //$detail->content_task=$request->content_task;
        $detail->date_create = new DateTime;
        $detail->status = "CREATE";
        $detail->is_read = false;
        //dd($detail);
        $detail->save();

        //Cong them 1 cong viec vao todo
        $todo = Todo::find($request->id_task);

        $todo->viecdagiao = $todo->viecdagiao + 1;
        $todo->save();


        return \Redirect::back()->with('message','Operation Successful !');


       /* $result_report= TaskDetail::where('id_task', '=', $request->id_task)->where('status','=','REPORT')->orderBy('created_at', 'desc')->get();
        $result_dth= TaskDetail::where('id_task', '=', $request->id_task)->where('status','=','CREATE')->orderBy('created_at', 'desc')->orWhere('status', 'REOPEN') ->get();
        $result_done= TaskDetail::where('id_task', '=', $request->id_task)->where('status','=','DONE')->orderBy('created_at', 'desc')->get();
        $todo = Todo::find($request->id_task);

        $todo->viecdagiao = $todo->viecdagiao + 1;
        $todo->save();
        //dd($result);
        //$result = Auth::user()->todo()->get();

        return view('taskdetail.list',['todo'=>$todo,
            'result_dth'=>$result_dth,
            'result_report'=>$result_report,
            'result_done'=>$result_done]);*/
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
