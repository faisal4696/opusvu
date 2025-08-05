<?php

namespace App\Http\Controllers;

use App\Models\User;
use Image;
use Validator;
use Session;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function viewUsers()
    {
        $users = $this->user->where('role','0')->paginate(8);
        return view('admin.view-users',compact('users'));
    }

    public function deleteUser($id)
    {
        $user = $this->user->deleteUser($id);
        if($user){
            Session::flash('success','User Delete Successfully');
            return back();
        }else{
            Session::flash('error','Failed Try Again Later');
            return  back();
        }
    }

    public function editUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'date_of_brith'=>'required',
            'image'=>'mimes:jpeg,jpg,png,gif|max:10000',
        ]);
        $formData = $request->all();
        $id = $formData['user_id'];
        $updateData = $request->except('user_id','_token');
        if($request->hasFile('image')){
            $image = $request->image;
            $extension = rand() . '.' . $image->extension();
            $location = public_path('/uploads/users');
            $newImage = Image::make($image->getPathName());
            $newImage->save($location . '/' . $extension);
            $updateData['image'] = $extension;
        }
        $update = $this->user->updateUser($id,$updateData);
        if($update){
            Session::flash('success','User Record Update Successfully');
            return back();
        }else{
            Session::flash('error','Failed Try Again Later');
            return  back();
        }
    }

    public function mailView()
    {
        return view('mail.forget-password');
    }
}
