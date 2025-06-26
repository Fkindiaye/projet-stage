<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'titre',
        'description',
        'categorie',
        'file_path',
        'user_id',
        'is_archived',
        'is_shared',
        'downloads',
        'nom_fichier',
        'ocr_text',
        'ocr_file_path',
      
    ];

    public function ocrText()
    {
        return $this->hasOne(OcrText::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function partages(): HasMany
    {
        return $this->hasMany(Partage::class, 'document_id');
    }

}
