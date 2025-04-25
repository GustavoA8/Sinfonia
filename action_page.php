<?php
$conn = new mysqli("localhost", "root", "", "bdsinfonia");
if ($conn->connect_error) die("Erro: " . $conn->connect_error);

// Coleta os dados
$nome = $_POST['nome'];
$estado = $_POST['estado'];
$preco = $_POST['preco'];

// Tratamento do tipo
$tipo = $_POST['tipo'];
if ($tipo === "Outra") {
    $novo_tipo = trim($_POST['novo_tipo']);
    if (!empty($novo_tipo)) {
        $stmt = $conn->prepare("INSERT INTO tipo (tipo_nome) VALUES (?)");
        $stmt->bind_param("s", $novo_tipo);
        $stmt->execute();
        $tipo_id = $stmt->insert_id;
        $stmt->close();
    } else {
        die("Erro: tipo não informado.");
    }
} else {
    $tipo_id = intval($tipo);
}

// Tratamento da marca
$marca = $_POST['marca'];
if ($marca === "Outra") {
    $nova_marca = trim($_POST['nova_marca']);
    if (!empty($nova_marca)) {
        $stmt = $conn->prepare("INSERT INTO marca (nome) VALUES (?)");
        $stmt->bind_param("s", $nova_marca);
        $stmt->execute();
        $marca_id = $stmt->insert_id;
        $stmt->close();
    } else {
        die("Erro: marca não informada.");
    }
} else {
    $marca_id = intval($marca);
}

// Upload da imagem
$imagem = $_FILES['imagem'];
$imagem_nome = basename($imagem['name']);
$diretorio = "img/";
$caminho = $diretorio . time() . "_" . $imagem_nome;

if (!is_dir($diretorio)) {
    mkdir($diretorio, 0777, true);
}

if (move_uploaded_file($imagem['tmp_name'], $caminho)) {
    // Inserção do item
    $stmt = $conn->prepare("INSERT INTO itens (item_nome, item_img, item_tipo_fk, item_estado, item_marca_fk, item_preco)
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssissd", $nome, $caminho, $tipo_id, $estado, $marca_id, $preco);

    if ($stmt->execute()) {
        echo "Produto cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar item: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Erro ao salvar imagem.";
}

$conn->close();
?>
