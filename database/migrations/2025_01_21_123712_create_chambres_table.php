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
        if (!Schema::hasTable('chambres')) {
            Schema::create('chambres', function (Blueprint $table) {
                $table->id();
                $table->string('nom');
                $table->integer('prix');
                $table->text('description');
                $table->string('categorie');
                $table->integer('capacite');
                $table->enum('disponibilite', ['oui', 'non'])->default('oui');
                $table->timestamps();
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chambres');
    }
};
