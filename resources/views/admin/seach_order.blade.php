@extends('admin_layouts')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
    </div>
    <div class="row w3-res-tb">
     
     
    
    </div>
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
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
      <table class="table table-striped b-t b-light">
        <thead>
        <div class="col-sm-3">
        <form action="{{URL::to('/tim-kiem')}}" method="get" >
        @csrf
        <div class="input-group">
          <input type="text" class="input-sm form-control"  name="keywords_submit" placeholder="tìm kiếm">
          <span class="input-group-btn">
            
            <input  class="btn btn-sm btn-success" type="submit" value="Tìm kiếm">
          </span>
        </div>
      </form>
      </div>
          <tr>
           
            <th>Thứ tự</th>
            <th>Mã đơn hàng</th>
            <th>Ngày tháng đặt hàng</th>
            <th>Tình trạng đơn hàng</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php 
          $i = 0;
          @endphp
          @foreach($seach_order  as $key => $ord)
            @php 
            $i++;
            @endphp
          <tr>
            <td><i>{{$i}}</i></label></td>
            <td>{{ $ord->order_code }}</td>
            <td>{{ $ord->created_at }}</td>
            <td>@if($ord->order_status==1)
                    Đơn hàng mới
                @else 
                    Đã xử lý
                @endif
            </td>
           
           
            <td>
              <a href="{{URL::to('/view-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-eye text-success text-active"></i></a>

              <a onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này ko?')" href="{{URL::to('/delete-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
   
    
    <br><h3>Ngày tháng Đặt hàng
    </h3></br>
    <form action="" method="POST">
    @csrf
    <div class="form-row">
      
    
      <div class="form-group col-md-4">
          <label for="inputCity">startdate</label>
          <input type="datetime-local" class="form-control" name="start_date"  id="start_date">
      </div>
      
      
      <div class="form-group col-md-4">
          <label for="inputCity">Enddate</label>
          <input type="datetime-local" class="form-control" name="end_date" id="end_date">
          
          
      </div>
      
     
      
       

      
       <br><div class="col-md-2">
       <td><button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button></td>
       <td><button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button></td>
       <!-- <br><input  class="btn btn-sm btn-success" id="filter"  name="filter"type="submit" value="Tìm kiếm"></br> -->
      </div></br>
      
   
      </form>

      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {!!$seach_order->links()!!}
          </ul>
        </div>
      </div>
    </footer>
   
  </div>
</div>

<script>
  $(document).ready(function(){

var date = new Date();
$('.input-daterange').datepicker({
  todayBtn: 'linked',
  format: 'yyyy-mm-dd',
  autoclose: true
 });

 var _token = $('input[name="_token"]').val();

 fetch_data();

 function fetch_data(start_date = '', end_date = '')
 {
  $.ajax({
   url:"{{ URL::to('order/fetch-data') }}",
   method:"POST",
   data:{start_date:start_date, end_date:end_date, _token:_token},
   dataType:"json",
   success:function(data)
   {
    var output = '';
    $('#total_records').text(data.length);
    for(var count = 0; count < data.length; count++)
	
    {
		
     output += '<tr>' ; 
	 output += '<td>' + data[count].customer_id + '</td>';
     output += '<td>' + data[count].order_code + '</td>';
	 output += '<td>' + data[count].created_at + '</td>';
     output += '<td>' + data[count].order_status + '</td>';
     
    }
    $('tbody').html(output);
   }
  })
 }

 $('#filter').click(function(){
  var start_date = $('#start_date').val();
  var end_date = $('#end_date').val();
  if(start_date != '' &&  end_date != '')
  {
   fetch_data(start_date, end_date);
  }
  else
  {
   alert('Both Date is required');
  }
 });

 $('#refresh').click(function(){
  $('#start_date').val('');
  $('#end_date').val('');
  fetch_data();
 });


});



</script>






@endsection

