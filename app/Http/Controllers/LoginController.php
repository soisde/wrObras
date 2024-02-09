<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Funcionario;
use App\Models\Usuario;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('site.login');
    }
    public function autenticar(Request $request)
    {
        $regras = [
            'email' => 'required|email',
            'password' => 'required'
        ]; //Aqui são definidas as regras de validação para os campos 'email' e 'password' usando o método validate fornecido pelo Laravel.

        $msg = [
            'email.required' => 'O campo de email é obrigatório',
            'email.email' => 'O e-mail informado não é valido',
            'password.required' => 'O campo de senha é obrigatório'
        ]; //As mensagens personalizadas para os erros de validação são definidas neste array.

        $request->validate($regras, $msg);
        // O método validate é chamado para validar os dados do formulário com base nas regras e mensagens fornecidas.
        // Se a validação falhar, o usuário será redirecionado de volta ao formulário com os erros apropriados.

        // print_r($request->all());
        $email = $request->get('email');
        $senha = $request->get('password');

        echo "E-mail: $email | Senha: $senha";
        echo "<br>"; //Os valores dos campos 'email' e 'password' são obtidos a partir da requisição.

        $usuario = Usuario::where('email', $email)->first();  //É feita uma consulta ao banco de dados para encontrar um usuário com o e-mail fornecido.

        if (!$usuario) {

            return back()->withErrors(['email' => 'O email informado nao esta cadastrado']); //Se não for encontrado um usuário com o e-mail fornecido, uma mensagem de erro é retornada.
        }
        if ($usuario->senha != $senha) {

            return back()->withErrors(['password' => 'Senha incorreta']);
        } //Se a senha fornecida não corresponder à senha armazenada no banco de dados para o usuário encontrado, uma mensagem de erro é retornada.
        //dd($usuario);

        $tipoUsuario = $usuario->tipo_usuario;
   
if ($tipoUsuario instanceof Aluno) {
    $tipo = 'aluno';
    session([
        'id'            => $tipoUsuario->idAluno,
        'nome'          => $tipoUsuario->nomeAluno,
        'email'         => $usuario->email,
        'tipo_usuario'  => 'Aluno',
    ]);

    return redirect()->route('dashboard.alunos');

} elseif ($tipoUsuario instanceof Funcionario) {
    $tipo = 'administrativo';
    if ($tipoUsuario->tipoFuncionario == 'administrativo') {
        session([
            'id'               => $tipoUsuario->idFuncionario,
            'nome'             => $tipoUsuario->nomeFuncionario,
            'email'            => $usuario->email,
            'tipo_usuario'     => $tipoUsuario->tipoFuncionario,
        ]);
        return redirect()->route('dashboard.administrativo'); // redireciona para a página principal do administrador

    } elseif ($tipoUsuario->tipoFuncionario == 'instrutor') {
        $tipo = 'instrutor';
        session([
            'id'               => $tipoUsuario->idFuncionario,
            'nome'             => $tipoUsuario->nomeFuncionario,
            'email'            => $usuario->email,
            'tipo_usuario'     => $tipoUsuario->tipoFuncionario,
        ]);
        return redirect()->route('dashboard.instrutor'); // redireciona para a página principal do instrutor
    }

    return back()->withErrors(['email' => 'Erro desconhecido de autenticação']);
}

    }
    }
