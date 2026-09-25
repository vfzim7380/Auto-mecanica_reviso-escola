<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Car</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="login-form">
            <h1>Bem-vindo ao Auto mecanica</h1>
            <form action="login/login.php" method="post">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" placeholder="Nome">
                <br></br>

                <label for="senha">Senha:</label>
                <input type="password" name="senha" placeholder="Senha">
                <br></br>

                <input type="submit" value="Entrar">
            </form>
            <a href="cadastro/cadastro.php">Cadastrar-se</a>
        </div>
    </div>
</body>
</html>