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
        Schema::table('questions', function (Blueprint $table) {
          ; 
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade'); // Ajouter la FK vers `quizzes`
        });
    }

    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
       
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Restaurer user_id
        });
    }
};
