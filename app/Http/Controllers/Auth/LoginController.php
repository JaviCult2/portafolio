<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $route = "/";

        $credentials = $request->only(['user', 'password']);

        User::where('user', $request->user)->first();

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = User::find(Auth::user()->id);

            switch ($user->role->name) {
                case "admin":
                    $route = "admin/app/home";
                    break;
                case "visitor":
                    $route = "web/app/home";
                    break;
            }

        }
        return $route;
    }
}
