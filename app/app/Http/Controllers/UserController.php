<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show the profile for a given user
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id) {
        return view('user', [
            'user' => User::findOrFail($id)
        ]);
    }
}
