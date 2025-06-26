<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // ✅ Ajouter cette ligne

class Document extends Model
{
    use HasFactory, SoftDeletes; // ✅ Optionnellement, tu peux aussi ajouter HasFactory ici

    protected $fillable = ['titre', 'description', 'categorie', 'fichier'];
    public function ocrText()
 {
    return $this->hasOne(OcrText::class);
 }
}

