<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOcrTextsTable extends Migration
{
    public function up()
    {
        Schema::create('ocr_texts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained()->onDelete('cascade');
            $table->longText('recognized_text');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ocr_texts');
    }
}
