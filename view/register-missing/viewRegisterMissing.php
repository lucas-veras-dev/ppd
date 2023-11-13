<?php
// iniciando sessão
session_start();

// verificando se existe sessão
if (!isset($_SESSION)) {
    echo "Página não autorizada";
    exit();
}

require_once('../../vendor/autoload.php');

use App\Controller\Service\EstadoService;

// criando objetos
$estadoService = new EstadoService();
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>PPD - Cadastrar Desaparecido</title>
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="">
    <?php require_once(__DIR__ . '/../../view/components/header/headerCss.php') ?>
</head>

<body>
    <?php require_once(__DIR__ . '/../../view/components/header/navbar.php') ?>

    <div class="container mt-5 mb-container">
        <div class="text-center">
            <h2>Cadastrar Desaparecido</h2>
        </div>
        <form class="row g-3 p-5" action="/desaparecido/gravar" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="inserir">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" maxlength="45" required>
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
                <label for="numeroBoletim" class="form-label">Número do Boletim</label>
                <input type="text" class="form-control" id="numeroBoletim" name="numero_boletim" maxlength="45" required>
            </div>
            <div class="col-md-6">
                <label for="estado" class="form-label">Estado</label>
                <select onchange="buscarCidadesPorEstado(this.value)" class="form-select" id="estado" name="id_estado" required>
                    <option selected disabled hidden></option>
                    <?php foreach ($estadoService->listar()->dados as $linhas) : ?>
                        <option value="<?php echo $linhas->id ?>"><?php echo $linhas->nome . ' / ' . $linhas->uf ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="cidade" class="form-label">Cidade</label>
                <select class="form-select" id="cidade" name="id_cidade" required>
                    <option selected disabled>Selecione um estado</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="local_desaparecimento" name="local_desaparecimento" required rows="3"></textarea>
            </div>
            <div class="col-md-6">
                <label for="descricao" class="form-label">Descrição do Local de Desaparecimento</label>
                <textarea class="form-control" id="descricao" name="descricao" maxlength="200" required rows="3"></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Sexo</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sexo" value="M" required>
                    <label class="form-check-label">
                        Masculino
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sexo" value="F" required>
                    <label class="form-check-label">
                        Feminino
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <label for="telefoneContato" class="form-label">Telefone de Contato</label>
                <input type="text" class="form-control" id="telefoneContato" name="telefone_contato" maxlength="45" required>
            </div>
            <div class="col-md-6">
                <label for="emailContato" class="form-label">Email de Contato</label>
                <input type="email" class="form-control" id="emailContato" name="email_contato" maxlength="45" required>
            </div>
            <div class="col-md-12">
                <label for="foto" class="form-label">Foto</label>
                <input class="form-control" type="file" id="foto" name="foto" required>
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