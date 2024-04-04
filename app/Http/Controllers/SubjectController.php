<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;

class SubjectController extends Controller
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
    public function manage_subject(){
        $this->authlogin();
        $admin_id=Session::get('ma_teacher');
        $all_subject=DB::table('subject')
        ->select('subject.*')->get();
        $manager_subject=view('admin.manage_subject')->with('all_subject',$all_subject);
        return view('admin_layout')->with('admin.manage_subject',$manager_subject);
    }
    public function edit_subject($orderId)
    {
        $this->authlogin();
        $edit_subject=DB::table('subject')->where('ma_monhoc',$orderId)->get();
        $manager_subject=view('admin.edit_subject')->with('edit_subject',$edit_subject);
        return view('admin_layout')->with('admin.edit_subject',$manager_subject);
    }
    public function update_subject(Request $request,$subject_id){
        $this->authlogin();
        $data=array();
        $data['ten_monhoc']=$request->ten_monhoc;
        $data['tongsobuoi']=$request->tongsobuoi;

        DB::table('subject')->where('ma_monhoc',$subject_id)->update($data);
        Session::put('message','Cập nhật môn học thành công!');
        return Redirect::to('manage-subject');
    }
    public function add_subject(){
        $this->authlogin();
        return view('admin.add_subject');
    }
    public function save_subject(Request $request){
        $this->authlogin();
        $data=array();
        $data['ten_monhoc']=$request->ten_monhoc;
        $data['tongsobuoi']=$request->tongsobuoi;
        $data['ma_monhoc']=$request->ma_monhoc;

        $checkExists=DB::table('subject')->where('ma_monhoc',$request->ma_monhoc)->first();
        if($checkExists){
            Session::put('error', 'Mã môn học đã tồn tại!');
            return Redirect::to('add-subject');
        }
        DB::table('subject')->insert($data);
        Session::put('message','Thêm môn học thành công!');
        return Redirect::to('manage-subject');
    }
}
