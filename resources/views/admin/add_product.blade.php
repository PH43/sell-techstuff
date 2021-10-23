@extends('admin_layouts')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            thêm sản phẩm
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
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự"
                                     name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" value="{{old('product_name')}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">mô tả sản phẩm</label>
                                    <textarea style="resize : none" rows="8" class="form-control" name="product_desc" id="exampleInputPassword1" placeholder="mô tả sản phẩm">                
                                    
                                </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">nội dung sản phẩm</label>
                                    <textarea style="resize : none" rows="4" class="form-control" name="product_content" id="exampleInputPassword1" placeholder="mô tả nội dung danh mục">                
                                    
                                </textarea>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                  <select name="product_cate" class="form-control input-sm m-bot15">
                                    @foreach($cate_product as  $cate)
                    
                                        <option value="{{($cate-> category_id)}}"> {{$cate-> category_name}}</option>
                                    @endforeach
                                        
                                   </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Thương hiệu</label>
                                  <select name="product_brand" class="form-control input-sm m-bot15">
                                  @foreach($brand_product as  $brand)
                                        <option value="{{($brand-> brand_id)}}">{{$brand-> brand_name}}</option>
                                        
                                        @endforeach   
                                   </select>
                                </div>

                                <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                  <select name="product_status" class="form-control input-sm m-bot15">
                    
                                        <option value="0">Ẩn </option>
                                        <option value="1">Hiển thị</option>
                                        
                                   </select>
                                </div>
            
                                <button type="submit" name="add_product" class="btn btn-info">thêm sản phẩm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection
