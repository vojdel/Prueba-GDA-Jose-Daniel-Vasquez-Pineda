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
        Schema::create('communes', function (Blueprint $table) {
            $table->id('id_com');
            $table->integer('id_reg');
            $table->string('description', 90);
            $table->enum('trash', ['A', 'I'])->default('A');
            $table->primary('id_com');
            $table->foreign('id_reg', 'fk_communes_region_idx')
                ->references('id_reg')->on('regions')
                ->onDelete('cascade');
            $table->engine('MyISAM');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communes');
    }
};
