<?php

include("conexao.php");


$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';

if (!empty($email) && !empty($senha)) {

    // Preparar consulta segura
    $stmt = $conexao->prepare("SELECT senha FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Obter o hash da senha no banco
        $stmt->bind_result($senha_hash);
        $stmt->fetch();

        if (password_verify($senha, $senha_hash)) {
            session_start();
            $_SESSION['usuario_id'] = $email; // Pode usar ID do usuário em vez do email
            echo "<script>alert('Login realizado com sucesso!'); window.location.href = 'index.html';</script>";
        } else {
            echo "<script>alert('Email ou senha inválidos!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Email ou senha inválidos!'); window.history.back();</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Preencha todos os campos!'); window.history.back();</script>";
}

$conexao->close();
?>