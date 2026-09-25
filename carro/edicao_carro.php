<?php
require_once "../config/conexao.php";
$id=(int)($_GET["id"]??$_POST["id"]??0); if($id<=0) die("Carro inválido.");
if($_SERVER["REQUEST_METHOD"]==="POST"){
 $placa=$conexao->real_escape_string($_POST["placa"]??""); $marca=$conexao->real_escape_string($_POST["marca"]??""); $modelo=$conexao->real_escape_string($_POST["modelo"]??"");
 $ano=(int)($_POST["ano"]??0); $cor=$conexao->real_escape_string($_POST["cor"]??""); $cliente=(int)($_POST["id_cliente"]??0);
 $sql="UPDATE carro SET placa='$placa', marca='$marca', modelo='$modelo', ano=$ano, cor='$cor', id_cliente=$cliente, update_at=NOW() WHERE id_carro=$id";
 if($conexao->query($sql)){header("Location: carro.php");exit();} $erro="Erro ao atualizar: ".$conexao->error;
}
$r=$conexao->query("SELECT * FROM carro WHERE id_carro=$id AND active=1"); if(!$r||!$r->num_rows)die("Carro não encontrado."); $c=$r->fetch_assoc();
$clientes=$conexao->query("SELECT id_cliente,nome FROM cliente WHERE active=1 ORDER BY nome");
?>
<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Editar Carro</title><link rel="stylesheet" href="../css/style.css"></head><body>
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
<div class="page"><h1>Editar Carro</h1><?php if(isset($erro)): ?><p><?=htmlspecialchars($erro)?></p><?php endif; ?>
<form method="POST"><input type="hidden" name="id" value="<?=$id?>">
<label>Cliente:</label><select name="id_cliente" required><?php while($cl=$clientes->fetch_assoc()): ?><option value="<?=$cl["id_cliente"]?>" <?=$cl["id_cliente"]==$c["id_cliente"]?"selected":""?>><?=htmlspecialchars($cl["nome"])?></option><?php endwhile;?></select><br><br>
<label>Placa:</label><input name="placa" value="<?=htmlspecialchars($c["placa"])?>" required><br><br>
<label>Marca:</label><input name="marca" value="<?=htmlspecialchars($c["marca"])?>" required><br><br>
<label>Modelo:</label><input name="modelo" value="<?=htmlspecialchars($c["modelo"])?>" required><br><br>
<label>Ano:</label><input type="number" name="ano" value="<?=$c["ano"]?>" required><br><br>
<label>Cor:</label><input name="cor" value="<?=htmlspecialchars($c["cor"])?>" required><br><br>
<button type="submit">Salvar alterações</button> <a href="carro.php">Cancelar</a></form></div></body></html>