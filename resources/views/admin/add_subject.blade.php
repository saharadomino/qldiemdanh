@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm môn học
                            
                        </header>
                        <div class="panel-body">
                        
                            <div class="position-center">
                            <?php
                                use Illuminate\Support\Facades\Session;

                                    $message=Session::get('error');
                                    if($message)
                                    {
                                        echo $message;
                                        Session::put('error',null);
                                    } 
                                    ?>
                                <form role="form" action="{{URL::to('/save-subject')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã môn học</label>
                                    <input name="ma_monhoc" type="text" class="form-control" id="exampleInputEmail1" placeholder="Mã môn học">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên môn học</label>
                                    <input name="ten_monhoc" type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên môn học">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tổng số buổi</label>
                                    <input name="tongsobuoi" type="text" class="form-control" id="exampleInputEmail1" placeholder="Tổng số buổi">
                                </div>
                                <button type="submit" name="add_brand_product"class="btn btn-info">Thêm môn học</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection