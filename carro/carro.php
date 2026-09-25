<?php
require_once "../config/conexao.php";
$sql = "SELECT carro.*, cliente.nome AS cliente_nome FROM carro INNER JOIN cliente ON cliente.id_cliente = carro.id_cliente WHERE carro.active = 1 ORDER BY carro.modelo";
$resultado = $conexao->query($sql);
if (!$resultado) die("Erro na consulta: " . $conexao->error);
?>
<!DOCTYPE html>
<html lang="pt-br"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Carros</title>    <link rel="stylesheet" href="../css/style.css">
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
<a href="cad_carro.php">Cadastrar Carro</a>
<h1>Carros</h1>
<table border="1"><tr><th>ID</th><th>Placa</th><th>Marca</th><th>Modelo</th><th>Ano</th><th>Cor</th><th>Cliente</th></tr>
<?php while ($carro=$resultado->fetch_assoc()): ?><tr>
<td><?= $carro["id_carro"] ?></td><td><?= htmlspecialchars($carro["placa"]) ?></td><td><?= htmlspecialchars($carro["marca"]) ?></td>
<td><?= htmlspecialchars($carro["modelo"]) ?></td><td><?= $carro["ano"] ?></td><td><?= htmlspecialchars($carro["cor"]) ?></td><td><?= htmlspecialchars($carro["cliente_nome"]) ?></td>
</tr><?php endwhile; ?></table>
</body></html>
