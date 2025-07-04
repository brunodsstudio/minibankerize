<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('propostas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('status', ['pendente', 'processada'])->nullable();
            $table->string('cpf');
            $table->string('data_nascimento');
            $table->decimal('valor_emprestimo', 8, 2);
            $table->string('chavepix');

       
            $table->timestamps();
        });

        
    }

    public function down(): void
    {
        Schema::dropIfExists('propostas');
    }

};
