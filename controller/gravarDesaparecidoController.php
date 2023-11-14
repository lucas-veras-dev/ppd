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

// setando objeto desaparecido
$desaparecidoModel->nome = $_POST['nome'];
$desaparecidoModel->sexo = $_POST['sexo'];
$desaparecidoModel->dataNascimento = $_POST['data_nascimento'];
$desaparecidoModel->localDesaparecimento = $_POST['local_desaparecimento'];
$desaparecidoModel->descricao = $_POST['descricao'];
$desaparecidoModel->cpf = $_POST['cpf'];
$desaparecidoModel->numeroBoletim = $_POST['numero_boletim'];
$desaparecidoModel->telefoneContato = $_POST['telefone_contato'];
$desaparecidoModel->emailContato = $_POST['email_contato'];
$desaparecidoModel->cidade = $cidadeService->listarPorId($_POST['id_cidade'])->dados;
$desaparecidoModel->usuario = $usuarioService->listarPorId($_SESSION['id'])->dados;

switch ($_POST['action']) {
    case 'inserir':
        // inserindo usuario
        $inserirDesaparecido = $desaparecidoService->inserir($desaparecidoModel);

        // verificando se aconteceu algum erro
        if (!$inserirDesaparecido->code) {
            header('Location: /desaparecido/cadastrar?idMsg=' . $inserirDesaparecido->idMsg);
            exit();
        }

        // se foi sucesso
        header('Location: /?idMsg=' . $inserirDesaparecido->idMsg);
        break;
}
