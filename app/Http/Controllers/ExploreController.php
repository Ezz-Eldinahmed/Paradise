<?php

namespace App\Http\Controllers;

use App\Models\User;

class ExploreController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(8);
        return view('explore',['users'=>$users]);
    }
}
