<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            // Ajouter les colonnes manquantes
            if (!Schema::hasColumn('quizzes', 'title')) {
                $table->string('title')->after('id');
            }

            if (!Schema::hasColumn('quizzes', 'description')) {
                $table->text('description')->nullable()->after('title');
            }

            if (!Schema::hasColumn('quizzes', 'user_id')) {
                $table->foreignId('user_id')->constrained()->onDelete('cascade')->after('description');
            }
        });
    }

    public function down()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            // Supprimer les colonnes ajoutées
            $table->dropColumn(['title', 'description', 'user_id']);
        });
    }
};
