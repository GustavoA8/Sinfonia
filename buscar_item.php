<?php
include "conexao.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM itens WHERE item_id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(['erro' => 'Item não encontrado']);
    }
}
?>
