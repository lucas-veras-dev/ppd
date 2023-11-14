<?php

use App\Controller\Service\CidadeService;

require_once('../view/assets/php/functions.php');
require_once('../vendor/autoload.php');

// verificando se a requisição está sendo feita via ajax
if (!isAjax()) {
    echo "Requisição inválida";
}

// criando objetos
$cidadeService = new CidadeService();

if (!empty($_REQUEST['id_estado'])) {

    echo '<option selected disabled hidden></option>';
    
    foreach ($cidadeService->listarPorEstado($_REQUEST['id_estado'])->dados as $linhas) :
        echo '<option value="' . $linhas->id . '">' . $linhas->nome . '</option>';
    endforeach;

    exit();
}

echo '<option selected disabled>Nenhum parâmetro encontrado</option>';
