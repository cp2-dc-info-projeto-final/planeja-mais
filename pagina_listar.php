<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // Redireciona para o login
    exit();
}

$usuario_id = $_SESSION['usuario_id']; // Pega o ID do usuário logado
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Agendamentos</title>
    <!-- Link para o CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f8fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 40px;
        }
        h1 {
            color: #5dcfb0;
        }
        .table th {
            background-color: #5dcfb0;
            color: white;
        }
        .btn-danger {
            background-color: #d9534f;
            border-color: #d43f3a;
        }
        .btn-danger:hover {
            background-color: #c9302c;
            border-color: #ac2925;
        }
        .btn-primary {
            background-color: #5dcfb0;
            border-color: #5dcfb0;
        }
        .btn-primary:hover {
            background-color: #4db89c;
            border-color: #4db89c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Meus Agendamentos</h1>

        <?php
        // Exibir mensagens de status
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'sucesso') {
                echo "<div class='alert alert-success'>Agendamento cancelado com sucesso!</div>";
            } elseif ($_GET['status'] == 'erro') {
                echo "<div class='alert alert-danger'>Erro ao cancelar o agendamento. Tente novamente.</div>";
            } elseif ($_GET['status'] == 'sem_id') {
                echo "<div class='alert alert-warning'>Nenhum ID de agendamento foi fornecido.</div>";
            }
        }

        // Incluir conexão com o banco de dados
        include_once("conexao.php");

        // Query para buscar agendamentos do usuário logado
        $sql = "SELECT id, nome, tarefas, DATE_FORMAT(data, '%d/%m/%Y %H:%i:%s') AS data_formatada FROM agendamentos WHERE usuario_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $usuario_id); // Substitui o ? pelo usuario_id
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<table class='table table-striped mt-3'>";
            echo "<thead><tr><th>ID</th><th>Nome</th><th>Tarefa</th><th>Data</th><th>Ações</th></tr></thead>";
            echo "<tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $row['tarefas'] . "</td>";
                echo "<td>" . $row['data_formatada'] . "</td>";
                echo "<td>
                        <a href='cancelar_agendamento.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Cancelar</a>
                      </td>";
                echo "</tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-info mt-3'>Nenhum agendamento encontrado.</div>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>

    <!-- Botão para voltar para a página de agendamento -->
    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-primary">Voltar para Agendar</a>
    </div>

    <!-- Link para JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
