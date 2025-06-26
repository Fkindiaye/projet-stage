<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Vue admin
            return view('users.dashboard.admin');
        } else {
            // Récupérer le nombre total de documents téléchargés ou partagés par l'utilisateur
            $totalDocuments = Document::where('user_id', $user->id)->count();

            // Statistique d'utilisation simple : ici on peut mettre un compteur de visites ou autre (si tu as)
            // Pour l'exemple, on met une valeur fixe ou 0
            $userVisits = $user->visits ?? 0;

            // Passer les données à la vue user
            return view('users.dashboard.user', compact('totalDocuments', 'userVisits'));
        }
    }
}
