<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('setting');
    }

    public function update(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'language' => 'required|in:fr,en',
            'password' => 'nullable|string|min:6'
        ]);

        $user = auth()->user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->language = $request->input('language');
        $user->save();

        return redirect()->route('parametres')->with('success', 'Paramètres mis à jour.');
    }
}
