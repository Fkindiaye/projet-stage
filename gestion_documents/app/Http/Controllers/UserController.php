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
        // Récupérer tous les utilisateurs
        $users = User::all();

        // Récupérer l'utilisateur connecté
        $currentUser = Auth::user();

        // Envoyer à la vue 'profil'
        return view('profil', compact('users', 'currentUser'));
    }

    // Affiche le formulaire de création d'un utilisateur
    public function create()
    {
        return view('users.create');
    }

    public function index() {
        // Par exemple, rediriger ailleurs
        return redirect()->route('users.create');
    }

    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('users.edit', compact('user'));
}

    // Met à jour le profil de l'utilisateur connecté
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validation simple (ajuste selon tes besoins)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Mise à jour des données
        $user->name = $request->name;
        $user->email = $request->email;

        // Si mot de passe fourni, le mettre à jour
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profil')->with('success', 'Profil mis à jour avec succès.');
    }
}
