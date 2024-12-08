<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->boolean('allow_multiple_answers')->default(false); // Ajout du champ
        });
    }
    
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('allow_multiple_answers');
        });
    }
};
