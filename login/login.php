<?php 
    include"../config/conexao.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha_hash = '$senha'";
        $result = $conexao->query($sql);

        if ($result->num_rows > 0) {
            // Login bem-sucedido
            echo "Login bem-sucedido!";
            // Redirecionar para a página principal ou painel do usuário
            header("Location: ../sistema/index.php");
            exit();
        } else {
            // Login falhou
            echo "Email ou senha incorretos.";
        }
    }
?>