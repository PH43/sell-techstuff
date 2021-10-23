<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Illuminate\support\facades\redirect;
session_start();
use DB;
class BrandController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else
        return Redirect::to('admin')->send();
    }
    public function add_brand_product()
    {
        return view('admin.add_brand_product');
    }

    
    public function all_brand_product()
    {
        $this->AuthLogin();
        $all_brand_product = DB::table('tbl_brand')->paginate(5);
        // $manager_category_product =  view('admin.all_category_product')
        //                             ->with('all_category_product',$all_category_product);
        // return view('Admin_layouts')->with('admin.all_category_product',$manager_category_product);
        // dd($all_brand_product);
        return view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);

        // dd($all_category_product);
    }
    public function save_brand_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data ['brand_name'] = $request->brand_product_name;
        $data ['brand_desc'] = $request->brand_product_desc;
        $data ['brand_status'] = $request->brand_product_status;

       DB::table('tbl_brand')->insert($data);
       Session::put('message','thêm thương hiệu sản phẩm thành công');
    //    dd($data);
       return redirect::to('add-brand-product');

    }
    public function unactive_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status' =>1]);

        Session::put('message','kích hoạt thêm danh mục sản phẩm thành công');

        return redirect::to('all-brand-product');
    }
    public function active_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=> 0]);
        Session::put('message','Không kích hoạt thêm danh mục sản phẩm thành công');

        return redirect::to('all-brand-product');
    }
    public function edit_brand_product($brand_product_id){
        $this->AuthLogin();
        $edit_brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        return view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
        // dd($category_product_id);

    }
    public function update_brand_product(Request $request,$brand_product_id){
        $this->AuthLogin();
        $data = array();
        $data ['brand_name'] = $request->brand_product_name;
        $data ['brand_desc'] = $request->brand_product_desc;

        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
        Session::put('message','Cập nhật thương hiệu thành công');
        // dd($category_product_id);
        return redirect::to('all-brand-product');


    }
    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
        Session::put('message','xoá thương hiệu thành công');
        // dd($category_product_id);
        return redirect::to('all-brand-product');
    }
    public function seach(Request $request){
        $this->AuthLogin();
        $keywords =$request-> keywords_submit;
        $seach_brand = DB::table('tbl_brand')->where('brand_name','like','%'.$keywords.'%')->
        paginate(5);
        // $manager_category_product =  view('admin.all_category_product')
        //                             ->with('all_category_product',$all_category_product);
        // return view('Admin_layouts')->with('admin.all_category_product',$manager_category_product);
        // dd($all_brand_product);
        // dd( $seach_brand);
        return view('admin.seach_brand')->with('seach_brand', $seach_brand);

        // dd($all_category_product);
    }
    

    //end function admin


    
    //function front end


    public function show_brand_home($brand_id){

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')
                                                         ->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')
                                               ->orderby('brand_id','desc')->get();

        $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=',
                                                         'tbl_brand.brand_id')
                                                  ->where('tbl_product.brand_id',$brand_id)
                                                  ->get();
                                                  
        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_id',$brand_id)
                                                  ->limit(1)
                                                  ->get(); 
            //    dd($brand_name)    ;                                                                       
        return view('pages.brand.show_brand')->with('category',$cate_product)
                                                   ->with('brand',$brand_product)
                                                   ->with('brand_by_id',$brand_by_id)
                                                   ->with('brand_name',$brand_name);
                                                   
    
    }
        
}
    


