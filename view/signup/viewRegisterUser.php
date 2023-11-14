<?php
// iniciando sessão
session_start();

require_once('../../vendor/autoload.php');

use App\Controller\Service\UsuarioService;

$usuarioService = new UsuarioService;

if (!empty($_SESSION['id']) && !empty($_GET['id'])) {
    $listarUsuario = $usuarioService->listarPorId($_GET['id'])->dados;
}
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>PPD - Cadastrar Usuário</title>
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="">
    <?php require_once(__DIR__ . '/../../view/components/header/headerCss.php') ?>
</head>

<body>
    <?php require_once(__DIR__ . '/../../view/components/header/navbar.php') ?>

    <div class="container mt-5 mb-container">
        <div class="text-center">
            <h2><?php echo !empty($_SESSION['id']) && !empty($_GET['id']) ? 'Editar Usuário' : 'Cadastrar Usuário' ?></h2>
        </div>
        <form class="row g-3 p-5" action="/usuario/gravar" method="post">
            <input type="hidden" name="action" value="<?php echo !empty($_SESSION['id']) && !empty($_GET['id']) ? 'atualizar' : 'inserir' ?>">
            <input type="hidden" name="id" value="<?php echo !empty($_SESSION['id']) && !empty($_GET['id']) ? $_GET['id'] : null ?>">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo !empty($listarUsuario->nome) ? $listarUsuario->nome : null ?>" minlength="3" maxlength="45" required>
            </div>
            <div class="col-md-6">
                <label for="cpf" class="form-label">CPF</label>
                <input oninput="permitirApenasNumeros(event)" type="text" class="form-control" id="cpf" name="cpf" value="<?php echo !empty($listarUsuario->cpf) ? $listarUsuario->cpf : null ?>" minlength="11" maxlength="11" required>
            </div>
            <div class="col-md-6">
                <label for="dataNascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="dataNascimento" name="data_nascimento" value="<?php echo !empty($listarUsuario->dataNascimento) ? $listarUsuario->dataNascimento : null ?>" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo !empty($listarUsuario->email) ? $listarUsuario->email : null ?>" minlength="3" maxlength="45" required>
            </div>
            <?php if (empty($_SESSION['id']) && empty($_GET['id'])) : ?>
                <div class="col-md-6">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
            <?php endif; ?>
            <div class="col-12">
                <button type="submit" class="btn btn-primary"><?php echo !empty($_SESSION['id']) && !empty($_GET['id']) ? 'Editar' : 'Cadastrar' ?></button>
            </div>
        </form>
    </div>

    <?php require_once(__DIR__ . '/../../view/components/footer/footer.php') ?>

    <?php require_once(__DIR__ . '/../../view/components/footer/footerJs.php') ?>

</body>

</html>