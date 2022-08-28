<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $user = User::with('role')
            ->where('user', $request->user)
            ->where('password', $request->password)
            ->where('active', true)
            ->first();

        $route = "";

        if ($user) {

            switch ($user->role->name) {
                case "admin":
                    $route = "admin/app/home";
                    break;
                case "visitor":
                    $route = "web/app/home";
                    break;
                default:
                    $route = "/";
                    break;
            }
        }

        return $route;
    }
}
