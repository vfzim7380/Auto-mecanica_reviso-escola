<?php
session_start();
require_once "../config/conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"] ?? "";
    $senha = $_POST["senha"] ?? "";

    $sql = "SELECT * FROM usuario WHERE nome = '$nome' AND active = 1";
    $resultado = $conexao->query($sql);

    if (!$resultado) {
        die("Erro na consulta: " . $conexao->error);
    }

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();

        if (password_verify($senha, $row["senha_hash"])) {
            $_SESSION["id_usuario"] = $row["id_usuario"];
            $_SESSION["nome_usuario"] = $row["nome"];
            header("Location: ../inicio/index.php");
            exit();
        }

        echo "Senha incorreta.";
    } else {
        echo "Nome ou senha incorretos.";
    }
}
?>
