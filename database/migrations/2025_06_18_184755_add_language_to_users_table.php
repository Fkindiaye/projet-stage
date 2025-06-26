<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('language')->default('fr')->after('role'); // ou après un autre champ si tu préfères
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('language');
    });
}

};
