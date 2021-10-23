<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles;
use App\Admin;
use Auth;
use Illuminate\support\facades\redirect;
use Session;
class UserController extends Controller
{
   public function index(){

       $admin = Admin::with('roles')->orderby('admin_id','DESC')->paginate(5);
    //    dd($admin);
       return view('admin.user.all_user')->with(compact('admin'));
      
   }
   public function Assign_roles(Request $request){
        if(Auth::id()==$request->admin_id){
        return redirect()->back()->with('message','bạn không thể phân quyền chính mình');
        }
       $user = Admin::where('admin_email',$request->admin_email)->first();
       $user->roles()->detach();
       if($request->author_role){
        $user->roles()->attach(Roles::where('name','author')->first());
       }
       if($request->user_role){
        $user->roles()->attach(Roles::where('name','user')->first());
        }
        if($request->admin_role){
        $user->roles()->attach(Roles::where('name','admin')->first());
        }
        // dd($user);
       return redirect()->back()->with('message','cấp quyền thành công');
    }
    public function delete_user_roles($admin_id){
        if(Auth::id()==$admin_id){
            return redirect()->back()->with('message','bạn không được xoá chính mình');
        }
        $admin = Admin::find($admin_id);
        if($admin){
            $admin->roles()->detach();
            $admin->delete();
        }
        $admin ->delete();
        return redirect()->back()->with('message','Xoá thành công');
        
    }
    public function add_users(){
        return view('admin.user.add_user');
    }
    public function store_users(Request $request){
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_password = md5($data['admin_password']);
        
        $admin->save();
        $admin->roles()->attach(Roles::where('name','user')->first());
        // dd($admin);
        Session::put('message','Thêm user thành công ');
        return Redirect::to('users');
    }
    public function impersonate($admin_id){
        $user = Admin::where('admin_id',$admin_id)->first();
        if($user){
            session()->put('impersonate',$user->admin_id);
        }
        return redirect('/users');
    }
    public function impersonate_destroy(){
        session()->forget('impersonate');
        return redirect('/users');
    }
   }


