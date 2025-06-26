<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ Import du trait
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partage extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'destinataire_id',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function destinataire()
    {
        return $this->belongsTo(User::class, 'destinataire_id');
    }
}
