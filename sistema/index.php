<?php 
    include"../"
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
</head>
<body>
    <div class="container">
        <div class="cad-folder">
            <h1>Cadastro de Cliente</h1>
            <form action="../cad_cliente/cad_cliente.php" method="post">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" placeholder="Nome">
                <br></br>

                <label for="email">Email:</label>      
                <input type="text" name="email" placeholder="Email">
                <br></br>

                <label for="cpf">CPF:</label>
                <input type="text" name="cpf"  maxlength="9">
                <br></br>

                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" maxlength="11">
                <br></br>

                <label for="endereco">Endereço:</label>
                <input type="text" name="endereco" placeholder="Endereço">
                <br></br>
                
                <input type="submit" value="Cadastrar">
            </form>
        </div>
        <div class="cad-folder">
            <h1>Cadastro carro</h1>
            <form action="../cad_carro/cad_carro.php">
                <select name="id_cliente" id="cliente">
                    <option value="">Selecione um cliente</option>
                    <?php 
                        $sql = "SELECT id_cliente, nome, cpf FROM clinte WHERE action = 1";
                        $resultado = $conexao -> query($sql);

                        while ($cliente = $resultado -> fetch_assoc()){
                            ?>
                            <option value="<?=  $cliente['id_cliente'] ?>">
                                <?= $cliente['nome'] ?>
                            </option>
                        <?php
                        }
                    ?>
                </select>
                <br></br>

                <label for="placa">Placa:</label>
                <input type="text" name="placa" placeholder="Placa">
                <br></br>

                <label for="marca">Marca:</label>
                <input type="text" name="marca" placeholder="Marca">
                <br></br>

                <label for="ano">Ano:</label>
                <input type="number" name="ano" min="1800" max="2026">
                <br></br>

                <label for="cor">Cor:</label>
                <input type="text" name="cor" placeholder="Cor">
                <br></br>
                
                <input type="submit" value="Cadastrar">
            </form>
        </div>
    </div>
</body>
</html>