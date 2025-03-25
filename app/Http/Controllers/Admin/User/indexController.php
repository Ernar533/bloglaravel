<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function __invoke()
    {
        $users = \App\Models\User::all();
        return view('admin.user.index', compact('users'));
    }
}
