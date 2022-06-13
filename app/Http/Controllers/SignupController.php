<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;

class SignupController extends BaseController {

    public function login_form() {
        if(Session::get('user_id"')){
            return redirect('home');
        }
        $error = Session::get('error');
        Session::forget('error');
        return view('login')->with('error', $error);
    }

    public function do_login() {

        if(strlen(request('username')) == 0 || strlen(request('password')) == 0){
            Session::put('error', 'empty_fields');
            return redirect('login')->withInput();
        }

        $user = User::where('username', request('username'))->first();

        if(!$user || !password_verify(request('password'), $user->password)){
            Session::put('error', 'wrong');
            return redirect('login')->withInput();
        }


        Session::put('user_id', $user->id);

        return redirect('home');
    }

    public function register_form() {
        if(Session::get('user_id"')){
            return redirect('home');
        }
        $error = Session::get('error');
        Session::forget('error');
        return view('signup')->with('error', $error);
    }

    public function do_register() {
        if(strlen(request('username')) == 0 || strlen(request('password')) == 0){
            Session::put('error', 'empty_fields');
            return redirect('signup')->withInput();
        }
        else if(request('password') != request('confirm_password')){
            Session::put('error', 'bad_passwords');
            return redirect('signup')->withInput();
        }
        else if(User::where('username', request('username'))->first()){
            //Session::put('error', 'existing');
            return redirect('signup')->withInput();
        }
        else if(!preg_match("/^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*]{8,16}$/", request('password'))){
            //Session::put('error', 'wrong_characters');
            return redirect('signup')->withInput();
        }


        $user = new User;
        $user->username = request('username');
        $user->password = password_hash(request('password'), PASSWORD_BCRYPT);
        $user->save();

        Session::put('user_id', $user->id);

        return redirect('home');
    }

    public function signup() {
        return view('signup');
    }

    public function login() {
        return view('login');
    }

    public function logout(){
        Session :: flush();
        return redirect('login');
    }

    public function check_username($search_param){
        $count = User :: where('username', '=', $search_param)
                        ->count();

        $gia_presente = false;
        if($count >0){
            $gia_presente = true;
        }

        $json_user = [];
        $json_user = [
            'gia_presente' => $gia_presente
        ];

        return $json_user;
    }
}
?>