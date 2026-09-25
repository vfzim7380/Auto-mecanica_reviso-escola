<?php
require_once "../config/conexao.php";
$resultado = $conexao->query("SELECT * FROM servico WHERE active = 1 ORDER BY nome");
if (!$resultado) die("Erro na consulta: " . $conexao->error);
?>
<!DOCTYPE html>
<html lang="pt-br"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Serviços</title><link rel="stylesheet" href="../css/style.css"></head>
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
<div class="page"><div class="page-header"><h1>Serviços</h1><a class="button" href="cad_servico.php">Cadastrar Serviço</a></div>
<table border="1"><tr><th>ID</th><th>Nome</th><th>Tempo</th><th>Valor</th><th>Descrição</th><th>Ações</th></tr>
<?php while ($s=$resultado->fetch_assoc()): ?><tr>
<td><?= $s["id_servico"] ?></td><td><?= htmlspecialchars($s["nome"]) ?></td><td><?= $s["tempo"] ?> min</td>
<td>R$ <?= number_format($s["valor"],2,",",".") ?></td><td><?= htmlspecialchars($s["descricao"]) ?></td>
<td class="actions"><a href="edicao_servico.php?id=<?= $s["id_servico"] ?>">Editar</a><a href="excluir_servico.php?id=<?= $s["id_servico"] ?>" onclick="return confirm('Deseja excluir este serviço?')">Excluir</a></td>
</tr><?php endwhile; ?></table></div></body></html>