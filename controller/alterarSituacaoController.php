<?php
// iniciando sessão
session_start();

require_once('../vendor/autoload.php');

use App\Controller\Service\DesaparecidoService;
use App\Controller\Service\UsuarioService;

// criando objetos
$desaparecidoService = new DesaparecidoService();
$usuarioService = new UsuarioService();

if ($_REQUEST['tipo'] && $_REQUEST['acao']) {
    if ($_REQUEST['tipo'] == 'usuario' && $_REQUEST['acao'] == 'A') {
        $usuarioService->alterarSituacao('A', $_REQUEST['id']);
    } else if ($_REQUEST['tipo'] == 'usuario' && $_REQUEST['acao'] == 'I') {
        $usuarioService->alterarSituacao('I', $_REQUEST['id']);
    } else if ($_REQUEST['tipo'] == 'desaparecido' && $_REQUEST['acao'] == 'A') {
        $desaparecidoService->alterarSituacao('A', $_REQUEST['id']);
    } else if ($_REQUEST['tipo'] == 'desaparecido' && $_REQUEST['acao'] == 'I') {
        $desaparecidoService->alterarSituacao('I', $_REQUEST['id']);
    }
}

if ($_REQUEST['tipo'] == 'usuario') {
    header('Location: /admin?action=listar-usuarios');
    exit();
}

header('Location: /admin?action=listar-desaparecidos');
exit();

