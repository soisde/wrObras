<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id('idAluno');
            $table->string('nomeAluno', 255);
            $table->date('dataNascimento')->nullable();
            $table->string('email', 255)->unique();
            $table->string('foneAluno', 20)->nullable();
            $table->string('enderecoAluno', 255)->nullable();
            $table->string('cidadeAluno', 100)->nullable();
            $table->string('estadoAluno', 50)->nullable();
            $table->string('cepAluno', 10)->nullable();
            $table->timestamp('dataInscricao')->useCurrent();
            $table->decimal('altura', 3,2)->nullable();
            $table->decimal('peso',5,2)->nullable();
            $table->string('objetivo',255)->nullable();
			$table->string("plano",100);
			$table -> enum ( "status" , [ "ativo" , "inativo" ]) -> default ( "ativo" );
			$table -> timestamp ("criado_em") -> useCurrent ();
			$table -> timestamp ("atualizado_em") -> useCurrent ();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("alunos");
    }
};
