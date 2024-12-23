<?php
// Incluir conexão com o banco de dados
include_once("conexao.php");

// Verificar se o ID do agendamento foi enviado via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query para excluir o agendamento
    $sql = "DELETE FROM agendamentos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirecionar para a listagem com mensagem de sucesso
        header("Location: pagina_listar.php?status=sucesso");
    } else {
        // Redirecionar para a listagem com mensagem de erro
        header("Location: pagina_listar.php?status=erro");
    }

    // Fechar a declaração preparada
    $stmt->close();
} else {
    // Redirecionar para a listagem com mensagem de aviso (nenhum ID fornecido)
    header("Location: pagina_listar.php?status=sem_id");
}

// Fechar conexão com o banco de dados
$conn->close();

// Finalizar o script após o redirecionamento
exit();
