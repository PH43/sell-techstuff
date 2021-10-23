<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shipping;
use App\Order;
use App\OrderDetails;
use App\Customer;
use DB;

class OrderController extends Controller
{
    public function order(){
        $order = Order::orderby('created_at','DESC')->paginate(5);
        // dd($order);
        return view('admin.manage_order')->with(compact('order'));
    }
    public function view_order($order_code){
        $order_details = OrderDetails::where('order_code',$order_code)->get();
        $order = Order::where('order_code',$order_code)->get();
            foreach ($order as $key =>$ord){
                $customer_id = $ord->customer_id;
                $shipping_id = $ord->shipping_id;
            }
            $customer = Customer::where('customer_id',$customer_id)->first();
            $shipping = Shipping::where('shipping_id',$shipping_id)->first();
            $order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();
            // dd($customer);




        return view('admin.view_order')->with(compact('order_details','customer','shipping'));
        
    }
    public function seach(Request $request){

    $keywords =$request-> keywords_submit;
    $seach_order = Order::where('order_code','like','%'.$keywords.'%')
                       
                   ->paginate(5);
                                                
                                                    //    dd($seach_order);
    return view('admin.seach_order')->with(compact('keywords','seach_order'));
    // 
    }
    
    public function fetch_data(Request $request){

        {
            if($request->ajax())
            {
             if($request->start_date != '' && $request->end_date != '')
             {
                $data = Order::whereBetween('created_at', array($request->start_date, $request->end_date))
                ->get();
             }
                
                echo json_encode($data);
               }
              }

            //   dd($data);
          }

    }

