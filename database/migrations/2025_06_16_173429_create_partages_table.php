<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartagesTable extends Migration
{
    public function up()
    {
        Schema::create('partages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_id');
            $table->unsignedBigInteger('destinataire_id');
            $table->timestamps();

            // Clés étrangères si tu veux (optionnel)
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
            $table->foreign('destinataire_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('partages');
    }
}
