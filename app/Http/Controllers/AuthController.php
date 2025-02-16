<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Handle user login.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Login(Request $request)
    {
        // Validate the login request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Check if the 'remember_me' checkbox is checked
        $remember = $request->has('remember_me');

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            // Regenerate session to prevent session fixation
            $request->session()->regenerate();
            return redirect()->route('home')->with([
                'status' => 'success',
                'message' => 'Login success'
            ]);
        }

        // Redirect back with an error message if authentication fails
        return redirect()->back()->with([
            'status' => 'failed',
            'message' => 'Email atau password salah'
        ]);
    }

    /**
     * Handle user registration.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function register(Request $request)
    {
        // Validate the registration request
        $request->validate([
            'name' => 'required|min:5|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:255',
            'password_confirm' => 'required|same:password',
        ]);

        // Create a new user instance
        $newUser = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Save the new user to the database
        $newUser->save();

        // Log in the new user
        Auth::login($newUser);
        return redirect()->route('home')->with([
            'status' => 'success',
            'message' => 'Register success, please verify your email'
        ]);
    }

    /**
     * Handle user logout.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Log out the user
        Auth::logout();
        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with([
            'status' => 'success',
            'message' => 'Logout success'
        ]);
    }
}
