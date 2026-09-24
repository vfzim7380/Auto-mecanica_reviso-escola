<?php 

session_start();

include "../config/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuario WHERE nome = '$nome'";
    $resultado = $conexao->query($sql);

    if ($resultado === false) {
        die("Erro na consulta: " . $conexao->error);
    }

    if ($resultado->num_rows != 0) {

        $row = $resultado->fetch_assoc();

        if (password_verify($senha, $row['senha_hash'])) {

            $conexao->close();

            header("Location: ../inicio/index.php");
            exit();

        } else {
            echo "Senha incorreta.";
        }

    } else {
        echo "Nome ou senha incorretos.";
    }
}
?>