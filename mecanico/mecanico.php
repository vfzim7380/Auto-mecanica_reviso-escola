<?php
require_once "../config/conexao.php";
$resultado = $conexao->query("SELECT * FROM mecanico WHERE active = 1 ORDER BY nome");
if (!$resultado) die("Erro na consulta: " . $conexao->error);
?>
<!DOCTYPE html>
<html lang="pt-br"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Mecânicos</title>    <link rel="stylesheet" href="../css/style.css">
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
<a href="cad_mecanico.php">Cadastrar Mecânico</a>
<h1>Mecânicos</h1>
<table border="1"><tr><th>ID</th><th>Nome</th><th>CPF</th><th>Especialidade</th><th>Telefone</th></tr>
<?php while ($m=$resultado->fetch_assoc()): ?><tr>
<td><?= $m["id_mecanico"] ?></td><td><?= htmlspecialchars($m["nome"]) ?></td><td><?= htmlspecialchars($m["cpf"]) ?></td>
<td><?= htmlspecialchars($m["especialidade"]) ?></td><td><?= htmlspecialchars($m["telefone"]) ?></td>
</tr><?php endwhile; ?></table>
</body></html>
