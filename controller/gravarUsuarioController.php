<?php
require_once('../vendor/autoload.php');

use App\Controller\Service\UsuarioService;
use App\Model\UsuarioModel;

// criando objetos
$usuarioModel = new UsuarioModel();
$usuarioService = new UsuarioService();

// setando objeto usuario
$usuarioModel->nome = $_POST['nome'];
$usuarioModel->cpf = $_POST['cpf'];
$usuarioModel->dataNascimento = $_POST['data_nascimento'];
$usuarioModel->email = $_POST['email'];

switch ($_POST['action']) {
    case 'inserir':
        // atribuindo senha
        $usuarioModel->senha = md5($_POST['senha']);

        // inserindo usuario
        $inserirUsuario = $usuarioService->inserir($usuarioModel);

        // verificando se aconteceu algum erro
        if (!$inserirUsuario->code) {
            header('Location: /usuario/cadastrar?idMsg=' . $inserirUsuario->idMsg);
            exit();
        }

        // se foi sucesso
        header('Location: /entrar?idMsg=' . $inserirUsuario->idMsg);
        break;

    case 'atualizar':
        // atribuindo id
        $usuarioModel->id = $_POST['id'];

        // inserindo usuario
        $inserirUsuario = $usuarioService->atualizar($usuarioModel);

        header('Location: /usuario/editar/' . $_POST['id'] . '?idMsg=' . $inserirUsuario->idMsg);
        break;
}
