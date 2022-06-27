<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Division;
use App\District;
use App\Thana;
use App\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class EmpController extends Controller {

    public function getIndex() {
        return view('layout.master');
    }

    //$users = User::paginate(10);
    public function userList() {
        $userList = Employee::all();
        return view('employee.userlist', ['user' => $userList]);
    }

    public function createUser() {
        $division = Division::pluck('name', 'id')->toArray();
        return view('employee.create', compact("division"));
    }

    public function getDistrict(Request $request) {

        $id = $request->id;
        $disdata = District::where('division_id', '=', $id)->pluck('name', 'id')->toArray();

        $view = view('employee.district', compact("disdata"))->render();
        return response()->json(['html' => $view]);

        // return view('employee.district')->with('disdata', $district);
    }

    public function getThana(Request $request) {
        $id = $request->id;
        $thanaData = Thana::where('district_id', '=', $id)->pluck('name', 'id')->toArray();

        $view = view('employee.thana', compact("thanaData"))->render();
        return response()->json(['html' => $view]);

        //return view('employee.thana')->with('result3', $thana);
    }

    public function storeData(Request $request) {

        if ($request->hasFile('file')) {
            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/uploads/', $filename);
        }
        //$request->file->store('images', 'public/');

        $emp = new Employee([
            "first_name" => $request->get('firstName'),
            "last_name" => $request->get('lastName'),
            "address" => $request->get('address'),
            "division_id" => $request->get('division'),
            "district_id" => $request->get('district'),
            "thana_id" => $request->get('thana'),
            "gender" => $request->get('gender'),
            "status" => $request->get('status'),
            "email" => $request->get('email'),
            "password" => Hash::make($request->get('password')),
            "image" => $filename
        ]);

        $emp->save();
        return redirect()->route('userCreate');
    }

    public function editUser($id) {
        $emp = Employee::find($id);
        return view('employee.edit')->with('empEdit', $emp);
    }

    public function updateUser($id, Request $req) {
        $updateList = Employee::find($id);

        $updateList->first_name = $req->input('firstName');
        $updateList->last_name = $req->input('lastName');
        $updateList->address = $req->input('address');
        $updateList->gender = $req->input('gender');
        $updateList->status = $req->input('status');
        if ($files = $req->file('file')) {

            $extension = $files->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $files->move('public/uploads/', $filename);
            $updateList->image = $filename;
        }
        $updateList->save();
        return redirect()->route('userList');
    }

    public function destroyUser($id) {
        $emp = Employee::find($id);
        $emp->delete();
        return redirect()->route('userList');
    }

    public function changeStatus(Request $request) {

        $id = $request->id;
        $status = $request->status;
        //$btn= $request->btn;
        $sat = !empty($status) ? '0' : '1';

        $updateList = Employee::find($id);
        $updateList->status = $sat;
        if ($updateList->save()) {
            return Response::json(['success' => true, 'heading' => __('lebel.SUCCESS')], 200);
        } else {
            return Response::json(['success' => false, 'heading' => __('lebel.ERROR')], 401);
        }
    }

}
