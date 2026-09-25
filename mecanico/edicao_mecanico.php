<?php
require_once "../config/conexao.php"; $id=(int)($_GET["id"]??$_POST["id"]??0); if($id<=0)die("Mecânico inválido.");
if($_SERVER["REQUEST_METHOD"]==="POST"){
 $nome=$conexao->real_escape_string($_POST["nome"]??"");$cpf=preg_replace("/\D/","",$_POST["cpf"]??"");$telefone=preg_replace("/\D/","",$_POST["telefone"]??"");$esp=$conexao->real_escape_string($_POST["especialidade"]??"");
 if($conexao->query("UPDATE mecanico SET nome='$nome', cpf='$cpf', telefone='$telefone', especialidade='$esp', update_at=NOW() WHERE id_mecanico=$id")){header("Location: mecanico.php");exit();}$erro="Erro ao atualizar: ".$conexao->error;
}
$r=$conexao->query("SELECT * FROM mecanico WHERE id_mecanico=$id AND active=1");if(!$r||!$r->num_rows)die("Mecânico não encontrado.");$m=$r->fetch_assoc();
?>
<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Editar Mecânico</title><link rel="stylesheet" href="../css/style.css"></head><body>
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
<div class="page"><h1>Editar Mecânico</h1><?php if(isset($erro)): ?><p><?=htmlspecialchars($erro)?></p><?php endif;?>
<form method="POST"><input type="hidden" name="id" value="<?=$id?>">
<label>Nome:</label><input name="nome" value="<?=htmlspecialchars($m["nome"])?>" required><br><br>
<label>CPF:</label><input name="cpf" value="<?=htmlspecialchars($m["cpf"])?>" required><br><br>
<label>Telefone:</label><input name="telefone" value="<?=htmlspecialchars($m["telefone"])?>" required><br><br>
<label>Especialidade:</label><input name="especialidade" value="<?=htmlspecialchars($m["especialidade"])?>" required><br><br>
<button type="submit">Salvar alterações</button> <a href="mecanico.php">Cancelar</a></form></div></body></html>