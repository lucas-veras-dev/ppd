<?php
// iniciando sessão
session_start();

require_once('vendor/autoload.php');

use App\Controller\Service\DesaparecidoService;

$desaparecidoService = new DesaparecidoService;

// listar desaparecidos
$listarDesaparecido = $desaparecidoService->listar();

?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>PPD</title>
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="">
    <?php require_once(__DIR__ . '/view/components/header/headerCss.php') ?>
</head>

<body>
    <?php require_once(__DIR__ . '/view/components/header/navbar.php') ?>
    
    <div class="bg-dark bg-gradient text-light p-3 text-uppercase d-flex flex-column justify-content-center align-items-center">
        <img id="homeImg" src="view/assets/images/logo.png">
        O uso da tecnologia na busca por pessoas desaparecidas
    </div>
    <div class="container text-center mt-5">
        <div class="row p-3">
            <div class="col">
                <form class="row g-3 justify-content-center p-3">
                    <div class="col-6">
                        <label class="visually-hidden"></label>
                        <input type="text" class="form-control" id="nomeDesaparecido" placeholder="Pesquisar desaparecido pelo nome">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success mb-3"><i class="fa-solid fa-magnifying-glass"></i>
                            Pesquisar
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row p-3">
            <div class="col-12">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php if ($listarDesaparecido->code) : ?>
                        <?php foreach ($listarDesaparecido->dados as $linhas) : ?>
                            <div class="col">
                                <div class="card h-100">
                                    <img src="../../assets/images/pessoas/download.jpeg" class="card-img-top card-img-desaparecidos" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $linhas->nome ?></h5>
                                        <p class="card-text fw-bold">Local de desaparecimento:</p>
                                        <p><?php echo $linhas->localDesaparecimento ?></p>

                                        <p class="card-text fw-bold">Descricao:</p>
                                        <p><?php echo $linhas->descricao ?></p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-body-secondary"><i class="fa-solid fa-location-dot"></i> <?php echo $linhas->cidade->nome . ' - ' . $linhas->cidade->estado->uf ?></small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="alert alert-warning w-100" role="alert">
                            Nenhum desaparecido encontrado.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php require_once(__DIR__ . '/view/components/footer/footer.php') ?>

    <?php require_once(__DIR__ . '/view/components/footer/footerJs.php') ?>

</body>

</html>