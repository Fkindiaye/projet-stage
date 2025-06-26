<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprimer la clé étrangère et la colonne si elle existe
            if (Schema::hasColumn('users', 'entreprise_id')) {
                $table->dropForeign(['entreprise_id']);
                $table->dropColumn('entreprise_id');
            }
        });

        Schema::table('documents', function (Blueprint $table) {
            if (Schema::hasColumn('documents', 'entreprise_id')) {
                $table->dropForeign(['entreprise_id']);
                $table->dropColumn('entreprise_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('entreprise_id')->nullable()->after('role');
            $table->foreign('entreprise_id')->references('id')->on('entreprises');
        });

        Schema::table('documents', function (Blueprint $table) {
            $table->unsignedBigInteger('entreprise_id')->nullable()->after('user_id');
            $table->foreign('entreprise_id')->references('id')->on('entreprises');
        });
    }
};
