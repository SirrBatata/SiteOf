<?php
session_start();


$response = [
    'status' => isset($_SESSION['logado']) && $_SESSION['logado'] === true ? 'logado' : 'deslogado',
    'recem_cadastrado' => isset($_SESSION['recem_cadastrado']) && $_SESSION['recem_cadastrado'] === true
];

if (isset($_SESSION['recem_cadastrado'])) {
    unset($_SESSION['recem_cadastrado']);
}

echo json_encode($response);
?>
