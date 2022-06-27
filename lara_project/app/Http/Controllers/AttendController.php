<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Attend;
use Illuminate\Support\Facades\DB;

class AttendController extends Controller {

    public function getIndex() {
        $userList = Employee::all();
        return view('employeeAttend.attend', ['user' => $userList]);
    }

    public function storeData(Request $request) {
        $saveRecord = [];
        $i = 0;
        if(!empty($request->employee_id)){
        foreach ($request->employee_id as $key => $value) {
            $saveRecord[$i]['employee_id'] = $request->employee_id[$key];
            $saveRecord[$i]['date'] = date('Y-m-d', strtotime($request->date[$key]));
            $saveRecord[$i]['time'] = $request->time[$key];
            $i++;
        }}
//        echo '<pre>';
//        print_r($saveRecord);
//        exit;
        DB::table('employee_attendance')->insert($saveRecord);

        return redirect()->back();
    }

    public function getUserList(Request $request) {

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

    public function searchUserList(Request $request) {
        $key = $request->search;
        $url = url("/attend/userList?key=" . $key);
        return redirect($url);
    }

    public function showModal(Request $request) {

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

    public function showDetails(){

        $i=1;

         $details=$this->getdetails();
         return view('employeeAttend.showAttendDetails',compact('details','i'));
    //      $url = url("/addRow");
    }

    public function getdetails() {
         $details = DB::table('employee_attendance')
                ->leftjoin('employee', 'employee_attendance.employee_id', '=', 'employee.id')
                ->select('employee.first_name', 'employee.address', 'employee_attendance.*')
                ->pluck('first_name', 'id')->toArray();
         return $details;

    }

    public function findDate(Request $request){

        $id=$request->id;

        $findData = Attend::where('id', '=', $id)->first();

        $view = view('employeeAttend.findDate', compact("findData"))->render();
        return response()->json(['html' => $view]);
    }

    public function findTime(Request $request){
        $id=$request->id;
        $findData = Attend::where('id', '=', $id)->first();

        $view = view('employeeAttend.findTime', compact("findData"))->render();
        return response()->json(['html' => $view]);

    }


    public function addRow(Request $request){
        $i= $request->i;
        $i++;
        $val = $request->val;
        $details=$this->getdetails();
        $view = view('employeeAttend.rowAppear',compact('details','i'))->render();
        return response()->json(['html' => $view , 'msg'=> "Successfully added new row"]);
    }
}
