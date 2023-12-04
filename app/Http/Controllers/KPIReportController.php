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
use Carbon\Carbon;
use Storage;

class KPIReportController extends Controller
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
        $result = Todo::all();

        foreach ($result as $rs) {
            $viecdagiao = $rs->taskDetail()
                ->where('is_kpi', '=', 1)->count();
            $rs->viecdagiao = $viecdagiao;

            // $vieckhongdat = $rs->taskDetail()->where('status', '=', 'REJECT')->count();
            // $rs->vieckhongdat = $vieckhongdat;

            // $chopheduyet = $rs->taskDetail()->where('status', '=', 'REPORT')->count();
            // $rs->chopheduyet = $chopheduyet;

            // Tinh so viec da done nhung tre deadline
            $tongsodauviec = $rs->taskDetail()->where('status', '=', 'DONE')
                ->where('is_kpi', '=', 1)->get();
            $viectredeadline = $rs->taskDetail()->where('status', '!=', 'DONE')
                ->where('is_kpi', '=', 1)
                ->whereDate('deadline', '<', \Carbon::today()->toDateString())->count();
            $numberTreHanTemp = 0;
            $numberTruocHanTemp = 0;
            $numberDungHanTemp = 0;
            // dd($tongsodauviec);
            foreach ($tongsodauviec as $item) {
                $taskDetail = TaskDetail::find($item->id);
                if ($taskDetail->deadline < $taskDetail->taskDetailReport()->orderBy('count_report', 'desc')->first()->date_report) {
                    $numberTreHanTemp = $numberTreHanTemp + 1;
                } else if ($taskDetail->deadline > $taskDetail->taskDetailReport()->orderBy('count_report', 'desc')->first()->date_report) {
                    $numberTruocHanTemp = $numberTruocHanTemp + 1;
                } else {
                    $numberDungHanTemp = $numberDungHanTemp + 1;
                }
            }
            $rs->viectredeadline = $viectredeadline + $numberTreHanTemp;
            $rs->viectruocdeadline = $numberTruocHanTemp;
            $rs->viecdungdeadline = $numberDungHanTemp;

            if ($viectredeadline + $numberTreHanTemp > 0) {
                $rs->ketqua = 'Trễ Hạn';
            } else if ($numberTruocHanTemp >= $viecdagiao) {
                $rs->ketqua = 'Trước Hạn';
            } else if ($numberDungHanTemp >= $viecdagiao) {
                $rs->ketqua = 'Đúng Hạn';
            }
        }
        // dd($result);
        if (!$result->isEmpty()) {
            return view('report.kpi', ['todos' => $result, 'image' => Auth::user()->userimage]);
        } else {
            return view('report.kpi', ['todos' => false, 'image' => Auth::user()->userimage]);
        }
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
        if ($request->is_kpi == null) {
            $isKpi = 0;
        }
        $detail = new TaskDetail();
        $detail->id_todo = $id_todo;
        $detail->title = $request->title;
        $detail->is_kpi = $isKpi;
        $detail->content_task = $request->content_task;
        if (!empty($request->deadline)) {
            $detail->deadline = Carbon::createFromFormat('d/m/Y', $request->deadline);
        }
        //$detail->content_task=$request->content_task;
        $detail->date_create = new DateTime;
        $detail->status = "CREATE";
        $detail->is_read = false;
        $detail->save();


        $files = $request->file('file');

        if (!empty($files)) :
            foreach ($files as $file) :

                $filename = $file->store('upload');
                TaskDetailFile::create([
                    'id_task_detail' => $detail->id,
                    'id_user' => Auth::user()->id,
                    'name_file' => $file->getClientOriginalName(),
                    'file' => $file->hashName()

                ]);

            endforeach;

        endif;


        //dd($files);


        //dd($detail);


        return \Redirect::back()->with('message', 'Operation Successful !');
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

        return \Redirect::back()->with('message', 'Operation Successful !');
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
        if ($taskDetail->fill($request->all())->save()) {
            $result = Auth::user()->todo()->get();
            if (!$result->isEmpty()) {
                return view('todo.todo', ['todos' => $result, 'image' => Auth::user()->userimage]);
            } else {
                return view('todo.todo', ['todos' => false, 'image' => Auth::user()->userimage]);
            }
        }
    }
    public function success(Request $request)
    {
        //dd($request->task_id);
        $id_task_detail = $request->id_task_detail;

        $taskDetail = TaskDetail::find($id_task_detail);
        //dd($id_task_detail);


        if ($taskDetail->deadline > $taskDetail->taskDetailReport()->orderBy('count_report', 'desc')->first()->date_report) {
            $taskDetail->update(['status' => 'DONE', 'late_deadline' => 'true']);
        } else {
            $taskDetail->update(['status' => 'DONE', 'late_deadline' => 'true']);
        }


        $detailReport =  TaskDetailReport::where('id_task_detail', $id_task_detail)->orderBy('count_report', 'desc')->first();
        $detailReport->comment_reject = "Đạt";
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

    public function download($filename = '', $name = '')
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
