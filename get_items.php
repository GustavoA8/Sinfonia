<?php
include "conexao.php";

$tipo = $_GET['tipo'] ?? '';

$items = [];

if ($tipo == "") {
    $sql = "SELECT item_id, item_nome, item_img, item_preco, nome FROM itens INNER JOIN marca on item_marca_fk = id_marca";
    $result = $conn->query($sql);

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
} else {
    $sql = "SELECT item_id, item_nome, item_img, item_preco, nome FROM itens 
            INNER JOIN marca ON item_marca_fk = id_marca
            INNER JOIN tipo ON item_tipo_fk = tipo_id 
            WHERE tipo_nome LIKE ?";
    $busca = $tipo . '%';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $busca);
    $stmt->execute();
    $result = $stmt->get_result();

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

$conn->close();

// Retorna como JSON
header('Content-Type: application/json');
echo json_encode($items);
?>
