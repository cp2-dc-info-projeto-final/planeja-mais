<?php
session_start(); // Inicia a sessão

// Verifica se o usuário já está logado
if (isset($_SESSION['usuario']) && isset($_SESSION['usuario_id'])) {
    header("Location: index.php"); // Redireciona para a página inicial
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Planeja+</title>
    <!-- Link para o CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f8fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin-top: 100px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #5dcfb0;
        }
        .btn-primary {
            background-color: #5dcfb0;
            border-color: #5dcfb0;
        }
        .btn-primary:hover {
            background-color: #4db89c;
            border-color: #4db89c;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
        .text-center a {
            color: #5dcfb0;
        }
        .text-center a:hover {
            color: #4db89c;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="autenticar.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Entrar</button>
            </div>
        </form>
        <div class="text-center mt-3">
            <p>Ou</p>
            <div class="d-grid gap-2">
                <a href="cadastro.php" class="btn btn-secondary">Criar Cadastro</a>
                <a href="index.php" class="btn btn-light">Conhecer o Site</a>
            </div>
        </div>
    </div>
    <!-- Link para JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
