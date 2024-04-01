<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
class ClassController extends Controller
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
    public function manage_order(){
        $this->authlogin();
        $admin_id=Session::get('ma_teacher');
        $all_order=DB::table('schedule')->join('subject','subject.ma_monhoc','=','schedule.ma_monhoc')
        ->join('teacher','teacher.ma_teacher','=','schedule.ma_teacher')
        ->join('room','room.ma_phong','=','schedule.ma_phong')
        ->select('schedule.*','subject.*','teacher.*','room.*')
       ->where('schedule.ma_teacher',$admin_id)->get();
        $manager_order=view('admin.manage_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manage_order',$manager_order);
    }
    public function view_order($orderId){
        $this->authlogin();
        $admin_id=Session::get('ma_teacher');
        $order_by_id=DB::table('attendance')
        ->join('student','student.masv','=','attendance.masv')
        ->select('attendance.*','student.*')->where('attendance.ma_monhoc',$orderId)->where('attendance.ma_teacher',$admin_id)->get();
        // $order_details_by_id=DB::table('student')->where('masv',$order_by_id->masv)->first();
        $manager_order_by_id=view('admin.view_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.view_order',$manager_order_by_id);
    }
    public function manage_schedule(){
        $this->authlogin();
        $admin_id=Session::get('ma_teacher');
        $all_order=DB::table('schedule')->join('subject','subject.ma_monhoc','=','schedule.ma_monhoc')
        ->join('teacher','teacher.ma_teacher','=','schedule.ma_teacher')
        ->join('room','room.ma_phong','=','schedule.ma_phong')
        ->select('schedule.*','subject.*','teacher.*','room.*')
       ->where('schedule.ma_teacher',$admin_id)->get();
        $manager_order=view('admin.manage_schedule')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manage_schedule',$manager_order);
    }
    public function edit_schedule($orderId)
    {
        $this->authlogin();
        $cate_product=DB::table('subject')->orderBy('ma_monhoc','desc')->get();
        $brand_product=DB::table('room')->orderBy('ma_phong','desc')->get();

        $edit_schedule=DB::table('schedule')->where('id',$orderId)->get();
        $manager_schedule=view('admin.edit_schedule')->with('edit_schedule',$edit_schedule)->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product);
        return view('admin_layout')->with('admin.edit_schedule',$manager_schedule);
    }
    public function update_schedule(Request $request,$product_id){
        $this->authlogin();
        $data=array();
        $data['ma_monhoc']=$request->schedule_subject;
        $data['ma_phong']=$request->schedule_class;
        $data['indate']=$request->start_date;
        $data['outdate']=$request->end_date;

        DB::table('schedule')->where('id',$product_id)->update($data);
        Session::put('message','Cập nhật lịch trình thành công!');
        return Redirect::to('manage-schedule');
    }
    public function delete_order($orderId){
        $this->authlogin();
        DB::table('subject')->where('ma_monhoc',$orderId)->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('manage-order');
    }
    public function delete_schedule($orderId){
        $this->authlogin();
        DB::table('schedule')->where('id',$orderId)->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('manage-schedule');
    }
    public function add_class(){
        $this->authlogin();
        $cate_product=DB::table('subject')->orderBy('ma_monhoc','desc')->get();
        $brand_product=DB::table('class')->orderBy('ma_lop','desc')->get();
       
        return view('admin.add_class')->with('cate_product',$cate_product)->with('brand_product',$brand_product);

    }
    public function save_class(Request $request){
        $this->authlogin();
        $admin_id=Session::get('ma_teacher');
        $data=array();
        $data['ma_teacher']=$admin_id;
        $data['indate']=$request->start_date;
        $data['outdate']=$request->end_date;
        $data['ma_monhoc']=$request->product_cate;
        $data['ma_lop']=$request->product_brand;

        DB::table('schedule')->insert($data);
        Session::put('message','Thêm lịch trình thành công!');
        return Redirect::to('manage-schedule');
    }
}
