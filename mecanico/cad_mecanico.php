<?php
require_once "../config/conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"] ?? "";
    $cpf = preg_replace("/\D/", "", $_POST["cpf"] ?? "");
    $telefone = preg_replace("/\D/", "", $_POST["telefone"] ?? "");
    $especialidade = $_POST["especialidade"] ?? "";

    $sql = "INSERT INTO mecanico (cpf, nome, especialidade, telefone, active, update_at, create_at)
            VALUES ('$cpf', '$nome', '$especialidade', '$telefone', 1, NOW(), NOW())";

    if ($conexao->query($sql) === TRUE) {
        header("Location: mecanico.php");
        exit();
    }

    $erro = "Erro ao cadastrar mecânico: " . $conexao->error;
}
?>
<!DOCTYPE html>
<html lang="pt-br"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Cadastrar Mecânico</title></head>
<body><header class="navbar"><nav><a href="../inicio/index.php">Início</a><a href="../cliente/cliente.php">Clientes</a><a href="../carro/carro.php">Carros</a><a href="mecanico.php">Mecânicos</a><a href="../servico/servico.php">Serviços</a><a href="../os/os.php">Ordens de Serviço</a></nav></header>
<h1>Cadastrar Mecânico</h1>
<?php if (isset($erro)): ?><p><?= htmlspecialchars($erro) ?></p><?php endif; ?>
<form action="cad_mecanico.php" method="POST">
<label>Nome:</label><input type="text" name="nome" required><br><br>
<label>CPF:</label><input type="text" name="cpf" required><br><br>
<label>Telefone:</label><input type="text" name="telefone" required><br><br>
<label>Especialidade:</label><input type="text" name="especialidade" required><br><br>
<button type="submit">Cadastrar Mecânico</button>
</form></body></html>
