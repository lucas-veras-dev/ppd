<?php
require_once('../vendor/autoload.php');

use App\Controller\Service\UsuarioService;
use App\Model\UsuarioModel;

// criando objetos
$usuarioModel = new UsuarioModel();
$usuarioService = new UsuarioService();

// setando objeto usuario
$usuarioModel->nome = !empty($_REQUEST['nome']) ? $_REQUEST['nome'] : null;
$usuarioModel->cpf = !empty($_REQUEST['cpf']) ? $_REQUEST['cpf'] : null;
$usuarioModel->dataNascimento = !empty($_REQUEST['data_nascimento']) ? $_REQUEST['data_nascimento'] : null;
$usuarioModel->email = !empty($_REQUEST['email']) ? $_REQUEST['email'] : null;

switch ($_REQUEST['action']) {
    case 'inserir':
        // atribuindo senha
        $usuarioModel->senha = md5($_REQUEST['senha']);

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
        $usuarioModel->id = $_REQUEST['id'];

        // inserindo usuario
        $atualizarUsuario = $usuarioService->atualizar($usuarioModel);

        header('Location: /usuario/editar/' . $_REQUEST['id'] . '?idMsg=' . $atualizarUsuario->idMsg);
        break;

    case 'deletar':
        // atribuindo id
        $usuarioModel->id = $_REQUEST['id'];

        // inserindo usuario
        $deletarUsuario = $usuarioService->deletar($usuarioModel);

        header('Location: /admin?action=listar-usuarios&idMsg=' . $deletarUsuario->idMsg);
        break;
}
