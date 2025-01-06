<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
  
    public function login(){


return view("sellers.auth.login");

    }


public function LoginAuthentication(request $request){

$Validation = $request->validate([

'email' => ['required','max:100','email'],
'password' => ['required','min:8','max:32']

]);

if(Auth::attempt($Validation)){

    $request->session()->regenerate();

    return redirect()->route('seller.dashboard');

}

}



    public function destroy(request $request){

        auth()->guard('seller')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

    }

}
