<?php
    include"../config/conexao.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_cliente = $_POST['id_cliente'];
        $nome = $_POST['nome'];
        $placa = $_POST['placa'];
        $marca = $_POST['marca'];
        $ano = $_POST['ano'];
        $cor = $_POST['cor'];

        $sql = "INSERT INTO servico (id_cliente, nome, placa, marca, ano, cor, active, update_at, create_at)
        VALUES ('$id_cliente', '$nome', '$placa', '$marca', '$ano', '$cor', 1, NOW(), NOW())";

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