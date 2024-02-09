<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;
    protected $table = 'funcionarios';
    protected $primaryKey ='idFuncionario';

    public function usuario(){
        return $this->morphOne(Usuario::class, 'tipo_usuario');
    }
}
//Essa parte é referente ao banco de dados , com o conteudo das tabelas, onde usamos a primarykey que é o 'id' da tabela do usuario
//Em resumo, esse código define um modelo Eloquent chamado 'Funcionario' com uma chave primária personalizada e um relacionamento polimórfico com a classe 'Usuario'.
// Esse relacionamento permite associar um 'funcionário' a um 'usuário' na aplicação Laravel.
