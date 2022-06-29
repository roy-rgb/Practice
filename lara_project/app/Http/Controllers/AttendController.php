<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Attend;
use Carbon\Carbon;
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

        //     <select id="year" class="col-2 h4"  name="year">
        //     <option value="">year</option>
        //     {{ $year = date('Y') }}
        //     @for ($year = 2020; $year <= 2022; $year++)
        //     <option value="{{ $year }}">{{ $year }}</option>
        //     @endfor
        //    </select>

        $year = array();
        for ($i = 2020; $i <= 2022; $i++) {
            $year[$i] = $i;
        }

        $month = $this->month;
        $details = Employee::all();

        if (!empty($request->key)) {
            $range = $request->key;
            return view('employeeAttend.report', compact('year', 'month', 'details', 'range'));
        } elseif (empty($request->key)) {
            $range = "";
            return view('employeeAttend.report', compact('year', 'month', 'details', 'range'));
        }
    }

    public function searchReportData(Request $request)
    {
        $month = $request->month;

        $range = '';

        if ($month == '01' || $month == '03' || $month == '05' || $month == '07' || $month == '08' || $month == '10' || $month == '12') {
            $range = '31';
        } elseif ($month == '02') {
            $range = '28';
        } elseif ($month == '04' || $month == '06' || $month == '09' || $month == '11') {
            $range = '28';
        }
        $url = url("/report?key=" . $range);
        return redirect($url);
    }
}
