<?php
// iniciando sessão
session_start();

require_once('../vendor/autoload.php');

use App\Model\DesaparecidoModel;
use App\Controller\Service\DesaparecidoService;
use App\Controller\Service\CidadeService;
use App\Controller\Service\UsuarioService;

// criando objetos
$desaparecidoModel = new DesaparecidoModel();
$desaparecidoService = new DesaparecidoService();
$cidadeService = new CidadeService();
$usuarioService = new UsuarioService();

// setando objeto desaparecido
$desaparecidoModel->nome = !empty($_REQUEST['nome']) ? $_REQUEST['nome'] : null;
$desaparecidoModel->sexo = !empty($_REQUEST['sexo']) ? $_REQUEST['sexo'] : null;
$desaparecidoModel->dataNascimento = !empty($_REQUEST['data_nascimento']) ? $_REQUEST['data_nascimento'] : null;
$desaparecidoModel->localDesaparecimento = !empty($_REQUEST['local_desaparecimento']) ? $_REQUEST['local_desaparecimento'] : null;
$desaparecidoModel->descricao = !empty($_REQUEST['descricao']) ? $_REQUEST['descricao'] : null;
$desaparecidoModel->cpf = !empty($_REQUEST['cpf']) ? $_REQUEST['cpf'] : null;
$desaparecidoModel->numeroBoletim = !empty($_REQUEST['numero_boletim']) ? $_REQUEST['numero_boletim'] : null;
$desaparecidoModel->telefoneContato = !empty($_REQUEST['telefone_contato']) ? $_REQUEST['telefone_contato'] : null;
$desaparecidoModel->emailContato = !empty($_REQUEST['email_contato']) ? $_REQUEST['email_contato'] : null;
$desaparecidoModel->cidade = !empty($_REQUEST['id_cidade']) ? $cidadeService->listarPorId($_REQUEST['id_cidade'])->dados : null;


switch ($_REQUEST['action']) {
    case 'inserir':
        // atribuindo anexo
        // tratando anexo e colocando em base64
        foreach ($_FILES as $key => $file) :
            if ($file['size'] != 0) :
                $arquivoTmp = $file['tmp_name'];
                $nomeArquivo = $file['name'];
                $extensao = $file['type'];
                //Imagem decodificada para base64
                $img_b64 = base64_encode(file_get_contents($arquivoTmp));

                // adicionando ao objeto
                $desaparecidoModel->nomeFoto = $nomeArquivo;
                $desaparecidoModel->arquivoFoto = $img_b64;
                $desaparecidoModel->extensaoFoto = $extensao;
            endif;
        endforeach;

        // atribuindo usuario
        $desaparecidoModel->usuario = $usuarioService->listarPorId($_SESSION['id'])->dados;

        // inserindo desaparecido
        $inserirDesaparecido = $desaparecidoService->inserir($desaparecidoModel);

        // verificando se aconteceu algum erro
        if (!$inserirDesaparecido->code) {
            header('Location: /desaparecido/cadastrar?idMsg=' . $inserirDesaparecido->idMsg);
            exit();
        }

        // se foi sucesso
        header('Location: /?idMsg=' . $inserirDesaparecido->idMsg);
        break;

    case 'atualizar':
        // atribuindo id
        $desaparecidoModel->id = $_REQUEST['id'];

        // atualizando desaparecido
        $atualizarDesaparecido = $desaparecidoService->atualizar($desaparecidoModel);

        header('Location: /desaparecido/editar/' . $_REQUEST['id'] . '?idMsg=' . $atualizarDesaparecido->idMsg);
        break;

    case 'deletar':
        // atribuindo id
        $desaparecidoModel->id = $_REQUEST['id'];

        // deletando desaparecido
        $deletarDesaparecido = $desaparecidoService->deletar($desaparecidoModel);

        header('Location: /admin?action=listar-desaparecidos&idMsg=' . $deletarUsuario->idMsg);
        break;
}
