<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>PPD - Entrar</title>
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="">
    <?php require_once(__DIR__ . '/../../view/components/header/headerCss.php') ?>
</head>

<body>
    <?php require_once(__DIR__ . '/../../view/components/header/navbar.php') ?>

    <div class="container mt-5 mb-container">
        <div class="text-center">
            <h2>Entrar</h2>
        </div>
        <form class="p-5" action="/usuario/logar" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Nunca compartilharemos seu e-mail com mais ninguém.</div>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha">
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
    </div>


    <?php require_once(__DIR__ . '/../../view/components/footer/footer.php') ?>

    <?php require_once(__DIR__ . '/../../view/components/footer/footerJs.php') ?>

</body>

</html>