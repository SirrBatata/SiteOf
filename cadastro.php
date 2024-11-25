<<?php
session_start(); // Iniciar a sessão
include("conexao.php");

$nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';

if (!empty($nome) && !empty($email) && !empty($senha)) {
    // Verificar se o e-mail já está cadastrado
    $checkEmail = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conexao, $checkEmail);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Este e-mail já está cadastrado!');</script>";
        echo "<script>window.location.href = 'cadastro.html';</script>";
    } else {
        // Inserir o novo usuário no banco de dados
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
        if (mysqli_query($conexao, $sql)) {
            $_SESSION['logado'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['recem_cadastrado'] = true;

            // Redirecionar para a página de download
            echo "<script>alert('Cadastro realizado com sucesso!');</script>";
            echo "<script>window.location.href = 'download.html';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar. Tente novamente!');</script>";
            echo "<script>window.location.href = 'cadastro.html';</script>";
        }
    }
} else {
    echo "<script>alert('Preencha todos os campos!');</script>";
    echo "<script>window.location.href = 'cadastro.html';</script>";
}

mysqli_close($conexao);
?>
