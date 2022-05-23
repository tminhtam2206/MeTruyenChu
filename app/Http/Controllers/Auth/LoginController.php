<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{
    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;
    
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){   
        $input = $request->all();
  
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
        ]);

        $remember_me = $request->has('remember_me') ? true : false;
  
        $fieldType = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if(Auth::attempt([$fieldType => $request->name, 'password' => $request->password], $remember_me)){
            if(Auth::user()->lock == 'N'){
                ghiLog('Đăng nhập');

                if(Auth::user()->role == 'admin'){
                    return redirect()->route('admin.dashboard');
                }
                else if(Auth::user()->role == 'mod'){
                    return redirect()->route('mod.dashboard');
                }
                else{
                    return redirect()->route('member.dashboard');
                }
            }else{
                Auth::logout();
                return redirect()->route('trangchu.dang_nhap')
                ->with('error','Tài khoản hiện đang bị khóa!');
            }
        }else{
            return redirect()->route('trangchu.dang_nhap')
                ->with('error','Tên đăng nhập hoặc mật khẩu không đúng!');
        }
          
    }
}
