<?php
require_once "../config/conexao.php";
$resultado = $conexao->query("SELECT * FROM cliente WHERE active = 1 ORDER BY nome");
if (!$resultado) die("Erro na consulta: " . $conexao->error);
?>
<!DOCTYPE html>
<html lang="pt-br"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Clientes</title>    <link rel="stylesheet" href="../css/style.css">
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
<a href="cad_cliente.php">Cadastrar Cliente</a>
<h1>Clientes</h1>
<table border="1"><tr><th>ID</th><th>Nome</th><th>Email</th><th>CPF</th><th>Telefone</th><th>Endereço</th></tr>
<?php while ($cliente=$resultado->fetch_assoc()): ?><tr>
<td><?= $cliente["id_cliente"] ?></td><td><?= htmlspecialchars($cliente["nome"]) ?></td><td><?= htmlspecialchars($cliente["email"]) ?></td>
<td><?= htmlspecialchars($cliente["cpf"]) ?></td><td><?= htmlspecialchars($cliente["telefone"]) ?></td><td><?= htmlspecialchars($cliente["endereco"]) ?></td>
</tr><?php endwhile; ?></table>
</body></html>
