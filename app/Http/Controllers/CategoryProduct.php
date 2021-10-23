<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Illuminate\support\facades\redirect;
session_start();
use DB;

class CategoryProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else
        return Redirect::to('admin')->send();
    }
    public function add_category_product()
    {
        $this->AuthLogin();
        return view('admin.add_category_product');
    }

    
    public function all_category_product()
    {
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->paginate(5);
        // $manager_category_product =  view('admin.all_category_product')
        //                             ->with('all_category_product',$all_category_product);
        // return view('Admin_layouts')->with('admin.all_category_product',$manager_category_product);
        return view('admin.all_category_product')->with('all_category_product', $all_category_product);

        // dd($all_category_product);
    }
    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data ['category_name'] = $request->category_product_name;
        $data ['category_desc'] = $request->category_product_desc;
        $data ['category_status'] = $request->category_product_status;

       DB::table('tbl_category_product')->insert($data);
       Session::put('message','thêm danh mục sản phẩm thành công');
       return redirect::to('add-category-product');

    }
    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status' =>1]);

        Session::put('message','kích hoạt thêm danh mục sản phẩm thành công');

        return redirect::to('all-category-product');
    }
    public function active_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=> 0]);
        Session::put('message','Không kích hoạt thêm danh mục sản phẩm thành công');

        return redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        return view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
        // dd($category_product_id);

    }
    public function update_category_product(Request $request,$category_product_id){
        $this->AuthLogin();
        $data = array();
        $data ['category_name'] = $request->category_product_name;
        $data ['category_desc'] = $request->category_product_desc;

        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        // dd($category_product_id);
        return redirect::to('all-category-product');


    }
    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','xoá sản phẩm thành công');
        // dd($category_product_id);
        return redirect::to('all-category-product');
    }
    public function seach(Request $request)
    {
        $this->AuthLogin();
        $keywords =$request-> keywords_submit;
        $seach_category = DB::table('tbl_category_product')->where('category_name','like','%'.$keywords.'%')
                                                           ->get();
        // $manager_category_product =  view('admin.all_category_product')
        //                             ->with('all_category_product',$all_category_product);
        // return view('Admin_layouts')->with('admin.all_category_product',$manager_category_product);
        return view('admin.seach_category')->with('seach_category', $seach_category );

        // dd($all_category_product);
    }
    
    //end function admin

    public function show_category_home($category_id){

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=',
                                                         'tbl_category_product.category_id')
                                                  ->where('tbl_product.category_id',$category_id)->get(); 

                                            
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)
                                                            ->limit(1)
                                                            ->get();
                                                        //   dd($category_name);
        return view('pages.category.show_category')->with('category',$cate_product)
                                                   ->with('brand',$brand_product)
                                                   ->with('category_by_id',$category_by_id)
                                                   ->with('category_name',$category_name);

    }

    

}
