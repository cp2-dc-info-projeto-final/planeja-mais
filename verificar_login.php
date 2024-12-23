<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    $_SESSION['msg'] = "<p style='color: red;'>Você precisa estar logado para acessar esta página.</p>";
    header("Location: login.php");
    exit();
}
?>
