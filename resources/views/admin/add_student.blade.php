@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm lịch trình
                            
                        </header>
                        <div class="panel-body">
                        
                            <div class="position-center">
                            <?php
                                use Illuminate\Support\Facades\Session;

                                    $message=Session::get('message');
                                    if($message)
                                    {
                                        echo $message;
                                        Session::put('message',null);
                                    } 
                                    ?>
                                <form role="form" action="{{URL::to('/save-student')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Lớp</label>
                                    <select name="ma_lop" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key=>$cate)
                                        <option value="{{$cate->ma_lop}}">{{$cate->ten_lop}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sinh viên</label>
                                    <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giới tính</label>
                                    <input name="gender" type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Ngày sinh nhật</label>
                                    <input type="text" id="start_date" name="birthday" class="form-control" placeholder="Chọn ngày sinh nhật">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input name="email" type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                                </div>
                                <button type="submit" name="add_product" class="btn btn-info">Thêm sinh viên</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <script>
                 $(document).ready(function(){
                    $("#start_date").datepicker({
                        dateFormat: 'yy-mm-dd', // định dạng ngày khi được chọn
                    
                    });
                });
            </script>
@endsection