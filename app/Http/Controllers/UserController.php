<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('isManagerOrStaff');
    }
    
    public function index(){
        $users = User::orderBy('name')->paginate(5);
        return view('admin.user.index',compact('users'));
    }

    public function edit($id){
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.user.edit',compact('user','roles'));
    }

    public function addRole(Request $request, $id){
        $user=User::find($id);
        $roleIds = $request->role_ids;
        $user->roles()->sync($roleIds);
        return redirect('admin/users');
    }

    static function userCount()
    {
        return User::all()->count();
    }

    public function search(Request $request)
    {
        $search_user = request()->query('search');
        if($search_user){
            $users = User::where('name','LIKE',"%{$search_user}%")->orwhere('phone_no','LIKE',"%{$search_user}%")->simplePaginate(3);
        }else{
            $users = User::simplePaginate(3);
        }
        return view('admin.user.search',compact('users'));
    }
}
