<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    // Excluir o usuário, garantindo que não excluímos administradores
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ? AND role != 'admin'");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: admin_index.php?status=success");
    } else {
        header("Location: admin_index.php?status=error");
    }
    $stmt->close();
    exit();
}
?>
