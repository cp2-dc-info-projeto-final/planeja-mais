<?php
if (isset($_POST['submit'])) {
    include_once("conexao.php");

    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telefone = mysqli_real_escape_string($conn, $_POST['telefone']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);
    $senha_cripto = md5($senha);

    // Verificar se o email já está cadastrado
    $query_check = "SELECT * FROM usuarios WHERE email = '$email'";
    $result_check = mysqli_query($conn, $query_check);

    if (mysqli_num_rows($result_check) > 0) {
        $msg = "E-mail já cadastrado!";
    } else {
        // Inserir no banco de dados
        $query = "INSERT INTO usuarios (nome, email, telefone, senha) VALUES ('$nome', '$email', '$telefone', '$senha_cripto')";
        if (mysqli_query($conn, $query)) {
            $msg = "Usuário cadastrado com sucesso!";
            header("Location: login.php");
            exit();
        } else {
            $msg = "Erro ao cadastrar usuário. Tente novamente.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Planeja+</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f8fa;
            font-family: Arial, sans-serif;
        }
        .cadastro-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .cadastro-container h2 {
            text-align: center;
            color: #5dcfb0;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .btn-cadastrar {
            background-color: #5dcfb0;
            border-color: #5dcfb0;
            width: 100%;
        }
        .btn-cadastrar:hover {
            background-color: #4db89c;
            border-color: #4db89c;
        }
        .alert-info {
            text-align: center;
            color: #31708f;
        }
    </style>
</head>
<body>
    <div class="cadastro-container">
        <h2>Cadastro de Usuário</h2>
        <div style="text-align: center; margin-bottom: 10px;">
    <a href="login.php" class="btn btn-primary">Voltar ao Login</a>
</div>

        <?php if (isset($msg)) { echo "<div class='alert alert-info'>$msg</div>"; } ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" id="nome" placeholder="Digite seu nome" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Digite seu e-mail" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" class="form-control" id="telefone" placeholder="Digite seu telefone" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" name="senha" class="form-control" id="senha" placeholder="Digite sua senha" required>
            </div>
            <button type="submit" name="submit" class="btn btn-cadastrar">Cadastrar</button>
        </form>
    </div>
</body>
</html>
