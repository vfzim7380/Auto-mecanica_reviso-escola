<?php
require_once "../config/conexao.php"; $id=(int)($_GET["id"]??$_POST["id"]??0);if($id<=0)die("Serviço inválido.");
if($_SERVER["REQUEST_METHOD"]==="POST"){
 $nome=$conexao->real_escape_string($_POST["nome"]??"");$tempo=(int)($_POST["tempo"]??0);$valor=(float)($_POST["valor"]??0);$desc=$conexao->real_escape_string($_POST["descricao"]??"");
 if($conexao->query("UPDATE servico SET nome='$nome', tempo=$tempo, valor=$valor, descricao='$desc', update_at=NOW() WHERE id_servico=$id")){header("Location: servico.php");exit();}$erro="Erro ao atualizar: ".$conexao->error;
}
$r=$conexao->query("SELECT * FROM servico WHERE id_servico=$id AND active=1");if(!$r||!$r->num_rows)die("Serviço não encontrado.");$s=$r->fetch_assoc();
?>
<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Editar Serviço</title><link rel="stylesheet" href="../css/style.css"></head><body>
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
<div class="page"><h1>Editar Serviço</h1><?php if(isset($erro)): ?><p><?=htmlspecialchars($erro)?></p><?php endif;?>
<form method="POST"><input type="hidden" name="id" value="<?=$id?>">
<label>Nome:</label><input name="nome" value="<?=htmlspecialchars($s["nome"])?>" required><br><br>
<label>Tempo (minutos):</label><input type="number" name="tempo" value="<?=$s["tempo"]?>" required><br><br>
<label>Valor:</label><input type="number" step="0.01" name="valor" value="<?=$s["valor"]?>" required><br><br>
<label>Descrição:</label><textarea name="descricao" required><?=htmlspecialchars($s["descricao"])?></textarea><br><br>
<button type="submit">Salvar alterações</button> <a href="servico.php">Cancelar</a></form></div></body></html>