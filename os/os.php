<?php
require_once "../config/conexao.php";

$sql = "SELECT * FROM vw_ordens_servico ORDER BY data_entrada DESC";
$resultado = $conexao->query($sql);

if (!$resultado) {
    die("Erro na consulta: " . $conexao->error);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordens de Serviço</title>
</head>
<body>
<header class="navbar">
    <nav>
        <a href="../inicio/index.php">Início</a>
        <a href="../cliente/cliente.php">Clientes</a>
        <a href="../carro/carro.php">Carros</a>
        <a href="../mecanico/mecanico.php">Mecânicos</a>
        <a href="../servico/servico.php">Serviços</a>
        <a href="../os/os.php">Ordens de Serviço</a>
    </nav>
</header>

<a href="cad_os.php">Cadastrar OS</a>
<h1>Ordens de Serviço</h1>

<table border="1">
    <tr>
        <th>Nº OS</th>
        <th>Cliente</th>
        <th>Placa</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Data de Entrada</th>
        <th>Status</th>
        <th>Valor</th>
    </tr>

    <?php while ($os = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?= $os["id_os"] ?></td>
            <td><?= htmlspecialchars($os["cliente_nome"]) ?></td>
            <td><?= htmlspecialchars($os["placa"]) ?></td>
            <td><?= htmlspecialchars($os["marca"]) ?></td>
            <td><?= htmlspecialchars($os["modelo"]) ?></td>
            <td><?= $os["data_entrada"] ?></td>
            <td><?= htmlspecialchars($os["status"]) ?></td>
            <td>R$ <?= number_format($os["valor"], 2, ",", ".") ?></td>
        </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
