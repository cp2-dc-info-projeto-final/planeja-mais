<?php
session_start();
include_once("conexao.php"); // Inclui o arquivo de conexão com o banco

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = md5($_POST['senha']); // Certifique-se de que a senha está armazenada em MD5 no banco

    // Verifica se os campos não estão vazios
    if (!empty($email) && !empty($senha)) {
        $sql = "SELECT id, nome, role FROM usuarios WHERE email = ? AND senha = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();

            // Configura a sessão
            $_SESSION['usuario'] = $usuario['nome'];
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['role'] = $usuario['role'];

            // Redireciona com base no role
            if ($usuario['role'] === 'admin') {
                header("Location: admin_index.php"); // Página de admin
            } else {
                header("Location: index.php"); // Página de usuário comum
            }
            exit();
        } else {
            $_SESSION['msg'] = "E-mail ou senha inválidos!";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['msg'] = "Preencha todos os campos!";
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
