@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LỚP HỌC
    </div>
    @if (session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
    @endif

    <div class="table-responsive">
    <?php
                                use Illuminate\Support\Facades\Session;
                                    $iddiemdanh=0;
                                    $message=Session::get('message');
                                    if($message)
                                    {
                                        echo $message;
                                        Session::put('message',null);
                                    } 
                                    ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Mã sinh viên</th>
            <th>Tên sinh viên</th>
            <th>Mã lớp</th>
            <th>Giới tính</th>
            <th>Email</th>
            <th>Điểm danh</th>
            <th></th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($all_attendance as $key=>$order)
          <tr>
            <?php $iddiemdanh=$order->id ?>
            <td>{{$order->masv}}</td>
            <td>{{$order->name}}</td>
            <td>{{$order->ma_lop}}</td>
            <td>{{$order->gender}}</td>
            <td>{{$order->email}}</td>
            <td>
              <label style="margin-right: 10px;">
                <input type="radio" name="diemdanh[{{$order->masv}}]" value="1" {{ $order->diemdanh == 1 ? 'checked' : '' }} disabled>Có mặt
              </label>
              <label>
                <input type="radio" name="diemdanh[{{$order->masv}}]" value="0" {{ $order->diemdanh == 0 ? 'checked' : '' }} disabled>Vắng mặt
              </label>
              <a href="{{URL::to('/present-attendance/'.$order->id_diemdanh)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-check-circle text-success"></i></a>
              <a href="{{URL::to('/not-present-attendance/'.$order->id_diemdanh)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times-circle text-danger"></i></a>
            </td>
            <td>
            
            </td>
            <td style="width:30px;"></td> </tr>
            </tr>
          @endforeach
        </tbody>
      </table>
      
    </div>
    <a href="{{URL::to('/add-student/'.$iddiemdanh)}}" class="btn btn-info" ui-toggle-class="">Thêm sinh viên</a>
@endsection
