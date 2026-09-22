<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="cadastro-form">
            <h1>Cadastro de Usuário</h1>
            <form action="cadastro.php" method="post">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" placeholder="Nome">
                <br></br>

                <label for="email">Email:</label>
                <input type="text" name="email" placeholder="Email">
                <br></br>

                <label for="senha">Senha:</label>
                <input type="password" name="senha" placeholder="Senha">
                <br></br>

                <input type="submit" value="Cadastrar">
            </form>
            <a href="../index.php">Voltar para Login</a>
        </div>
    </div>
</body>
</html>

<?php    
    include"../config/conexao.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Hash da senha antes de armazenar no banco de dados
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuario (nome, email, senha_hash, created_at, update_at, active) 
        VALUES ('$nome', '$email', '$senha_hash', NOW(), NOW(), 1)";

        if ($conexao->query($sql) === TRUE) {
            echo "Cadastro realizado com sucesso!";
            // Redirecionar para a página de login após o cadastro
            header("Location: ../index.php", true, 301);
            exit();
        } else {
            echo "Erro ao cadastrar: " . $conexao->error;
        }
    }
?>