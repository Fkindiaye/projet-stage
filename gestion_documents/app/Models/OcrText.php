<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OcrText extends Model
{
    protected $fillable = ['document_id', 'recognized_text'];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
