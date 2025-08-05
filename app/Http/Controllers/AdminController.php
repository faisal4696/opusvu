<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Video;
use PHPUnit\Framework\Constraint\Count;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AdminController extends Controller
{
    private $user;
    private $video;
    private $category;

    public function __construct(User $user,Video $video, Category $category)
    {
        $this->user = $user;
        $this->video = $video;
        $this->category = $category;
    }

    public function loginView()
    {
        return view('admin.login');
    }

    public function DashboardView()
    {
        $users = $this->user->all();
        $userCount = count($users);
        $categories = $this->category->all();
        $categoryCount = Count($categories);
        $videos = $this->video->all();
        $videoCount = Count($videos);
        return view('admin.index',compact('userCount','videoCount','categoryCount'));
    }

    public function logIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required',
            'password'=>'required',
        ]);
        if(Auth::attempt(['email'=>$request->email , 'password'=>$request->password])) {
            if(Auth::user()->role == '1'){
                Session::flash('success','Welcome Back');
                return redirect()->route('dashboard');
            }else{
                Session::flash('error','You Are Not a Admin');
                return back();
            }
        }else{
            Session::flash('error','email or password is wrong');
            return back();
        }
    }

    public function logOut()
    {
        Auth::logout();
        return redirect()->back();
    }
}
