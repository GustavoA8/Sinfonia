<?php
// Conexão com o banco
$conn = new mysqli("localhost", "root", "", "bdsinfonia");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

/// Buscar tipos e marcas e armazenar em arrays reutilizáveis
$tipos = [];
$tipos_result = $conn->query("SELECT * FROM tipo");
while ($tipo = $tipos_result->fetch_assoc()) {
    $tipos[] = $tipo;
}

$marcas = [];
$marcas_result = $conn->query("SELECT * FROM marca");
while ($marca = $marcas_result->fetch_assoc()) {
    $marcas[] = $marca;
}


$itens_result = $conn->query("
    SELECT item_id, item_nome, item_img, tipo_nome, item_estado, nome, item_preco FROM itens INNER JOIN tipo ON item_tipo_fk = tipo_id INNER JOIN marca ON item_marca_fk = id_marca;
");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/style copy.css">
</head>

<body>
    <header class="bg-primary w-100 text-center py-3 ">
        <h1 class="text-light">Estoque Sinfonia</h1>
    </header>
    <main class="w-75 mx-auto mt-5 border border-dark">

        <button type="button" class="mt-3 btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#myModal">Cadastrar</button>

        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Imagem</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Marca</th>
                        <th>Preço</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                <?php
if ($itens_result->num_rows > 0) {
    while ($row = $itens_result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['item_id'] . "</td>";
        echo "<td>" . $row['item_nome'] . "</td>";
        echo "<td><img src='" . $row['item_img'] . "' alt='Imagem' width='50'></td>";
        echo "<td>" . $row['tipo_nome'] . "</td>";
        echo "<td>" . $row['item_estado'] . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>R$ " . number_format($row['item_preco'], 2, ',', '.') . "</td>";
        echo "<td><button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#myModal2' onclick='carregarDadosEditar({$row['item_id']})'>Editar</button></td>";
        echo "<td><a href='excluir_item.php?id=" . $row['item_id'] . "' onclick='return confirm(\"Tem certeza que deseja excluir este item?\")' class='btn btn-danger btn-sm'>Excluir</a></td>";
        echo "</tr>";
        
    }
} else {
    echo "<tr><td colspan='9' class='text-center'>Nenhum item encontrado.</td></tr>";
}
?>
                </tbody>
            </table>
        </div>

    </main>
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Cadastrar</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="action_page.php" method="POST" enctype="multipart/form-data">
                                <div class="d-flex ">
                                    <div class="mx-1">
                                        <label for="nome" class="form-label">Nome:</label>
                                        <input type="text" class="form-control" id="nome" placeholder="Nome"
                                            name="nome">
                                    </div>
                                    <div class="mx-1">
                                        <label for="tipo" class="form-label">Tipo:</label>
                                        <select class="form-select" onchange="comboTipo()" id="tipo" name="tipo">
                                        <?php foreach ($tipos as $tipo): ?>
                                            <option value="<?= $tipo['tipo_id'] ?>"><?= $tipo['tipo_nome'] ?></option>
                                        <?php endforeach; ?>
                                        <option>Outra</option>
                                        </select>
                                        <input id="input-tipo" type="text" name="novo_tipo" class="mt-2" disabled>
                                    </div>
                                    <div class="mx-1">
                                        <label for="estado" class="form-label">Estado:</label>
                                        <select class="form-select" id="estado" name="estado">
                                            <option>Novo</option>
                                            <option>Seminovo</option>
                                        </select>
                                    </div>
                                    <div class="mx-1">
                                        <label for="marca" class="form-label">Marca:</label>
                                        <select class="form-select" onchange="comboMarca()" id="marca" name="marca">
                                        <?php foreach ($marcas as $marca): ?>
                                            <option value="<?= $marca['id_marca'] ?>"><?= $marca['nome'] ?></option>
                                        <?php endforeach; ?>
                                            <option>Outra</option>
                                        </select>
                                        <input type="text" name="nova_marca" id="input-marca" class="mt-1" disabled>
                                    </div>
                                    <div class="mx-1">
                                        <label for="preco" class="form-label">Preço:</label>
                                        <input type="text" class="form-control" id="preco" placeholder="preço"
                                            name="preco">
                                    </div>
                                </div>
                                <div class="mx-1 w-50">
                                    <label for="imagem" class="form-label">Imagem:</label>
                                    <input type="file" class="form-control" id="imagem" placeholder="imagem"
                                        name="imagem">
                                </div>
                                <button type="submit" class="btn mt-3 float-end btn-primary">Cadastrar</button>
                    </form>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal" id="myModal2">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Editar</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="editar_item.php" method="POST" enctype="multipart/form-data">
                                <div class="d-flex ">
                                    <div class="mx-1">
                                        <label for="nome" class="form-label">Nome:</label>
                                        <input type="text" class="form-control" id="nomeE" placeholder="Nome"
                                            name="nome">
                                    </div>
                                    <div class="mx-1">
                                        <label for="tipo" class="form-label">Tipo:</label>
                                        <select class="form-select" onchange="comboTipo()" id="tipoE" name="tipo">
                                        <?php foreach ($tipos as $tipo): ?>
                                            <option value="<?= $tipo['tipo_id'] ?>"><?= $tipo['tipo_nome'] ?></option>
                                        <?php endforeach; ?>
                                        <option>Outra</option>
                                        </select>
                                        <input id="input-tipoE" type="text" name="novo_tipo" class="mt-2" disabled>
                                    </div>
                                    <div class="mx-1">
                                        <label for="estado" class="form-label">Estado:</label>
                                        <select class="form-select" id="estadoE" name="estado">
                                            <option>Novo</option>
                                            <option>Seminovo</option>
                                        </select>
                                    </div>
                                    <div class="mx-1">
                                        <label for="marca" class="form-label">Marca:</label>
                                        <select class="form-select" onchange="comboMarca()" id="marcaE" name="marca">
                                        <?php foreach ($marcas as $marca): ?>
                                            <option value="<?= $marca['id_marca'] ?>"><?= $marca['nome'] ?></option>
                                        <?php endforeach; ?>
                                        <option>Outra</option>
                                        </select>
                                        <input type="text" name="nova_marca" id="input-marcaE" class="mt-1" disabled>
                                    </div>
                                    <div class="mx-1">
                                        <label for="preco" class="form-label">Preço:</label>
                                        <input type="text" class="form-control" id="precoE" placeholder="preço"
                                            name="preco">
                                    </div>
                                </div>
                                <div class="mx-1 w-50">
                                    <label for="imagem" class="form-label">Imagem:</label>
                                    <input type="file" class="form-control" id="imagemE" placeholder="imagem"
                                        name="imagem">
                                    <img id="imagem-preview" src="" alt="Imagem atual" width="100" class="mt-2">
                                </div>
                                <button type="submit" class="btn mt-3 float-end btn-primary">Cadastrar</button>
                    </form>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <script src="assets/js/estoque.js"></script>
</body>

</html>