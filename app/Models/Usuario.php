<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios'; //'$table': Define o nome da tabela no banco de dados associada a este modelo como 'usuarios'.
    protected $primaryKey = 'id_usuario';
    //'$primaryKey': Define a chave primária da tabela como 'id_usuario'. Isso substitui a convenção padrão do Eloquent, que assume que a chave primária é 'id'.

    public function tipo_usuario()
    {
        return $this->morphTo('tipo_usuario', 'tipo_usuario_type', 'tipo_usuario_id');
    } //morphTo('tipo_usuario', 'tipo_usuario_type', 'tipo_usuario_id'): Esse método indica que o modelo Usuario pode pertencer a vários tipos de outros modelos.
} //Em resumo, esse código define um modelo Eloquent chamado Usuario com atributos personalizados para a tabela e a chave primária,
// e um relacionamento polimórfico chamado tipo_usuario, que permite associar instâncias de Usuario a diferentes tipos de modelos.
