<?php
session_start();
$usuario_logado = isset($_SESSION['usuario']);

// Mensagem de erro para visitantes ao tentar acessar funcionalidades restritas
if (!$usuario_logado && isset($_GET['action']) && $_GET['action'] == 'restricted') {
    $_SESSION['msg'] = "<p style='color: red;'>Você precisa estar logado para acessar esta funcionalidade.</p>";
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Planeja+ - Sistema de Agendamento</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.min.css">
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
        .form-container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-primary, .btn-success {
            width: 100%;
        }
        .message {
            margin-top: 10px;
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Planeja+</a>
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
        <h1>Bem-vindo ao Planeja+</h1>
        <p>Gerencie seus agendamentos de forma rápida e prática.</p>
    </div>

    <div class="container">
        <?php if (isset($_SESSION['msg'])): ?>
            <div class="message"><?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?></div>
        <?php endif; ?>

        <div class="form-container">
            <form class="form-horizontal" action="processa.php" method="POST" onsubmit="return verificarAcesso();">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome" required>
                </div>
                <div class="form-group">
                    <label for="tarefas">Tarefa:</label>
                    <input type="text" class="form-control" id="tarefas" name="tarefas" placeholder="Digite sua tarefa" required>
                </div>
                <div class="form-group">
                    <label for="data">Data e Hora:</label>
                    <div class="input-group date data_formato" data-date-format="dd/mm/yyyy HH:ii:ss">
                        <input type="text" class="form-control" id="data" name="data" placeholder="Escolha a data e hora" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Agendar</button>
            </form>
            <a href="pagina_listar.php" class="btn btn-primary" style="margin-top: 15px;">Ver Agendamentos</a>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datetimepicker.min.js"></script>
    <script src="js/locales/bootstrap-datetimepicker.pt-BR.js"></script>
    <script>
        $('.data_formato').datetimepicker({
            weekStart: 1,
            todayBtn: 1,
            todayHighlight: 1,
            autoclose: 1,
            startView: 2,
            minView: 0,
            language: 'pt-BR'
        });

        function verificarAcesso() {
            <?php if (!$usuario_logado): ?>
                alert('Você precisa estar logado para agendar!');
                window.location.href = '?action=restricted';
                return false;
            <?php endif; ?>
            return true;
        }
    </script>
</body>
</html>
