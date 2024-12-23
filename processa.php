<?php
session_start();
include_once("conexao.php");

// Verifica se os campos necessários foram enviados
$nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
$tarefas = isset($_POST['tarefas']) ? trim($_POST['tarefas']) : '';
$data = isset($_POST['data']) ? trim($_POST['data']) : '';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['msg'] = "<p style='color: red;'>Você precisa estar logado para realizar um agendamento!</p>";
    header("Location: login.php");
    exit();
}

// Obtém o ID do usuário logado
$usuario_id = $_SESSION['usuario_id'];

// Valida os campos obrigatórios
if (empty($nome) || empty($tarefas) || empty($data)) {
    $_SESSION['msg'] = "<p style='color: red;'>Preencha todos os campos obrigatórios!</p>";
    header("Location: index.php");
    exit();
}

// Converte a data para o formato MySQL (YYYY-MM-DD HH:MM:SS)
$data_formatada = DateTime::createFromFormat('d/m/Y H:i:s', $data);

if (!$data_formatada) {
    $_SESSION['msg'] = "<p style='color: red;'>Formato de data inválido! Use DD/MM/YYYY HH:MM:SS.</p>";
    header("Location: index.php");
    exit();
}

$data_formatada = $data_formatada->format('Y-m-d H:i:s');

// Verifica se o `usuario_id` existe na tabela `usuarios`
$query_usuario = "SELECT id FROM usuarios WHERE id = ?";
$stmt_usuario = $conn->prepare($query_usuario);
$stmt_usuario->bind_param("i", $usuario_id);
$stmt_usuario->execute();
$result_usuario = $stmt_usuario->get_result();

if ($result_usuario->num_rows === 0) {
    $_SESSION['msg'] = "<p style='color: red;'>Usuário inválido. Faça login novamente.</p>";
    header("Location: login.php");
    exit();
}

// Insere os dados no banco de dados
$query = "INSERT INTO agendamentos (nome, tarefas, data, usuario_id) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);

if ($stmt) {
    $stmt->bind_param("sssi", $nome, $tarefas, $data_formatada, $usuario_id);

    if ($stmt->execute()) {
        $_SESSION['msg'] = "<p style='color: green;'>Agendamento realizado com sucesso!</p>";
        header("Location: pagina_listar.php");
    } else {
        $_SESSION['msg'] = "<p style='color: red;'>Erro ao realizar agendamento: " . htmlspecialchars($stmt->error) . "</p>";
        header("Location: index.php");
    }

    $stmt->close();
} else {
    $_SESSION['msg'] = "<p style='color: red;'>Erro na preparação da consulta: " . htmlspecialchars($conn->error) . "</p>";
    header("Location: index.php");
}

$conn->close();
exit();
?>
