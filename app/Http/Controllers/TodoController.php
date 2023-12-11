<?php

namespace App\Http\Controllers;

use App\Todo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
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
    public function index()
    {
        //dd(abc);
        //$result = Auth::user()->todo()->get();
        // $result = Todo::all();

        $department_ids = [];
        if (Auth::user()->permission == 'ADMIN' || Auth::user()->permission == 'MANAGER') {
            $result = Todo::all();
        } else {
            $department_ids = json_decode(Auth::user()->departments);
            $result = Todo::whereIn('id', $department_ids)->get();
        }

        foreach ($result as $rs) {
            $viecdagiao = $rs->taskDetail()->where('status', '!=', 'DONE')->count();
            $rs->viecdagiao = $viecdagiao;

            $viectredeadline = $rs->taskDetail()->where('status', '!=', 'DONE')
                ->whereDate('deadline', '<', \Carbon::today()->toDateString())->count();
            $rs->viectredeadline = $viectredeadline;

            $vieckhongdat = $rs->taskDetail()->where('status', '=', 'REJECT')->count();
            $rs->vieckhongdat = $vieckhongdat;

            $chopheduyet = $rs->taskDetail()->where('status', '=', 'REPORT')->count();
            $rs->chopheduyet = $chopheduyet;

            $tongsodauviec = $rs->taskDetail()->where('status', '=', 'DONE')->count();
            $rs->tongsodauviec = $tongsodauviec;

            // Get employees belongs to department
            $allUsers = DB::table('users')->where('permission', '=', 'USER')->get();
            // $usersTemp = $this->getUserByDepartmentId($allUsers, $rs->id);
            $managersTemp = json_decode($rs->managers);
            foreach ($allUsers as $us) {
                $idStr = strval($us->id);
                if (in_array($idStr, $managersTemp)) {
                    $us->is_manager = 1;
                } else {
                    $us->is_manager = 0;
                }
            }

            $rs->users = $allUsers;
        }
        // dd($result);
        if (!$result->isEmpty()) {
            return view('todo.todo', ['todos' => $result, 'image' => Auth::user()->userimage]);
        } else {
            return view('todo.todo', ['todos' => $result, 'image' => Auth::user()->userimage]);
        }
    }

    private function getUserByDepartmentId($users, $departmentId)
    {
        $result = [];
        foreach ($users as $u) {
            $departmentIds = json_decode($u->departments);
            if (in_array($departmentId, $departmentIds)) {
                array_push($result, $u);
            }
        }
        return $result;
    }

    /**
     * Get a validator for an incoming Todo request.
     *
     * @param  array $request
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
        //dd('ABC');
        return view('todo.addtodo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        if (Auth::user()->todo()->Create($request->all())) {
            return $this->index();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        return view('todo.todo', ['todo' => $todo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        dd($todo);
        return view('todo.edittodo', ['todo' => $todo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        //dd($todo);
        $this->validator($request->all())->validate();
        if ($todo->fill($request->all())->save()) {
            $result = Auth::user()->todo()->get();
            if (!$result->isEmpty()) {
                return view('todo.todo', ['todos' => $result, 'image' => Auth::user()->userimage]);
            } else {
                return view('todo.todo', ['todos' => false, 'image' => Auth::user()->userimage]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        if ($todo->delete()) {
            return back();
        }
    }
}
