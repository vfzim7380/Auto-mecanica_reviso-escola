<?php
require_once "../config/conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"] ?? "";
    $email = $_POST["email"] ?? "";
    $cpf = preg_replace("/\D/", "", $_POST["cpf"] ?? "");
    $telefone = preg_replace("/\D/", "", $_POST["telefone"] ?? "");
    $endereco = $_POST["endereco"] ?? "";

    $sql = "INSERT INTO cliente (nome, email, cpf, telefone, endereco, active, update_at, create_at)
            VALUES ('$nome', '$email', '$cpf', '$telefone', '$endereco', 1, NOW(), NOW())";

    if ($conexao->query($sql) === TRUE) {
        header("Location: cliente.php");
        exit();
    }

    $erro = "Erro ao cadastrar cliente: " . $conexao->error;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Cadastrar Cliente</title>    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header class="navbar"><nav>
<a href="../inicio/index.php">Início</a><a href="cliente.php">Clientes</a><a href="../carro/carro.php">Carros</a><a href="../mecanico/mecanico.php">Mecânicos</a><a href="../servico/servico.php">Serviços</a><a href="../os/os.php">Ordens de Serviço</a>
</nav></header>
<h1>Cadastrar Cliente</h1>
<?php if (isset($erro)): ?><p><?= htmlspecialchars($erro) ?></p><?php endif; ?>
<form action="cad_cliente.php" method="POST">
<label>Nome:</label><input type="text" name="nome" required><br><br>
<label>E-mail:</label><input type="email" name="email" required><br><br>
<label>CPF:</label><input type="text" name="cpf" required><br><br>
<label>Telefone:</label><input type="text" name="telefone" required><br><br>
<label>Endereço:</label><input type="text" name="endereco" required><br><br>
<button type="submit">Cadastrar Cliente</button>
</form>
</body></html>
