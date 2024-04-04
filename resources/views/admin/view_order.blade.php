@extends('admin_layout')
@section('admin_content')



<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      CHI TIẾT ĐIỂM DANH
    </div>
    
    <div class="table-responsive">
    
      <table class="table table-striped b-t b-light">
        <div class="font-notice"></div>
        <thead>
          <tr>
            <th>Mã Lớp Học</th>
            <th>Mã Sinh Viên</th>
            <th>Tên Sinh Viên</th>
            <th>Số lần có mặt</th>
            <th>Số lần vắng</th>
            <th>Ghi Chú</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($order_by_id as $key=>$order)
          <tr>
            <td>{{$order->ma_lop}}</td>
            <td>{{$order->masv}}</td>
            <td>{{$order->name}}</td>
            <td>{{$order->sobuoicomat}}</td>
            <td>{{$order->sobuoivang}}</td>
            <td>{{$order->ghichu}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    </div>
</div>
    

@endsection