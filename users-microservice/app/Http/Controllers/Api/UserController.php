<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Return All Users
     */
    public function getUsers()
    {
        return response()->success(User::all());
    }

    /**
     * Return User Admin
     */
    public function getUserAdmin()
    {
        return response()->success(User::where('is_admin', true)->first());
    }
}
