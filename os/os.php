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
    <title>Ordens de Serviço</title>
</head>
<body>
    <header class="navbar"> 
        <nav>
            <a href="../inicio/index.php">Inicio</a>
            <a href="../sistema/cadastro.php">Cadastros</a>
            <a href="../os/os.php">Cadastrar OS</a>
        </nav>
    </header>
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
        </tr>

        <?php while ($os = $resultado->fetch_assoc()) { ?>

            <tr>
                <td><?= $os['id_os'] ?></td>
                <td><?= $os['cliente_nome'] ?></td>
                <td><?= $os['placa'] ?></td>
                <td><?= $os['marca'] ?></td>
                <td><?= $os['modelo'] ?></td>
                <td><?= $os['data_entrada'] ?></td>
                <td><?= $os['status'] ?></td>
            </tr>

        <?php } ?>

    </table>

</body>
</html>