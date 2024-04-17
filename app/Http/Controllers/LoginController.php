<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{
      // Existing login function
      public function login(Request $request)
      {
          $credentials = $request->only('email', 'password');
  
          if (Auth::attempt($credentials)) {
              // Authentication passed...
              return redirect()->intended('/home');
          }
  
          return redirect()->back()->withInput($request->only('email'));
      }
  
      // New function to login as administrator
      public function loginAsAdmin(Request $request)
      {
          $credentials = $request->only('email', 'password');
  
          if (Auth::attempt($credentials) && Auth::user()->role_id === 1) {
              // Authentication passed and the user is an admin
              return redirect()->intended('/admin/dashboard');
          }
  
          // If not admin or authentication fails, redirect back
          return redirect()->back()->withInput($request->only('email'));
      }
}
