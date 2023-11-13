<?php
// iniciando sessão
session_start();
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
            <h2>Cadastrar Usuário</h2>
        </div>
        <form class="row g-3 p-5" action="/usuario/gravar" method="post">
            <input type="hidden" name="action" value="inserir">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" minlength="3" maxlength="45" required>
            </div>
            <div class="col-md-6">
                <label for="cpf" class="form-label">CPF</label>
                <input oninput="permitirApenasNumeros(event)" type="text" class="form-control" id="cpf" name="cpf" minlength="11" maxlength="11" required>
            </div>
            <div class="col-md-6">
                <label for="dataNascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="dataNascimento" name="data_nascimento" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" minlength="3" maxlength="45" required>
            </div>
            <div class="col-md-6">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>

    <?php require_once(__DIR__ . '/../../view/components/footer/footer.php') ?>

    <?php require_once(__DIR__ . '/../../view/components/footer/footerJs.php') ?>

</body>

</html>