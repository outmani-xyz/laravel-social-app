<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller {

    public function postSignup(Request $request) {
        $this->validate($request, [
            'full_name' => 'required|max:60',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $full_name = $request['full_name'];
        $email = $request['email'];
        $password = bcrypt($request['password']);
        $user = new User();
        $user->full_name = $full_name;
        $user->email = $email;
        $user->password = $password;
        $user->save();
        Auth::login($user);
        return redirect()->route('user.dashboard');
    }

    public function postSignin(Request $request) {
        if (!Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->back();
        }
        return redirect()->route('user.dashboard');
    }
    public function getLogout() {
        Auth::logout();
        return redirect()->route('home');
    }
    public function getAccount() {
        $user=Auth::user();
        return view('account',['user'=>$user]);
    }
    public function postAccount(Request $request) {
        $this->validate($request,['full_name'=>'required|max:60']);
        $user=Auth::user();
        $user->full_name=$request['full_name'];
        $user->update;
        $file=$request->file('image');
        $filename=$user->id.'-'.$user->full_name.'.jpg';
        if ($file) {
            Storage::disk('local')->put($filename,File::get($file));
        }
        return redirect()->route('user.account')->with(['user'=>$user]);
    }
    public function getImage($file) {
        $image=Storage::disk('local')->get($file);
        return new Response($image, 200);
    }

}
