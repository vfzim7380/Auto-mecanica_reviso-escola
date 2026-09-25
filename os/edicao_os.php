<?php
session_start();
require_once "../config/conexao.php";
$id=(int)($_GET["id"]??$_POST["id"]??0);if($id<=0)die("OS inválida.");
if($_SERVER["REQUEST_METHOD"]==="POST"){
 $status=$conexao->real_escape_string($_POST["status"]??"");$valor=(float)($_POST["valor"]??0);$entrada=$conexao->real_escape_string($_POST["entrada"]??"");
 $agendamento=$conexao->real_escape_string($_POST["agendamento"]??"");$carro=(int)($_POST["carro"]??0);$saida=!empty($_POST["saida"])?"'".$conexao->real_escape_string($_POST["saida"])."'":"NULL";
 $sql="UPDATE os SET status='$status', valor=$valor, data_saida=$saida, data_entrada='$entrada', data_agendamento='$agendamento', carro_id_carro=$carro, update_at=NOW() WHERE id_os=$id";
 if($conexao->query($sql)){header("Location: os.php");exit();}$erro="Erro ao atualizar: ".$conexao->error;
}
$r=$conexao->query("SELECT * FROM os WHERE id_os=$id");if(!$r||!$r->num_rows)die("OS não encontrada.");$o=$r->fetch_assoc();
$carros=$conexao->query("SELECT id_carro,modelo,placa FROM carro WHERE active=1 ORDER BY modelo");
?>
<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Editar OS</title><link rel="stylesheet" href="../css/style.css"></head><body>
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
<div class="page"><h1>Editar Ordem de Serviço #<?=$id?></h1><?php if(isset($erro)): ?><p><?=htmlspecialchars($erro)?></p><?php endif;?>
<form method="POST"><input type="hidden" name="id" value="<?=$id?>">
<label>Status:</label><select name="status" required><?php foreach(["aberta"=>"Aberta","aguardando_aprovacao"=>"Aguardando aprovação","aprovada"=>"Aprovada","em_andamento"=>"Em andamento","aguardando_peca"=>"Aguardando peça","finalizada"=>"Finalizada","entregue"=>"Entregue","cancelada"=>"Cancelada"] as $v=>$label): ?><option value="<?=$v?>" <?=$o["status"]==$v?"selected":""?>><?=$label?></option><?php endforeach;?></select><br><br>
<label>Valor:</label><input type="number" step="0.01" min="0" name="valor" value="<?=$o["valor"]?>" required><br><br>
<label>Data de entrada:</label><input type="date" name="entrada" value="<?=$o["data_entrada"]?>" required><br><br>
<label>Data de saída:</label><input type="date" name="saida" value="<?=$o["data_saida"]?>"><br><br>
<label>Data de agendamento:</label><input type="date" name="agendamento" value="<?=$o["data_agendamento"]?>" required><br><br>
<label>Carro:</label><select name="carro" required><?php while($c=$carros->fetch_assoc()): ?><option value="<?=$c["id_carro"]?>" <?=$c["id_carro"]==$o["carro_id_carro"]?"selected":""?>><?=htmlspecialchars($c["modelo"])?> - <?=htmlspecialchars($c["placa"])?></option><?php endwhile;?></select><br><br>
<button type="submit">Salvar alterações</button> <a href="os.php">Cancelar</a></form></div></body></html>