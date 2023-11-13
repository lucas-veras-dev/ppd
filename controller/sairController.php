<?php 
// iniciando sessao
session_start();

// destruindo a sessao
session_destroy();

header('Location: /');