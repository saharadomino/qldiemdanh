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
                                <form role="form" action="{{URL::to('/save-class')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Môn học</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key=>$cate)
                                        <option value="{{$cate->ma_monhoc}}">{{$cate->ten_monhoc}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Lớp học</label>
                                    <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key=>$brand)
                                        <option value="{{$brand->ma_lop}}">{{$brand->ten_lop}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Ngày bắt đầu:</label>
                                    <input type="text"  id="start_date" name="start_date" class="form-control" placeholder="Chọn ngày bắt đầu">
                                </div>
                                <div class="form-group">
                                    <label for="end_date">Ngày kết thúc:</label>
                                    <input type="text"  id="end_date" name="end_date" class="form-control" placeholder="Chọn ngày kết thúc">
                                </div>
                                <button type="submit" name="add_product" class="btn btn-info">Thêm lịch trình</button>
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