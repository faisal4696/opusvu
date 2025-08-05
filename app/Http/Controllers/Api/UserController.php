<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use http\Env\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Image;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function signUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|min:2',
            'email'=>'required|unique:users,email',
//            'date_of_birth'=>'required',
            'password'=>'required',
        ]);
        if($validator->fails()){
            return response()->json(['status'=>false,'message'=>$validator->errors()->first()]);
        }else{
            $inputs = $request->all();
            $inputs['password'] = bcrypt($inputs['password']);
//            $inputs['date_of_birth'] = $this->getFromDateAttribute($inputs['date_of_birth']);
            $user = $this->user->createUser($inputs);
            if($user){
                $usr = $this->user->where('id',$user->id)->select('id','name','email','date_of_birth','image','cover','language')->first();
                $responseArray = [];
                $responseArray['user'] = $usr;
                $responseArray['token'] = $user->createToken('opusvu')->accessToken;
                return response()->json(['status'=>true,'response'=>$responseArray,'message'=>'Signed up successfully']);
            }else{
                return response()->json(['status'=>false,'message'=>'Something Error']);
            }
        }
    }

    public function getFromDateAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }

    public function logIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required',
            'password'=>'required',
        ]);
        if($validator->fails()){
            return response()->json(['status'=>false,'message'=>$validator->errors()->first()]);
        }else{
            if(Auth::attempt(['email'=>$request->email , 'password'=>$request->password])){
                $user = Auth::user();
                if($request->device_id != null){
                    $user->device_id = $request->device_id;
                    $user->save();
                }
                $usr = $this->user->where('id',$user->id)->select('id','name','email','date_of_birth','image','cover','language')->first();
                $responseArray = [];
                $responseArray['user'] = $usr;
                $responseArray['token'] = $user->createToken('opusvu')->accessToken;
                return response()->json(['status'=>true,'response'=>$responseArray,'message'=>'Logged In Successfully']);
            }else{
                return response()->json(['status'=>false,'message'=>'Email or Password is wrong']);
            }
        }
    }

    public function getUserProfile()
    {
        $user = $this->user->where('id',Auth::user()->id)->select('id','name','email','date_of_birth','image','cover','language')->first();
        if($user->image != null){
            $user->image = URL::to('/').'/uploads/users/'.$user->image;
        }
        if($user->cover != null){
            $user->cover = URL::to('/').'/uploads/users/'.$user->cover;
        }
        return response()->json(['status'=>true,'response'=>$user,'message'=>'Profile Fetch Successfully']);
    }

    public function updateProfile(Request $request)
    {
        $user = $this->user->where('id',Auth::user()->id)->first();
        if($request->hasFile('image') != null){
            $validator = Validator::make($request->all(), [
                'image'=>'mimes:jpeg,jpg,png,gif',
            ]);
            if($validator->fails()){
                return response()->json(['status'=>false,'message'=>$validator->errors()->first()]);
            }else{
                $image = $request->image;
                $extension = rand() . '.' . $image->extension();
                $location = public_path('/uploads/users');
                $newImage = Image::make($image->getPathName());
                $newImage->save($location . '/' . $extension);
                $user['image'] = $extension;
            }
        }
        if($request->hasFile('cover') != null){
            $validator = Validator::make($request->all(), [
                'cover'=>'mimes:jpeg,jpg,png,gif|max:10000',
            ]);
            if($validator->fails()){
                return response()->json(['status'=>false,'message'=>$validator->errors()->first()]);
            }else {
                $cover = $request->cover;
                $extension = rand() . '.' . $cover->extension();
                $location = public_path('/uploads/users');
                $newCover = Image::make($cover->getPathName());
                $newCover->save($location . '/' . $extension);
                $user['cover'] = $extension;
            }
        }
        if($request->name != null){
            $user->name = $request->name;
        }
        if($request->language != null){
            $user->language = $request->language;
        }
        if($request->date_of_birth != null){
            $user->date_of_birth = $this->getFromDateAttribute($request->date_of_birth);
        }
        if($user->save()){
            if($user->image != null){
                $user->image = URL::to('/').'/uploads/users/'.$user->image;
            }
            if($user->cover != null){
                $user->cover = URL::to('/').'/uploads/users/'.$user->cover;
            }
            return response()->json(['status'=>true,'response'=>$user,'message'=>'Profile Update Successfully']);
        }
    }

    public function logOut()
    {
        $accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);
        $accessToken->revoke();
        return response()->json(['status'=>true,'message'=>'Logged Out Successfully']);
    }

    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()]);
        } else {
            $msg = 'Successful! Please Check Your Email To Reset Your Password...';
            $user = $this->user->where('email',$request->email)->first();
            if ($user) {
                $name = $user->name;
                $id = 'forget';
                $email = $request->email;
                $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
                $password = substr($random, 0, 5);
                $user->password = bcrypt($password);
                $user->save();
                Mail::to($email)->send(new SendEmail($name, $email, $id, $password));
                return response()->json(['status' => true, 'message' => 'User has been Successfully logged in']);
            } else {
                return response()->json(['status' => false, 'message' => 'User Not Found']);
            }
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['status'=>false,'message'=>$validator->errors()->first()]);
        }else{
            $user = Auth::user();
            $check = Hash::check($request->old_password, $user->password);
            if($check)
            {
                $user->password = bcrypt($request->new_password);
                $update = $user->save();
                if($update){
                    return response()->json(['status'=>true,'message'=>'Password Change Successfully']);
                }else{
                    return response()->json(['status'=>false,'message'=>'something wrong try again later']);
                }
            }else{
                return response()->json(['status'=>false,'message'=>'Your Old Password is not Match!']);
            }
        }
    }

    public function unauthorized()
    {
        return response()->json(['status'=>false,'message'=>'Unauthorized']);
    }
}
