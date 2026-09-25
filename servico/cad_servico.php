<?php
require_once "../config/conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"] ?? "";
    $tempo = $_POST["tempo"] ?? "";
    $valor = $_POST["valor"] ?? "";
    $descricao = $_POST["descricao"] ?? "";

    $sql = "INSERT INTO servico (nome, tempo, valor, descricao, active, update_at, create_at)
            VALUES ('$nome', '$tempo', '$valor', '$descricao', 1, NOW(), NOW())";

    if ($conexao->query($sql) === TRUE) {
        header("Location: servico.php");
        exit();
    }

    $erro = "Erro ao cadastrar serviço: " . $conexao->error;
}
?>
<!DOCTYPE html>
<html lang="pt-br"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Cadastrar Serviço</title></head>
<body><header class="navbar"><nav><a href="../inicio/index.php">Início</a><a href="../cliente/cliente.php">Clientes</a><a href="../carro/carro.php">Carros</a><a href="../mecanico/mecanico.php">Mecânicos</a><a href="servico.php">Serviços</a><a href="../os/os.php">Ordens de Serviço</a></nav></header>
<h1>Cadastrar Serviço</h1>
<?php if (isset($erro)): ?><p><?= htmlspecialchars($erro) ?></p><?php endif; ?>
<form action="cad_servico.php" method="POST">
<label>Nome:</label><input type="text" name="nome" required><br><br>
<label>Tempo:</label><input type="text" name="tempo" required><br><br>
<label>Valor:</label><input type="number" name="valor" step="0.01" min="0" required><br><br>
<label>Descrição:</label><textarea name="descricao" required></textarea><br><br>
<button type="submit">Cadastrar Serviço</button>
</form></body></html>
