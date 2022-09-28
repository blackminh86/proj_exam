<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $pathViewController = '';
    protected $controllerName     = '';
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.auth.login.';
        $this->controllerName = 'login';
        view()->share('controllerName', $this->controllerName);
    }
    public function login(Request $request)
    {

        if ($request->getMethod() == 'GET') {
            if (Auth::check()) {
                return redirect()->route('dashboard');
            } else {
                return view($this->pathViewController . 'index');
            }
        }

        $credentials = $request->only(['email', 'password']);
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->withInput();
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


}
