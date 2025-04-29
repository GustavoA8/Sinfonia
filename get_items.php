<?php
include "conexao.php";

$sql = "SELECT item_id, item_nome, item_img, item_preco, nome FROM itens INNER JOIN marca on item_marca_fk = id_marca";
$result = $conn->query($sql);

// Cria array de objetos
$items = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = [
            "id" => (int)$row["item_id"],
            "nome" => $row["item_nome"],
            "img" => $row["item_img"],
            "preco" => (float)$row["item_preco"],
            "marca" => $row["nome"],
        ];
    }
}

// Retorna como JSON
header('Content-Type: application/json');
echo json_encode($items);

$conn->close();
?>