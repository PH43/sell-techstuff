@extends('admin_layouts')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            thêm thương hiệu sản phẩm
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
                                <form role="form" action="{{URL::to('/save-brand_product')}}" method="post">
                                        {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">mô tả thương hiệu</label>
                                    <textarea style="resize : none" rows="4" class="form-control" name="brand_product_desc" id="exampleInputPassword1" placeholder="mô tả danh mục">                
                                    
                                </textarea>

                                <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                  <select name="brand_product_status" class="form-control input-sm m-bot15">
                    
                                        <option value="0">Ẩn </option>
                                        <option value="1">Hiển thị</option>
                                        
                                   </select>
                                </div>
            
                                <button type="submit" name="add_brand_product" class="btn btn-info">thêm thương hiệu</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection
