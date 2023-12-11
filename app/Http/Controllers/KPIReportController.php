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

    private $ngayDauTienCacQuy = [];
    private $ngayCuoiCungCacQuy = [];

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
        $fromDate = Carbon::now()->startOfMonth()->format('d/m/yy');
        $toDate = Carbon::now()->format('d/m/yy'); 
        
        $result = $this->getData($fromDate, $toDate);

        return view('report.kpi', ['todos' => $result, 'image' => Auth::user()->userimage]);
    }

    public function report(Request $request)
    {
        $result = [];

        $option = $request->option;
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;
        if($option == "option1") {
            $this->calDateQuarter();
            $q = $request->q;
            $f = $this->ngayDauTienCacQuy[$q];
            $t = $this->ngayCuoiCungCacQuy[$q];
            $result = $this->getData($f, $t);
        }
        if($option == "option2") {
            $result = $this->getData($fromDate, $toDate);
        }

        return view('report.kpi', ['todos' => $result, 'image' => Auth::user()->userimage]);
    }

    public function calDateQuarter() {
        // Lấy năm hiện tại
        $namHienTai = Carbon::now()->year;

        // Lặp qua mỗi quý
        for ($quy = 1; $quy <= 4; $quy++) {
            // Tìm ngày đầu tiên của quý
            $this->ngayDauTienCacQuy[$quy] = Carbon::create($namHienTai, ($quy - 1) * 3 + 1, 1)->startOfDay()->format('d/m/yy');
            // Tìm ngày cuoi cung của quý
            $this->ngayCuoiCungCacQuy[$quy] = Carbon::create($namHienTai, ($quy - 1) * 3 + 3, 1)->endOfMonth()->format('d/m/yy');
        }
    }

    public function getData($fromDate, $toDate) {
        
        if (Auth::user()->permission == 'ADMIN' || Auth::user()->permission == 'MANAGER') {
            $result = Todo::all();
        } else {
            $department_ids = json_decode(Auth::user()->departments);
            $result = Todo::whereIn('id', $department_ids)->get();
        }

        $from = Carbon::createFromFormat('d/m/Y', $fromDate);
        $to = Carbon::createFromFormat('d/m/Y', $toDate);
        foreach ($result as $rs) {
            $viecdagiao = $rs->taskDetail()
                ->where('is_kpi', '=', 1)
                ->whereBetween('date_create', [$from, $to])
                ->count();
            $rs->viecdagiao = $viecdagiao;

            // $vieckhongdat = $rs->taskDetail()->where('status', '=', 'REJECT')->count();
            // $rs->vieckhongdat = $vieckhongdat;

            // $chopheduyet = $rs->taskDetail()->where('status', '=', 'REPORT')->count();
            // $rs->chopheduyet = $chopheduyet;

            // Tinh so viec da done nhung tre deadline
            $tongsodauviec = $rs->taskDetail()->where('status', '=', 'DONE')
                ->where('is_kpi', '=', 1)
                ->whereBetween('date_create', [$from, $to])
                ->get();
            $viectredeadline = $rs->taskDetail()->where('status', '!=', 'DONE')
                ->where('is_kpi', '=', 1)
                ->whereBetween('date_create', [$from, $to])
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
            $rs->viecchuahoanthanh = $viecdagiao-($viectredeadline + $numberTreHanTemp + $numberTruocHanTemp + $numberDungHanTemp);
            
            if ($viecdagiao == 0) {
                $rs->ketqua = 'Đúng Hạn';
            } else if ($viectredeadline + $numberTreHanTemp > 0) {
                $rs->ketqua = 'Trễ Hạn';
            } else if ($numberTruocHanTemp >= $viecdagiao) {
                $rs->ketqua = 'Trước Hạn';
            } else if ($numberDungHanTemp >= $viecdagiao) {
                $rs->ketqua = 'Đúng Hạn';
            }
        }

        return $result;
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
}
