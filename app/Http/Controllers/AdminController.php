<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
{
    public function authlogin()
    {
        $ma_teacher=Session::get('ma_teacher');
        if($ma_teacher){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function index(){
        return view('admin_login');
    }
    public function show_dashboard(){
        // $this->authlogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        $teacher_mail=$request->teacher_mail;
        $password=md5($request->password);
        $result= DB::table('teacher')->where('teacher_mail',$teacher_mail)->where('password',$password)->first();
        if($result){
            Session::put('name',$result->name);
            Session::put('ma_teacher',$result->ma_teacher);
            return Redirect::to('/dashboard');
        }else{
            Session::put('message','Mật khẩu hoặc Email sai vui lòng nhập lại');
            return Redirect::to('/admin');
        }
    }
    public function logout(Request $request){
        $this->authlogin();
        Session::put('name',null);
        Session::put('ma_teacher',null);
        return Redirect::to('/admin');
    }
}
