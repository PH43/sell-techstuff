@extends('admin_layouts')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            thêm Customer
                        </header>
                        <?php
            $message = Session::get('message');
            if($message){
                echo '<span class="text-alert">'.$message.'</span>';
                // echo $message;
                Session::put('message',null);
            }
            ?>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('store-customer')}}" method="POST">
                                        @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Họ và Tên </label>
                                    <input type="text" name="customer_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" name="customer_email" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone</label>
                                    <input type="text" name="customer_phone" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="text" name="customer_password" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                
            
                                <button type="submit" name="add_brand_product" class="btn btn-info">Thêm customer</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection
