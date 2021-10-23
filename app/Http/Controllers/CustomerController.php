<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\support\facades\redirect;
use Session;
class CustomerController extends Controller
{
    public function all_customer(){
    $customer= Customer::all();
    //    dd($admin);
       return view('admin.customer.all_customer')->with(compact('customer'));
    }
    public function add_customer(){
        return view('admin.customer.add_customer');
    }
    public function store_customer(Request $request){
        $data = $request->all();
        $customer = new Customer();
        $customer->customer_name = $data['customer_name'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_phone = $data['customer_phone'];
        $customer->customer_password = md5($data['customer_phone']);
        
        $customer->save();
       
        // dd($data);
        Session::put('message','Thêm customer thành công ');
        return Redirect::to('customer');
     }

}
