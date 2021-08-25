<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use JWTAuth;
// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    public function index()
    {
        return view('login');
    }

    // public function register()
    // {
    //     return view('register');
    // }

    public function dashboard(Request $request)
    {
        return view('welcome');
    }

    public function finance()
    {
        return view('finance');
    }

    public function account_modal_create()
    {
        return view('finance_modal\account\create');
    }
}
