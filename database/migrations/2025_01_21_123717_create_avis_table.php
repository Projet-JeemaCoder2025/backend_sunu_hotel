<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('avis')) {
            Schema::create('avis', function (Blueprint $table) {
                $table->id();
                $table->foreignId('idClient')->constrained('users');
                $table->foreignId('idReservation')->constrained('reservation');
                $table->text('commentaire');
                $table->integer('evaluation')->unsigned()->between(1,5);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avis');
    }
};
