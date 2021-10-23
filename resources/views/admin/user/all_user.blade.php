@extends('admin_layouts')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     Liệt kê User
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
            <th>Admin</th>
            <th>Author</th>
            <th>User</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach( $admin  as $key=> $user)  
            <form action= "{{URL::to('/Assign-roles')}}" method="POST">
            {{csrf_field()}}
          
            <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $user -> admin_name }}</td>
            <td>{{ $user -> admin_email }}
            <input type="hidden" name="admin_email" value="{{ $user -> admin_email }}"></td>
            <input type="hidden" name="admin_id" value="{{ $user -> admin_id }}"></td>
            <td>{{ $user -> admin_phone }}</td>
            <td>{{ $user -> admin_password }}</td>
            
            <td><input type="checkbox" name="admin_role" {{$user ->hasRole('admin') ? 'checked': ''}}>
      </td>
            <td><input type="checkbox" name="author_role" {{$user ->hasRole('author') ? 'checked': ''}}>
            </td>
            <td><input type="checkbox" name="user_role" {{$user ->hasRole('user') ? 'checked': ''}}>
            </td>
            


            <td> 

            <p><input type="submit" value="Phân quyền" class="btn btn-sm btn-success"></p>
            <p><a style="margin:5px 0;" class="btn btn-sm btn-danger" href="{{URL::to('/delete-user-roles/'.$user->admin_id)}}" >Xoá user </a></p>
            <p><a style="margin:5px 0" color="blue"; class="btn btn-sm btn-success" href="{{URL::to('/impersonate/'.$user->admin_id)}}" >Chuyển quyền </a></p>
            </td>

            <td>
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
          {!!$admin->links()!!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection
