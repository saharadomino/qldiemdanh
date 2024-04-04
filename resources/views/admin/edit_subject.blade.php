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
                                @foreach($edit_subject as $key=>$edit_value)
                                <div class="position-center">
                                    <form role="form" action="{{URL::to('/update-subject/'.$edit_value->ma_monhoc)}}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên Môn học</label>
                                        <input name="ten_monhoc" value="{{$edit_value->ten_monhoc}}" type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên môn học">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tổng số buổi</label>
                                        <input name="tongsobuoi" value="{{$edit_value->tongsobuoi}}" type="text" class="form-control" id="exampleInputEmail1" placeholder="Tổng số buổi">
                                    </div>
                                    
                                    <button type="submit" name="update_brand_product"class="btn btn-info">Cập nhật môn học</button>
                                </form>
                                </div>
                                @endforeach
                            </div>
                                    
                        </div>
                    </section>

            </div>
@endsection