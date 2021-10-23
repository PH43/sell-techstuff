@extends('admin_layouts')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     Liệt kê sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <form action="{{URL::to('/tim-kiem')}}" method="get" >
        {{csrf_field()}}
        <div class="input-group">
          <input type="text" class="input-sm form-control" name="keywords_submit" placeholder="Search">
          <span class="input-group-btn">
          <input  class="btn btn-sm btn-default" type="submit" value="Tìm kiếm">

          </span>
        </div>
      </form>
      </div>
    </div>
    <div class="table-responsive">
            <?php
            $message = Session::get('message');
            if($message){
                echo '<span class="text-alert">'.$message.'</span>';
                // echo $message;
                Session::put('message',null);
            }
            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Hình sản phẩm</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach( $seach_product  as $key => $pro)     
          
            <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $pro -> product_name }}</td>
            <td>{{ $pro -> product_price }}</td>
            <td><img src="public/uploads/product/{{ $pro -> product_image }}" height="100" with="100"></td>
            <td>{{ $pro -> category_name }}</td>
            <td>{{ $pro -> brand_name }}</td>
            
            <td>
                <?php
                if ($pro->product_status == 0){
                    ?>
                    <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up ">
                </span></a> 
                <?php
                }else{
                ?>
                    <a href="{{URL::to('/active-product/'.$pro->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down ">

                </span></a>
                
                <?php
                     
                }
                ?>
            </td>
            <td>Jul 2, 2020</td>
            <td>
            <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
            <i class="fa fa-pencil-square-o text-success text-active"></i>
            </a>
            <a onclick="return confirm('Are you sure DELETE')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active styling-delete" ui-toggle-class="">
            <i class="fa fa-times text-danger text"></i>
            </a>
            </td>
            </tr>
          
          @endforeach
          
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
          {!!$seach_product->links()!!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection
