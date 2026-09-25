<?php
require_once "../config/conexao.php";
$id = (int)($_GET["id"] ?? $_POST["id"] ?? 0);
if ($id <= 0) die("Cliente inválido.");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $conexao->real_escape_string($_POST["nome"] ?? "");
    $email = $conexao->real_escape_string($_POST["email"] ?? "");
    $cpf = preg_replace("/\D/", "", $_POST["cpf"] ?? "");
    $telefone = preg_replace("/\D/", "", $_POST["telefone"] ?? "");
    $endereco = $conexao->real_escape_string($_POST["endereco"] ?? "");
    $sql = "UPDATE cliente SET nome='$nome', email='$email', cpf='$cpf', telefone='$telefone', endereco='$endereco', update_at=NOW() WHERE id_cliente=$id";
    if ($conexao->query($sql)) { header("Location: cliente.php"); exit(); }
    $erro = "Erro ao atualizar: ".$conexao->error;
}
$r=$conexao->query("SELECT * FROM cliente WHERE id_cliente=$id AND active=1");
if (!$r || !$r->num_rows) die("Cliente não encontrado.");
$c=$r->fetch_assoc();
?>
<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Editar Cliente</title><link rel="stylesheet" href="../css/style.css"></head><body>
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
<div class="page"><h1>Editar Cliente</h1><?php if(isset($erro)): ?><p><?=htmlspecialchars($erro)?></p><?php endif; ?>
<form method="POST"><input type="hidden" name="id" value="<?= $id ?>">
<label>Nome:</label><input name="nome" value="<?=htmlspecialchars($c["nome"])?>" required><br><br>
<label>E-mail:</label><input type="email" name="email" value="<?=htmlspecialchars($c["email"])?>" required><br><br>
<label>CPF:</label><input name="cpf" value="<?=htmlspecialchars($c["cpf"])?>" required><br><br>
<label>Telefone:</label><input name="telefone" value="<?=htmlspecialchars($c["telefone"])?>" required><br><br>
<label>Endereço:</label><input name="endereco" value="<?=htmlspecialchars($c["endereco"])?>" required><br><br>
<button type="submit">Salvar alterações</button> <a href="cliente.php">Cancelar</a></form></div></body></html>