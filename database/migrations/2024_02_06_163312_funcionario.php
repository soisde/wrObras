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
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->increments('idFuncionario');
            $table->string('nomeFuncionario', 255);
            $table->date('dataNascimento');
            $table->string('email', 255)->unique();
            $table->char('foneFuncionario', 20)->nullable();
            $table->string('enderecoFuncionario', 255)->nullable();
            $table->string('cidadeFuncionario', 100)->nullable();
            $table->char('estadoFuncionario', 50)->nullable();
            $table->char('cepFuncionario', 10)->nullable();
            $table->date('dataContratacao')->nullable();
            $table->string('tipoFuncionario', 100)->nullable();
            $table->decimal('salario', 10,2)->nullable();

             // O tipo ENUM precisa ser tratado de maneira diferente, já que o Laravel não o suporta nativamente
             // Você pode usar uma restrição de verificação (check constraint) ou usar um VARCHAR e lidar com a validação em seu código de aplicativo
             // Aqui está um exemplo usando VARCHAR:
             // Se você deseja impor um comportamento semelhante ao ENUM, considere adicionar uma restrição de verificação ou usar validação em nível de aplicativo
             //$table->string('status')->nullable(); // Utilize um campo VARCHAR e trate a validação no código do seu aplicativo
             // Ou você pode usar esta abordagem:
             //$sql = "ALTER TABLE funcionarios ADD COLUMN status ENUM('ativo', 'inativo') NOT NULL DEFAULT 'ativo'";
             //$this->connection->statement($sql);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
};
