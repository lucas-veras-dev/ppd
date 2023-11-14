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
use App\Controller\Service\DesaparecidoService;
use App\Controller\Service\CidadeService;

// criando objetos
$estadoService = new EstadoService;
$desaparecidoService = new DesaparecidoService;
$cidadeService = new CidadeService;

if (!empty($_SESSION['id']) && !empty($_GET['id'])) {
    $listarDesaparecido = $desaparecidoService->listarPorId($_GET['id'])->dados;

    $listarCidades = null;
    if (!empty($listarDesaparecido->cidade->id)) {
        $listarCidades = $cidadeService->listarPorEstado($listarDesaparecido->cidade->estado->id)->dados;
    }
}
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
            <h2><?php echo !empty($_SESSION['id']) && !empty($_GET['id']) ? 'Editar Desaparecido' : 'Cadastrar Desaparecido' ?></h2>
        </div>
        <form class="row g-3 p-5" action="/desaparecido/gravar" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="<?php echo !empty($_SESSION['id']) && !empty($_GET['id']) ? 'atualizar' : 'inserir' ?>">
            <input type="hidden" name="id" value="<?php echo !empty($_SESSION['id']) && !empty($_GET['id']) ? $_GET['id'] : null ?>">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo !empty($listarDesaparecido->nome) ? $listarDesaparecido->nome : null ?>" maxlength="45" required>
            </div>
            <div class="col-md-6">
                <label for="cpf" class="form-label">CPF</label>
                <input oninput="permitirApenasNumeros(event)" type="text" class="form-control cpf" id="cpf" name="cpf" value="<?php echo !empty($listarDesaparecido->cpf) ? $listarDesaparecido->cpf : null ?>" minlength="11" maxlength="11" required>
            </div>
            <div class="col-md-6">
                <label for="dataNascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="dataNascimento" name="data_nascimento" value="<?php echo !empty($listarDesaparecido->dataNascimento) ? $listarDesaparecido->dataNascimento : null ?>" required>
            </div>
            <div class="col-md-6">
                <label for="numeroBoletim" class="form-label">Número do Boletim</label>
                <input type="text" class="form-control" id="numeroBoletim" name="numero_boletim" value="<?php echo !empty($listarDesaparecido->numeroBoletim) ? $listarDesaparecido->numeroBoletim : null ?>" maxlength="45" required>
            </div>
            <div class="col-md-6">
                <label for="estado" class="form-label">Estado</label>
                <select onchange="buscarCidadesPorEstado(this.value)" class="form-select" id="estado" name="id_estado" required>
                    <option selected disabled hidden></option>
                    <?php foreach ($estadoService->listar()->dados as $linhas) : ?>
                        <?php $selecionar = $linhas->id == $listarDesaparecido->cidade->estado->id ? 'selected' : null ?>
                        <option <?php echo $selecionar ?> value="<?php echo $linhas->id ?>"><?php echo $linhas->nome . ' / ' . $linhas->uf ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="cidade" class="form-label">Cidade</label>
                <select class="form-select" id="cidade" name="id_cidade" required>
                    <?php if (!empty($listarCidades)) : ?>
                        <option selected disabled hidden></option>
                        <?php foreach ($listarCidades as $linhas) : ?>
                            <?php $selecionar = $linhas->id == $listarDesaparecido->cidade->id ? 'selected' : null ?>
                            <option <?php echo $selecionar ?> value="<?php echo $linhas->id ?>"><?php echo $linhas->nome ?></option>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <option selected disabled>Selecione um estado</option>
                    <?php endif; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" required rows="3"><?php echo !empty($listarDesaparecido->descricao) ? $listarDesaparecido->descricao : null ?></textarea>
            </div>
            <div class="col-md-6">
                <label for="descricao" class="form-label">Descrição do Local de Desaparecimento</label>
                <textarea class="form-control" id="local_desaparecimento" name="local_desaparecimento" maxlength="200" required rows="3"><?php echo !empty($listarDesaparecido->localDesaparecimento) ? $listarDesaparecido->localDesaparecimento : null ?></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Sexo</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sexo" value="M" <?php echo !empty($listarDesaparecido->sexo) && $listarDesaparecido->sexo == 'M' ? 'checked' : null ?> required>
                    <label class="form-check-label">
                        Masculino
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sexo" value="F" <?php echo !empty($listarDesaparecido->sexo) && $listarDesaparecido->sexo == 'F' ? 'checked' : null ?> required>
                    <label class="form-check-label">
                        Feminino
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <label for="telefoneContato" class="form-label">Telefone de Contato</label>
                <input type="text" class="form-control telefone" id="telefoneContato" name="telefone_contato" value="<?php echo !empty($listarDesaparecido->telefoneContato) ? $listarDesaparecido->telefoneContato : null ?>" maxlength="45" required>
            </div>
            <div class="col-md-6">
                <label for="emailContato" class="form-label">Email de Contato</label>
                <input type="email" class="form-control" id="emailContato" name="email_contato" value="<?php echo !empty($listarDesaparecido->emailContato) ? $listarDesaparecido->emailContato : null ?>" maxlength="45" required>
            </div>
            <?php if (empty($_GET['id'])) : ?>
                <div class="col-md-12">
                    <label for="foto" class="form-label">Foto</label>
                    <input class="form-control" type="file" id="foto" name="foto" required>
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