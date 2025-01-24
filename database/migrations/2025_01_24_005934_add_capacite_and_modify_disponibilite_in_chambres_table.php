<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCapaciteAndModifyDisponibiliteInChambresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chambres', function (Blueprint $table) {
            // Ajouter la colonne capacite
            $table->integer('capacite')->after('categorie');

            // Modifier la colonne disponibilite pour utiliser ENUM
            $table->enum('disponibilite', ['oui', 'non'])->default('oui')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chambres', function (Blueprint $table) {
            // Supprimer la colonne capacite
            $table->dropColumn('capacite');

            // Revenir à la colonne disponibilite d'origine
            $table->boolean('disponibilite')->default(true)->change();
        });
    }
}
