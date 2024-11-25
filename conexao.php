<?php

$servidor="localhost";
$usuario="root";
$senha="123456";
$dbname="cadastro-site";

$conexao=mysqli_connect($servidor, $usuario, $senha, $dbname);

if (!$conexao){
    die("houve um erro: " .mysqli_connect_error());

}
?>