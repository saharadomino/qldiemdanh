@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật lịch trình
                            
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
                                @foreach($edit_schedule as $key=>$pro)
                                <form role="form" action="{{URL::to('/update-schedule/'.$pro->id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Môn học</label>
                                    <select name="schedule_subject" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key=>$cate)
                                        @if($cate->ma_monhoc==$pro->ma_monhoc)
                                        <option selected value="{{$cate->ma_monhoc}}">{{$cate->ten_monhoc}}</option>
                                        @else
                                        <option value="{{$cate->ma_monhoc}}">{{$cate->ten_monhoc}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Lớp</label>
                                    <select name="schedule_class" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key=>$brand)
                                        @if($brand->ma_phong==$pro->ma_phong)
                                        <option selected value="{{$brand->ma_phong}}">{{$brand->ma_phong}}</option>
                                        @else
                                        <option value="{{$brand->ma_phong}}">{{$brand->ma_phong}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Ngày bắt đầu:</label>
                                    <input type="text" value="{{$pro->indate}}" id="start_date" name="start_date" class="form-control" placeholder="Chọn ngày bắt đầu">
                                </div>
                                <div class="form-group">
                                    <label for="end_date">Ngày kết thúc:</label>
                                    <input type="text" value="{{$pro->outdate}}" id="end_date" name="end_date" class="form-control" placeholder="Chọn ngày kết thúc">
                                </div>
                                <button type="submit" name="add_product"class="btn btn-info">Cập nhật</button>
                            </form>
                            @endforeach
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
                        onSelect: function(selected) {
                            $("#end_date").datepicker("option", "minDate", selected); // đặt ngày bắt đầu là ngày tối thiểu cho ngày kết thúc
                        }
                    });
                    $("#end_date").datepicker({
                        dateFormat: 'yy-mm-dd', // định dạng ngày khi được chọn
                        onSelect: function(selected) {
                            $("#start_date").datepicker("option", "maxDate", selected); // đặt ngày kết thúc là ngày tối đa cho ngày bắt đầu
                        }
                    });
                });
            </script>
@endsection