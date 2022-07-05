<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Attend;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\PDF;

use Illuminate\Support\Facades\DB;

class AttendController extends Controller
{

    private $month = array(
        "01" => "January",
        "02" => "February",
        "03" => "March",
        "04" => "April",
        "05" => "May",
        "06" => "June",
        "07" => "July",
        "08" => "August",
        "09" => "September",
        "10" => "October",
        "11" => "November",
        "12" => "December"
    );

    public function getIndex()
    {
        $userList = Employee::all();
        return view('employeeAttend.attend', ['user' => $userList]);
    }

    public function storeData(Request $request)
    {
        $saveRecord = [];
        $i = 0;
        if (!empty($request->employee_id)) {
            foreach ($request->employee_id as $key => $value) {
                $saveRecord[$i]['employee_id'] = $request->employee_id[$key];
                $saveRecord[$i]['date'] = date('Y-m-d', strtotime($request->date[$key]));
                $saveRecord[$i]['time'] = $request->time[$key];
                $i++;
            }
        }
        //        echo '<pre>';
        //        print_r($saveRecord);
        //        exit;
        DB::table('employee_attendance')->insert($saveRecord);

        return redirect()->back();
    }

    public function getUserList(Request $request)
    {

        $key = date('Y-m-d', strtotime($request->key)) ?? "";
        $userList = DB::table('employee_attendance')
            ->leftjoin('employee', 'employee_attendance.employee_id', '=', 'employee.id')
            ->select('employee.first_name', 'employee_attendance.*');
        if (!empty($request->key)) {
            $userList = $userList->where('employee_attendance.date', '=', $key);
        }
        $userList = $userList->get();
        return view('employeeAttend.attendList', compact('userList', 'request'));
    }

    public function searchUserList(Request $request)
    {
        $key = $request->search;
        $url = url("/attend/userList?key=" . $key);
        return redirect($url);
    }

    public function showModal(Request $request)
    {

        $id = $request->id;
        $showModal = Attend::where('id', '=', $id)->first();

        $showModalQuery = DB::table('employee_attendance')
            ->leftjoin('employee', 'employee_attendance.employee_id', '=', 'employee.id')
            ->select('employee.first_name', 'employee.address', 'employee_attendance.*')
            ->where('employee_attendance.id', '=', $id)
            ->first();

        $view = view('employeeAttend.showModal', compact("showModalQuery"))->render();
        return response()->json(['html' => $view]);
    }

    public function showDetails()
    {

        $i = 1;
        $details = $this->getdetails();
        return view('employeeAttend.showAttendDetails', compact('details', 'i'));
        //      $url = url("/addRow");
    }

    public function getdetails()
    {
        $details = DB::table('employee_attendance')
            ->leftjoin('employee', 'employee_attendance.employee_id', '=', 'employee.id')
            ->select('employee.first_name', 'employee.address', 'employee_attendance.*')
            ->pluck('first_name', 'id')->toArray();
        return $details;
    }

    public function findDate(Request $request)
    {

        $id = $request->id;

        $findData = Attend::where('id', '=', $id)->first();

        $view = view('employeeAttend.findDate', compact("findData"))->render();
        return response()->json(['html' => $view]);
    }

    public function findTime(Request $request)
    {
        $id = $request->id;
        $findData = Attend::where('id', '=', $id)->first();

        $view = view('employeeAttend.findTime', compact("findData"))->render();
        return response()->json(['html' => $view]);
    }


    public function addRow(Request $request)
    {
        $i = $request->i;
        $i++;
        $val = $request->val;
        $details = $this->getdetails();
        $view = view('employeeAttend.rowAppear', compact('details', 'i'))->render();
        return response()->json(['html' => $view, 'msg' => "Successfully added new row"]);
    }


    public function showReport(Request $request)
    {
        $ryear = "";
        $rmonth = "";
        $dayArr = [];
        $empList = [];
        $attendList = [];
        $year = array();
        for ($i = 2020; $i <= 2022; $i++) {
            $year[$i] = $i;
        }

        $month = $this->month;

        if ($request->generate == 'true') {

            $ryear = !empty($request->year) ? $request->year : "";
            $rmonth = !empty($request->month) ? $request->month : "";

            $date = $ryear . '-' . $rmonth . '-01';
            $lDay = date("t", strtotime($date));

            for ($i = 01; $i <= $lDay; $i++) {
                $day = str_pad($i, 2, '0', STR_PAD_LEFT);
                $dayArr[$i] = $day;
            }


            $empList = Employee::select(DB::raw("CONCAT(first_name, ' ' , last_name) as name"), 'id')
                ->pluck('name', 'id')->toArray();


            $data = Attend::select('employee_id', DB::raw(" DAY(date) as day"))
                ->where(DB::raw("YEAR(date)"), $ryear)
                ->where(DB::raw("MONTH(date)"), $rmonth)
                ->get();

                // echo"<pre>";
                // print_r($data);
                // exit;


            foreach ($data as $kkey => $vvalue) {
                $date = str_pad($vvalue->day, 2, '0', STR_PAD_LEFT);

                $attendList[$vvalue->employee_id][$date] = $date;
            }

        }

        // return $request->download;
        if ($request->download == 'pdf') {
            $pdf = PDF::loadView('employeeAttend.invoice', compact('year', 'month', 'ryear', 'rmonth', 'attendList', 'empList', 'dayArr'));
            return $pdf->stream();
        } elseif ($request->document == 'print') {
            return view('employeeAttend.invoice', compact('year', 'month', 'ryear', 'rmonth', 'attendList', 'empList', 'dayArr'));
        } else {
            return view('employeeAttend.report', compact('year', 'month', 'ryear', 'rmonth', 'attendList', 'empList', 'dayArr'));
        }



        // return view('employeeAttend.report', compact('year', 'month','ryear','rmonth', 'attendList', 'empList', 'dayArr'));

        // $details = Employee::all();
        // if (!empty($request->key)) {
        //     $range = $request->key;
        //     return view('employeeAttend.report', compact('year', 'month', 'details', 'range'));
        // } elseif (empty($request->key)) {
        //     $range = "";
        //     return view('employeeAttend.report', compact('year', 'month', 'details', 'range'));
        // }
    }

    public function searchReportData(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        // if ($month == '01' || $month == '03' || $month == '05' || $month == '07' || $month == '08' || $month == '10' || $month == '12') {
        //     $range = '31';
        // } elseif ($month == '02') {
        //     $range = '28';
        // } elseif ($month == '04' || $month == '06' || $month == '09' || $month == '11') {
        //     $range = '28';
        // }
        $url = url("/report?generate=true&month=" . $month . "&year=" . $year);
        return redirect($url);
    }
}
