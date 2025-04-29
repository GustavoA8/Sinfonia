<?php
include "conexao.php";

$id = $_POST['item_id'];
$nome = $_POST['nome'];
$estado = $_POST['estado'];
$preco = $_POST['preco'];
$tipo = $_POST['tipo'];
$marca = $_POST['marca'];

// Verifica se imagem foi enviada
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
    $imagemNome = $_FILES['imagem']['name'];
    $imagemTmp = $_FILES['imagem']['tmp_name'];
    $caminho = "img/" . $imagemNome;
    move_uploaded_file($imagemTmp, $caminho);
    $sql = "UPDATE itens SET item_nome=?, item_estado=?, item_preco=?, item_tipo_fk=?, item_marca_fk=?, item_img=? WHERE item_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdissi", $nome, $estado, $preco, $tipo, $marca, $caminho, $id);
} else {
    // Sem imagem
    $sql = "UPDATE itens SET item_nome=?, item_estado=?, item_preco=?, item_tipo_fk=?, item_marca_fk=? WHERE item_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdiii", $nome, $estado, $preco, $tipo, $marca, $id);
}

if ($stmt->execute()) {
    header("Location: estoque.php");
} else {
    echo "Erro ao atualizar: " . $stmt->error;
}
?>
