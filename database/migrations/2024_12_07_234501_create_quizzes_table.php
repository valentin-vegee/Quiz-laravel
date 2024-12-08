<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{  
    /**
    * Exécutez la migration.
    *
    * @return void
    */
   public function up()
   {
       Schema::create('quizzes', function (Blueprint $table) {
           $table->id();
           $table->string('title');
           $table->text('description')->nullable();
           $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Lien avec l'utilisateur
           $table->timestamps();
       });
   }

   /**
    * Annulez la migration.
    *
    * @return void
    */
   public function down()
   {
       Schema::dropIfExists('quizzes');
   }
};
