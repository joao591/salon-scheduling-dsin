<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id(); // Chave primária
            $table->date('data_agendamento'); // Data do agendamento
            $table->time('hora_agendamento'); // Hora do agendamento
            $table->unsignedBigInteger('cliente_id'); // Chave estrangeira para clientes
            $table->string('status', 45)->nullable(); // Status do agendamento
            $table->timestamps(); // Campos updated_at e created_at

            // Definição da chave estrangeira
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendamentos');
    }
}
