<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $orders = Order::where('user_id',Auth::id())->get();
        return view('client.orders.index',compact('orders','categories'));
    }

    public function view($id)
    {
        $categories = Category::all();
        $orders = Order::where('id', $id)->where('user_id', Auth::id())->first();
        return view('client.orders.view',compact('orders','categories'));
    }

    public function viewProfile()
    {
        $categories = Category::all();
        return view('client.profile.index',compact('categories'));
    }

    public function editProfile()
    {
        $categories = Category::all();
        return view('client.profile.edit',compact('categories'));
    }

    public function update(Request $request, $id)
    {
        
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|unique:users,email,'.$id,
            'phone_no' => ['required', 'string','max:11','regex:/^((09|\\+?950?9|\\+?95950?9)\\d{7,9})$/','unique:users,phone_no,'.$id],
            'address' => ['required', 'string', 'max:255'],      
        ]);

        $users = User::find($id);

        if($request->hasFile('image'))
        {
            $path = 'storage/images/profile/'. $users->name . '/' . $users->image;
            if(File::exists($path))
            {
                File::delete($path);
            }

            $destination_path = 'public/images/profile';
            $file = $request->file('image');
            $file_name = $file->getClientOriginalName();
            request()->file('image')->storeAs($destination_path,$request->input('name'). '/' .$file_name);
            $users->image = $file_name;
        }

        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->phone_no = $request->input('phone_no');
        $users->address = $request->input('address');
        $users->update();
        return redirect('/profile')->with('status',"Profile updated successfully");

    }

    public function changePassword()
    {
        $categories = Category::all();
        return view('client.profile.password',compact('categories'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:6|max:100',
            'password' => 'required|min:6|max:100',
            'password_confirmation' => 'required|same:password'
        ]);

        $current_user=auth()->user();
        
        if(Hash::check($request->old_password,$current_user->password)){
            
            $current_user->password = bcrypt($request->input('password'));
            $current_user->update();
            return redirect('/profile')->with('status','Password successfully updated');
        
        }else{

            return redirect()->back()->with('error','Old password does not match');
        }
    }
}
