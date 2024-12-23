<?php
session_start();
include 'conexao.php';

$usuario_logado = isset($_SESSION['usuario']) && isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

// Redireciona se o usuário não for administrador
if (!$usuario_logado) {
    $_SESSION['msg'] = "<p style='color: red;'>Você precisa estar logado como administrador para acessar esta funcionalidade.</p>";
    header("Location: login.php");
    exit();
}


// Mensagem de sucesso ou erro
$msg = "";
if (isset($_GET['status']) && $_GET['status'] === 'success') {
    $msg = "<p style='color: green;'>Usuário excluído com sucesso!</p>";
} elseif (isset($_GET['status']) && $_GET['status'] === 'error') {
    $msg = "<p style='color: red;'>Erro ao excluir o usuário.</p>";
}

// Obter lista de usuários
$result = $conn->query("SELECT id, nome, email, role FROM usuarios");
$usuarios = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Planeja+ - Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f8fa;
        }
        .jumbotron {
            background-color: #5dcfb0;
            color: white;
            padding: 40px;
            text-align: center;
        }
        .jumbotron h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .navbar {
            margin-bottom: 0;
        }
        .navbar-inverse {
            background-color: #5dcfb0;
            border-color: #5dcfb0;
        }
        .navbar-inverse .navbar-brand {
            color: white;
        }
        .navbar-inverse .navbar-nav > li > a {
            color: white;
        }
        .container {
            margin-top: 20px;
        }
        .btn-danger {
            color: white;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        table th, table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #5dcfb0;
            color: white;
        }
        .message {
            margin-top: 10px;
            text-align: center;
        }
        .btn {
            padding: 5px 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="admin_index.php">Planeja+</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <?php if ($usuario_logado): ?>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="jumbotron">
        <h1>Bem-vindo, Admin!</h1>
        <p>Gerencie usuários e o sistema de agendamentos com acesso completo.</p>
    </div>

    <div class="container">
        <?php if ($msg): ?>
            <div class="message"><?php echo $msg; ?></div>
        <?php endif; ?>

        <h2>Lista de Usuários</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo $usuario['id']; ?></td>
                        <td><?php echo $usuario['nome']; ?></td>
                        <td><?php echo $usuario['email']; ?></td>
                        <td><?php echo $usuario['role']; ?></td>
                        <td>
                            <?php if ($usuario['role'] !== 'admin'): ?>
                                <form action="remover_usuario.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
