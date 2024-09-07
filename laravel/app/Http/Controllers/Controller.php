<?php
//----------------original---
// namespace App\Http\Controllers;

// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Validation\ValidatesRequests;
// use Illuminate\Routing\Controller as BaseController;

// class Controller extends BaseController
// {
//     use AuthorizesRequests, ValidatesRequests;
// }
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\User; // Assuming you're using Eloquent for User model
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        // Load any necessary services, helpers, or middleware here
    }

    public function login(Request $request)
    {
        // Validate the login form input
        $request->validate([
            'identity' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to login using Laravel's Auth system
        $credentials = [
            'email' => $request->input('identity'), // Assuming identity is email
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            // Authentication passed, redirect to dashboard
            return redirect()->route('dashboard');
        } else {
            // Authentication failed, send back to login with error
            return redirect()->back()->withErrors(['message' => 'Invalid login credentials.']);
        }
    }

    public function logout()
    {
        // Logout the user using Laravel's Auth system
        Auth::logout();
        return redirect()->route('login');
    }

    // Other methods, like register, can be added here...
}
