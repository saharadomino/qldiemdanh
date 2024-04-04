@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LỚP HỌC
    </div>
    
    <div class="table-responsive">
    
      <table class="table table-striped b-t b-light">
        <div class="font-notice">
        <?php
                                use Illuminate\Support\Facades\Session;

                                    $message=Session::get('message');
                                    if($message)
                                    {
                                        echo $message;
                                        Session::put('message',null);
                                    } 
                                    ?></div>
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Mã môn học</th>
            <th>Tên môn học</th>
            <th>Tổng số buổi</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($all_subject as $key=>$subject)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$subject->ma_monhoc}}</td>
            <td>{{$subject->ten_monhoc}}</td>
            <td>{{$subject->tongsobuoi}}</td>
            <td>
              <a href="{{URL::to('/edit-subject/'.$subject->ma_monhoc)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
@endsection