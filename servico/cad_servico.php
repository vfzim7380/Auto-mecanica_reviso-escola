<?php
    include"../config/conexao.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $tempo = $_POST['tempo'];
        $valor = $_POST['valor'];
        $descricao = $_POST['descricao'];

        $sql = "INSERT INTO servico (nome, tempo, valor, descricao, active, update_at, create_at)
        VALUES ('$nome', '$tempo', '$valor', '$descricao', 1, NOW(), NOW())";

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