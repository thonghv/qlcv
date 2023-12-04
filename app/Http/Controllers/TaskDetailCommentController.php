<?php

namespace App\Http\Controllers;


use App\Model\TaskDetailComment;
use App\Model\TaskDetail;
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
class TaskDetailCommentController extends Controller
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

        $type = $request->type;

        $comment = new TaskDetailComment();
        $comment->id_task_detail =$request->id_task_detail;
        $comment->id_user =Auth::user()->id;
        $comment->comment =$request->comment;
        $comment->type =$type;
        $comment->date_comment == new DateTime;
        $comment->save();


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

        //dd('update');

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

}
