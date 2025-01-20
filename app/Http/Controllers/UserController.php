<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showLinks(User $user)
    {
        $links = $user->links()->get();

        return view('showLinks', compact('links'));
    }

    public function customizeLinksPage()
    {
        return view('customize');
    }

    public function updateStyles(Request $request)
    {
        dd($request);
    }
}
