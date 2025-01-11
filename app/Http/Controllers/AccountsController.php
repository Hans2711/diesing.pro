<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $loggedIn = Auth::check();

        if ($loggedIn) {
            return view("accounts.index");
        } else {
            $return_url = request()->get("return_url");
            return view("accounts.index-auth", [
                "return_url" => $return_url,
            ]);
        }
    }

    public function ungrant($username, $permission, $permission_token)
    {
        $user = User::where("username", $username)->first();

        if ($user) {
            if ($user->permissions_token == $permission_token) {
                $user->setPermission($permission, false);
                $user->save();
                return response()->json([
                    "success" => true,
                ]);
            }
        }
        return response()->json([
            "success" => false,
        ]);
    }

    public function grant($username, $permission, $permission_token)
    {
        $user = User::where("username", $username)->first();

        if ($user) {
            if ($user->permissions_token == $permission_token) {
                $user->setPermission($permission, true);
                $user->save();
                return response()->json([
                    "success" => true,
                ]);
            }
        }
        return response()->json([
            "success" => false,
        ]);
    }
}
