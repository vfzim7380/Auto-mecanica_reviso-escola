<?php 
    require_once"../config/conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
</head>
<body>

    <header class="navbar"> 
        <nav>
            <a href="../inicio/index.php">Inicio</a>
            <a href="../sistema/cadastro.php">Cadastros</a>
            <a href="../os/os.php">Cadastrar OS</a>
        </nav>
    </header>

    <div class="container">
        <div class="cad-folder">
            <h1>Cadastro de Cliente</h1>
            <form action="../cliente/cad_cliente.php" method="post">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" placeholder="Nome">
                <br></br>

                <label for="email">Email:</label>      
                <input type="text" name="email" placeholder="Email">
                <br></br>

                <label for="cpf">CPF:</label>
                <input type="text" name="cpf"  maxlength="14">
                <br></br>

                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" maxlength="9">
                <br></br>

                <label for="endereco">Endereço:</label>
                <input type="text" name="endereco" placeholder="Endereço">
                <br></br>
                
                <input type="submit" value="Cadastrar">
            </form>
        </div>
        <div class="cad-folder">
            <h1>Cadastro carro</h1>
            <form action="../carro/cad_carro.php" method="post">

                <label for="cliente">Cliente:</label>

                <select name="id_cliente" id="cliente">
                    <option value="">Selecione um cliente</option>

                    <?php
                        $sql = "SELECT id_cliente, nome FROM cliente WHERE active = 1";

                        $resultado = $conexao->query($sql);

                        if (!$resultado) {
                            die("Erro na consulta: " . $conexao->error);
                        }
                        while ($cliente = $resultado->fetch_assoc()) {
                    ?>

                        <option value="<?= $cliente['id_cliente'] ?>">
                            <?= $cliente['nome'] ?>
                        </option>
                    <?php
                        }
                    ?>
                </select>
                <br><br>

                <label for="placa">Placa:</label>
                <input type="text" name="placa" id="placa" placeholder="Placa">
                <br><br>

                <label for="marca">Marca:</label>
                <input type="text" name="marca" id="marca" placeholder="Marca">
                <br><br>

                <label for="ano">Ano:</label>
                <input type="number" name="ano" id="ano" min="1800" max="2026" placeholder="1900">
                <br><br>

                <label for="cor">Cor:</label>
                <input type="text" name="cor" id="cor" placeholder="Cor">
                <br><br>

                <input type="submit" value="Cadastrar">
            </form>
        </div>

        <div class="cad-folder">
            <h1>Cadastrar Serviço</h1>
            <form action="../servico/cad_servico.php" method="POST">
                <label for="nome">Nome: </label>
                <input type="text" name="nome" id="nome" placeholder="Serviço">
                <br></br>

                <label for="tempo">Prazo: </label>
                <input type="text" name="tempo" id="tempo" placeholder="Tempo em minutos">
                <br></br>

                <label for="valor">Valor: </label>
                <input type="number" name="valor" id="valor" placeholder="Valor do serviço">
                <br></br>
                
                <label for="descricao">Descrição: </label>
                <input type="text" name="descricao" id="descricao" placeholder="descricao">
                <br></br>

                <input type="submit">
            </form>
        </div>

        <div class="cad-folder">
            <h1>Cadastro mecanico</h1>
            <form action="../mecanico/cad_mecanico.php" method="POST">
                <label for="nome">Nome: </label>
                <input type="text" name="nome" id="nome" placeholder="nome">
                <br></br>

                <label for="cpf">CPF: </label>
                <input type="text" name="cpf" id="cpf" placeholder="000.000.000-00" maxlength="14">
                <br></br>

                <label for="telefone">Telefone: </label>
                <input type="text" name="telefone" id="telefone" placeholder="(00) 00000-0000" maxlength="15">
                <br></br>

                <label for="especialidade">Especialidade: </label>
                <input type="text" name="especialidade" id="especialidade">
                <br></br>

                <input type="submit">
            </form>

        </div>
    </div>
</body>
</html>