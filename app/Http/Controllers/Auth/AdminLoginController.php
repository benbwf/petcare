<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Admin;
use App\User;

class AdminLoginController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest:admin');
  }
    public function showLoginForm ()
    {
      return view ('auth.admin-login');
    }
    public function login(Request $request){
      //validate the form data
      $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required|min:6'
      ]);

      //attempt to log user in
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
        //if successful, then redirect to their intended locale_get_display_region
        return redirect()->intended(route('admin.dashboard'));
      }

      //if unsuccessful, the redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
