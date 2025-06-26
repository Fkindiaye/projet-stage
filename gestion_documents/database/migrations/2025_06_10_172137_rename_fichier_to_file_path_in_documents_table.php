<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // ✅ C’est ici qu’il faut importer DB

return new class extends Migration
{
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->string('file_path')->nullable();
        });

        DB::statement('UPDATE documents SET file_path = fichier');

        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('fichier');
        });
    }

    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->string('fichier')->nullable();
        });

        DB::statement('UPDATE documents SET fichier = file_path');

        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('file_path');
        });
    }
};
