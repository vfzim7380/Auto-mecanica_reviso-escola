<?php
require_once "../config/conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_cliente = $_POST["id_cliente"] ?? "";
    $placa = $_POST["placa"] ?? "";
    $marca = $_POST["marca"] ?? "";
    $modelo = $_POST["modelo"] ?? "";
    $ano = $_POST["ano"] ?? "";
    $cor = $_POST["cor"] ?? "";

    $sql = "INSERT INTO carro (placa, marca, modelo, ano, cor, active, id_cliente, update_at, create_at)
            VALUES ('$placa', '$marca', '$modelo', '$ano', '$cor', 1, '$id_cliente', NOW(), NOW())";

    if ($conexao->query($sql) === TRUE) {
        header("Location: carro.php");
        exit();
    }

    $erro = "Erro ao cadastrar carro: " . $conexao->error;
}

$clientes = $conexao->query("SELECT id_cliente, nome FROM cliente WHERE active = 1 ORDER BY nome");
?>
<!DOCTYPE html>
<html lang="pt-br"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Cadastrar Carro</title>    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header class="navbar"><nav><a href="../inicio/index.php">Início</a><a href="../cliente/cliente.php">Clientes</a><a href="carro.php">Carros</a><a href="../mecanico/mecanico.php">Mecânicos</a><a href="../servico/servico.php">Serviços</a><a href="../os/os.php">Ordens de Serviço</a></nav></header>
<h1>Cadastrar Carro</h1>
<?php if (isset($erro)): ?><p><?= htmlspecialchars($erro) ?></p><?php endif; ?>
<form action="cad_carro.php" method="POST">
<label>Cliente:</label><select name="id_cliente" required><option value="">Selecione o cliente</option><?php if ($clientes): while ($cliente=$clientes->fetch_assoc()): ?><option value="<?= $cliente['id_cliente'] ?>"><?= htmlspecialchars($cliente['nome']) ?></option><?php endwhile; endif; ?></select><br><br>
<label>Placa:</label><input type="text" name="placa" required><br><br>
<label>Marca:</label><input type="text" name="marca" required><br><br>
<label>Modelo:</label><input type="text" name="modelo" required><br><br>
<label>Ano:</label><input type="number" name="ano" min="1900" max="2100" required><br><br>
<label>Cor:</label><input type="text" name="cor" required><br><br>
<button type="submit">Cadastrar Carro</button>
</form></body></html>
