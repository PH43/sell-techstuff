@extends('admin_layouts')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     Liệt kê Customers
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
        <form action="{{URL::to('/tim-kiem')}}" method="POST" >
        {{ csrf_field ()}}
        <div class="input-group">
          <input type="text" class="input-sm form-control"  name="keywords_submit" placeholder="tìm kiếm">
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
		    echo '<span class="text-alert" style="font-size=30px">'.$message.'</span>';
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
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
          
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach( $customer  as $key=> $cus)  
            <form action= "{{URL::to('#')}}" method="POST">
            {{csrf_field()}}
          
            <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $cus -> customer_name }}</td>
            <td>{{ $cus -> customer_email }}
            <!-- <input type="hidden" name="admin_email" value="{{ $cus -> admin_email }}"></td>
            <input type="hidden" name="admin_id" value="{{ $cus -> admin_id }}"></td> -->
            <td>{{ $cus -> customer_phone }}</td>
            <td>{{ $cus -> customer_password }}</td>
           

            <td>
            <a href="" class="active styling-edit" ui-toggle-class="">
            <i class="fa fa-pencil-square-o text-success text-active"></i>
            </a>
            <a onclick="return confirm('Are you sure DELETE')" href="" class="active styling-delete" ui-toggle-class="">
            <i class="fa fa-times text-danger text"></i>
            </a>
            </td>
            </tr>
            
          
        </form>

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
      
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection
