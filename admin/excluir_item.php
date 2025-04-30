<?php
if (isset($_GET['id'])) {
    
    include "../conexao.php";

    $id = intval($_GET['id']);
    $conn->query("DELETE FROM itens WHERE item_id = $id");

    $conn->close();
}

// Redirecionar de volta à página do estoque
header("Location: estoque.php"); // altere o nome do arquivo conforme o necessário
exit();
?>
