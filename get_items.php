<?php
include "conexao.php";

$sql = "SELECT id, nome, img, preco FROM instrumento";
$result = $conn->query($sql);

// Cria array de objetos
$items = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = [
            "id" => (int)$row["id"],
            "nome" => $row["nome"],
            "img" => $row["img"],
            "preco" => (float)$row["preco"]
        ];
    }
}

// Retorna como JSON
header('Content-Type: application/json');
echo json_encode($items);

$conn->close();
?>