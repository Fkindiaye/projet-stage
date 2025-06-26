<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Affiche la page profil avec la liste des utilisateurs et le formulaire de modification du profil connecté
    public function showProfile()
    {
        $users = User::all();
        $currentUser = Auth::user();
        return view('profil', compact('users', 'currentUser'));
    }

    // Affiche le formulaire de création d'un utilisateur
    public function create()
    {
        return view('users.create');
    }

    // Redirection par défaut
    public function index()
    {
        return redirect()->route('users.create');
    }

    // Enregistre un nouvel utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,user', // ✅ Validation du rôle
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // ✅ Enregistrement du rôle
        ]);

        return redirect()->route('profil')->with('success', 'Utilisateur ajouté avec succès.');
    }

    // Affiche le formulaire d'édition
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Met à jour un utilisateur
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only('name', 'email'));

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }
}
