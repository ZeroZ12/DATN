<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AutherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['login', 'register']);
    }
    /**
     * Show the login form.
     */
    public function login()
    {
        return view('auth.login');
    }
    /**
     * Show the registration form.
     */
    public function register()
    {
        return view('auth.register');
    }
}
