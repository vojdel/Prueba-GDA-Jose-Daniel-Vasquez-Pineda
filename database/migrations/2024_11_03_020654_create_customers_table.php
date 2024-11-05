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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('dni')->comment('Documento de Identidad');
            $table->integer('id_reg');
            $table->integer('id_com');
            $table->string('email', 120)->comment('Correo Electrónico')
                ->unique('email_UNIQUE');
            $table->string('name', 45)->comment('Nombre');
            $table->string('last_name', 45)->comment('Apellido');
            $table->string('address', 255)->comment('Dirección');
            $table->dateTime('date_reg', precision: 0)
                ->comment('Fecha y Hora de Registro');
            $table->enum('trash', ['A', 'I'])->default('A')
                ->comment('estado del registro:\n A: Activo\n I : Desactivo\n trash: Registro eliminado');
            $table->foreign('id_com', 'fk_customers_communes1_idx')
                ->references('id_com')->on('communes')
                ->onDelete('cascade');
            $table->engine('MyISAM');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
