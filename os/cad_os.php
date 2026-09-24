<?php 
    require_once"../config/conexao.php"
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
            <a href="index.php">Inicio</a>
            <a href="../os/cad_os.php">Cadastrar OS</a>
        </nav>
    </header>
    <div class="container">
        <div class="cad-folder">
            <h1>Cadastrar OS</h1>
            <form action="cad_os.php">
                <label for="status">Status: </label>
                <select name="status" id="status">
                    <option value="aberta">Aberta</option>
                    <option value="aguardando_aprovacao">Aguardando aprovação</option>
                    <option value="aprovada">Aprovada</option>
                    <option value="em_andamento">Em andamento</option>
                    <option value="aguardando_peca">Aguardando peça</option>
                    <option value="finalizada">Finalizada</option>
                    <option value="entregue">Entregue</option>
                    <option value="cancelada">Cancelada</option>
                </select>
                <br></br>

                <label for="valor">Valor: </label>
                <input type="number" name="valor" id="valor">
                <br></br>

                <label for="entrada">Entrada: </label>
                <input type="date" name="entrada" id="entrada">
                <br></br>

                <label for="saida">Data Saida: </label>
                <input type="date" name="saida" id="saida">
                <br></br>

                <label for="agendamento">Data agendamento:</label>
                <input type="date" name="agendamento" id="agendamento">
                <br></br>

                <label for="carro">Selecione o carro:</label>
                <select name="carro" id="carro">
                    <option value="">Selecione um carro</option>

                    <?php
                        $sql = "SELECT id_carro, modelo, placa FROM carro WHERE active = 1";

                        $resultado = $conexao->query($sql);

                        if (!$resultado) {
                            die("Erro na consulta: " . $conexao->error);
                        }
                        while ($carro = $resultado->fetch_assoc()) {
                    ?>

                        <option value="<?= $carro['id_carro'] ?>">
                            <?= $carro['modelo']?> - <?= $carro['placa']?>
                        </option>
                    <?php
                        }
                    ?>
                </select>
                <br></br>

                <input type="submit">
            </form>
        </div>
    </div>
</body>
</html>