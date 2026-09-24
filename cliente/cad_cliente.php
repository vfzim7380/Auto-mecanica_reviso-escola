<?php
    include"../config/conexao.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $endereco = $_POST['endereco'];

        $sql = "INSERT INTO servico (nome, email, cpf, telefone, endereco, active, update_at, create_at)
        VALUES ('$nome', '$email', '$cpf', '$telefone', '$endereco',1, NOW(), NOW())";

        if($conexao->query($sql) === TRUE){
            echo "Cadastro realizado com sucesso!";
            // Redirecionar para a página de login após o cadastro
            header("Location: ../sistema/index.php", true, 301);
            exit();
        } else {
            echo "Erro ao cadastrar: " . $conexao->error;
        }
    }

?>