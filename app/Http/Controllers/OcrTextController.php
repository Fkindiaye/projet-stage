<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OcrText;

class OcrTextController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'document_id' => 'required|exists:documents,id',
            'recognized_text' => 'required|string',
        ]);

        $ocr = OcrText::create([
            'document_id' => $request->document_id,
            'recognized_text' => $request->recognized_text,
        ]);

        return response()->json(['success' => true, 'data' => $ocr]);
    }
}
