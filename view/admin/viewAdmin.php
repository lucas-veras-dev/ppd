<?php
// iniciando sessão
session_start();

use App\Controller\Service\UsuarioService;
use App\Controller\Service\DesaparecidoService;

require_once('../../vendor/autoload.php');

// criando objetos
$usuarioService = new UsuarioService();
$desaparecidoService = new DesaparecidoService();

// verificando se existe sessão
if (!isset($_SESSION) || $_SESSION['idPerfil'] != 1) {
    echo "Página não autorizada";
    exit();
}

if ($_GET['action'] == 'listar-usuarios') {
    $dadosUsuarios = $usuarioService->listar()->dados;
} else if ($_GET['action'] == 'listar-desaparecidos') {
    $dadosDesaparecidos = $desaparecidoService->listar()->dados;
}

?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>PPD - Admin</title>
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="">
    <?php require_once(__DIR__ . '/../../view/components/header/headerCss.php') ?>
</head>

<body>
    <?php require_once(__DIR__ . '/../../view/components/header/navbar.php') ?>

    <div class="container mt-5 mb-container">
        <div class="text-center">
            <h2>Administração</h2>
        </div>
        <ul class="nav nav-pills mb-5">
            <li class="nav-item">
                <a class="nav-link <?php echo $_GET['action'] == 'listar-usuarios' ? 'active' : null ?>" aria-current="page" href="/admin?action=listar-usuarios">Usuários</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $_GET['action'] == 'listar-desaparecidos' ? 'active' : null ?>" href="/admin?action=listar-desaparecidos">Desaparecidos</a>
            </li>
        </ul>
        <?php if (!empty($dadosUsuarios)) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Data de Nascimento</th>
                        <th scope="col">Email</th>
                        <th scope="col">Situacao</th>
                        <th scope="col">Perfil</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dadosUsuarios as $linhas) : ?>
                        <tr>
                            <td><?php echo $linhas->nome ?></td>
                            <td><?php echo $linhas->cpf ?></td>
                            <td><?php echo $linhas->dataNascimento ?></td>
                            <td><?php echo $linhas->email ?></td>
                            <td><?php echo $linhas->situacao ?></td>
                            <td><?php echo $linhas->perfil->perfil ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <?php if ($linhas->situacao != 'A') : ?>
                                        <a href="/controller/alterarSituacaoController.php?id=<?php echo $linhas->id ?>&tipo=usuario&acao=A" class="btn btn-outline-success"><i class="fa-solid fa-toggle-on"></i> Ativar</a>
                                    <?php else : ?>
                                        <a href="/controller/alterarSituacaoController.php?id=<?php echo $linhas->id ?>&tipo=usuario&acao=I" class="btn btn-outline-secondary"><i class="fa-solid fa-toggle-off"></i> Desativar</a>
                                    <?php endif; ?>
                                    <a href="/usuario/editar/<?php echo $linhas->id ?>" class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                    <a href="/usuario/gravar?action=deletar&id=<?php echo $linhas->id ?>" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i> Excluir</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <?php if (!empty($dadosDesaparecidos)) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Cidade</th>
                        <th scope="col">Situação</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dadosDesaparecidos as $linhas) : ?>
                        <tr>
                            <td><?php echo $linhas->nome ?></td>
                            <td><?php echo $linhas->cpf ?></td>
                            <td><?php echo $linhas->cidade->nome ?></td>
                            <td><?php echo $linhas->situacao ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <?php if ($linhas->situacao != 'A') : ?>
                                        <a href="/controller/alterarSituacaoController.php?id=<?php echo $linhas->id ?>&tipo=desaparecido&acao=A" class="btn btn-outline-success"><i class="fa-solid fa-toggle-on"></i> Ativar</a>
                                    <?php else : ?>
                                        <a href="/controller/alterarSituacaoController.php?id=<?php echo $linhas->id ?>&tipo=desaparecido&acao=I" class="btn btn-outline-secondary"><i class="fa-solid fa-toggle-off"></i> Desativar</a>
                                    <?php endif; ?>
                                    <a href="/desaparecido/editar?id=<?php echo $linhas->id ?>" class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                    <a href="/desaparecido/excluir?id=<?php echo $linhas->id ?>" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i> Excluir</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <?php require_once(__DIR__ . '/../../view/components/footer/footerJs.php') ?>

</body>

</html>