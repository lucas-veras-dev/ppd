<?php
// iniciando sessão
session_start();

require_once('../vendor/autoload.php');

use App\Model\UsuarioModel;
use App\Controller\Service\UsuarioService;

// criando objetos
$usuarioModel = new UsuarioModel();
$usuarioService = new UsuarioService();

// setando objeto de usuario
$usuarioModel->email = $_POST['email'];
$usuarioModel->senha = md5($_POST['senha']);

// verificando se as credenciais estão corretas
$verificaCredenciais = $usuarioService->verificarCredenciais($usuarioModel);

if(!$verificaCredenciais->code){
    header('Location: /entrar?idMsg=' . $verificaCredenciais->idMsg);
}

// colocando dados na sessao
$_SESSION['id'] = $verificaCredenciais->dados->id;
$_SESSION['nome'] = $verificaCredenciais->dados->nome;
$_SESSION['cpf'] = $verificaCredenciais->dados->cpf;
$_SESSION['dataNascimento'] = $verificaCredenciais->dados->dataNascimento;
$_SESSION['email'] = $verificaCredenciais->dados->email;
$_SESSION['situacao'] = $verificaCredenciais->dados->situacao;
$_SESSION['idPerfil'] = $verificaCredenciais->dados->perfil->id;
$_SESSION['nomePerfil'] = $verificaCredenciais->dados->perfil->perfil;

// verificando qual é o perfil e redirecionando
if($_SESSION['idPerfil'] == 1){
    // admin
    header('Location: /admin');
    exit();
}

// restante dos perfis
header('Location: /');