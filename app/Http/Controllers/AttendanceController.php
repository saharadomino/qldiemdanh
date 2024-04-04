<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;

class AttendanceController extends Controller
{
    public function authlogin()
    {
        $admin_id=Session::get('ma_teacher');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function manage_attendance($orderId){
        $this->authlogin();
        $all_attendance=DB::table('diemdanh')
        ->join('student','student.masv','=','diemdanh.masv')
        ->join('schedule','schedule.id','=','diemdanh.id')
        ->select('diemdanh.*','student.*','schedule.*')->where('diemdanh.id',$orderId)->get();
        $manager_attendance=view('admin.manage_attendance')->with('all_attendance',$all_attendance);
        return view('admin_layout')->with('admin.manage_attendance',$manager_attendance);
    }
    public function present_attendance($orderId)
    {
        $this->authlogin();
        $data=array();
        $data['diemdanh']='1';
        DB::table('diemdanh')->where('id_diemdanh',$orderId)->update($data);
        return back()->with('success', 'Điểm danh thành công!');
    }
    public function not_present_attendance($orderId)
    {
        $this->authlogin();
        $data=array();
        $data['diemdanh']='0';
        DB::table('diemdanh')->where('id_diemdanh',$orderId)->update($data);
        return back()->with('success', 'Điểm danh thành công!');
    }
    public function add_student($stuId){
        $this->authlogin();
        Session::put('id',$stuId);
        $cate_product=DB::table('class')->orderBy('ma_lop','desc')->get();
        return view('admin.add_student')->with('cate_product',$cate_product);

    }
    public function save_student(Request $request){
        $this->authlogin();
        $id=Session::get('id');
        $data=array();
        $data1=array();
        $data['ma_lop']=$request->ma_lop;
        $data['name']=$request->name;
        $data['gender']=$request->gender;
        $data['birthday']=$request->birthday;
        $data['email']=$request->email;

        DB::table('student')->insert($data);
        $newStudent=DB::table('student')->orderBy('masv', 'desc')->first();
        $data1['id']=$id;
        $data1['masv']=$newStudent->masv;
        $data1['diemdanh']='0';
        DB::table('diemdanh')->insert($data1);
        Session::put('message','Thêm sinh viên thành công!');
        return Redirect::to('manage-attendance/'.$id);
    }
    
}
