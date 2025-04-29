<?php
if (isset($_GET['id'])) {
    $conn = new mysqli("localhost", "root", "", "bdsinfonia");

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    $id = intval($_GET['id']);
    $conn->query("DELETE FROM itens WHERE item_id = $id");

    $conn->close();
}

// Redirecionar de volta à página do estoque
header("Location: estoque.php"); // altere o nome do arquivo conforme o necessário
exit();
?>
