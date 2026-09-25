<?php
session_start();
require_once "../config/conexao.php";

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $status = $_POST["status"] ?? "";
    $valor = $_POST["valor"] ?? 0;
    $entrada = $_POST["entrada"] ?? "";
    $saida = !empty($_POST["saida"]) ? $_POST["saida"] : null;
    $agendamento = $_POST["agendamento"] ?? "";
    $carro = $_POST["carro"] ?? "";
    $id_usuario = $_SESSION["id_usuario"];

    if ($saida === null) {
        $saida_sql = "NULL";
    } else {
        $saida_sql = "'$saida'";
    }

    $sql = "INSERT INTO os
        (status, valor, data_saida, data_entrada, data_agendamento, carro_id_carro, id_usuario, create_at, update_at)
        VALUES
        ('$status', '$valor', $saida_sql, '$entrada', '$agendamento', '$carro', '$id_usuario', NOW(), NOW())";

    if ($conexao->query($sql) === TRUE) {
        header("Location: os.php");
        exit();
    } else {
        $erro = "Erro ao cadastrar: " . $conexao->error;
    }
}

$carros = $conexao->query("SELECT id_carro, modelo, placa FROM carro WHERE active = 1 ORDER BY modelo");
if (!$carros) {
    die("Erro na consulta dos carros: " . $conexao->error);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar OS</title>
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

<div class="container">
    <div class="cad-folder">
        <h1>Cadastrar OS</h1>

        <?php if (isset($erro)): ?>
            <p><?= htmlspecialchars($erro) ?></p>
        <?php endif; ?>

        <form action="cad_os.php" method="POST">
            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="aberta">Aberta</option>
                <option value="aguardando_aprovacao">Aguardando aprovação</option>
                <option value="aprovada">Aprovada</option>
                <option value="em_andamento">Em andamento</option>
                <option value="aguardando_peca">Aguardando peça</option>
                <option value="finalizada">Finalizada</option>
                <option value="entregue">Entregue</option>
                <option value="cancelada">Cancelada</option>
            </select>
            <br><br>

            <label for="valor">Valor:</label>
            <input type="number" name="valor" id="valor" step="0.01" min="0" required>
            <br><br>

            <label for="entrada">Data de entrada:</label>
            <input type="date" name="entrada" id="entrada" required>
            <br><br>

            <label for="saida">Data de saída:</label>
            <input type="date" name="saida" id="saida">
            <br><br>

            <label for="agendamento">Data de agendamento:</label>
            <input type="date" name="agendamento" id="agendamento" required>
            <br><br>

            <label for="carro">Selecione o carro:</label>
            <select name="carro" id="carro" required>
                <option value="">Selecione um carro</option>
                <?php while ($carro = $carros->fetch_assoc()): ?>
                    <option value="<?= $carro["id_carro"] ?>">
                        <?= htmlspecialchars($carro["modelo"]) ?> - <?= htmlspecialchars($carro["placa"]) ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <br><br>

            <input type="submit" value="Cadastrar OS">
        </form>
    </div>
</div>
</body>
</html>
