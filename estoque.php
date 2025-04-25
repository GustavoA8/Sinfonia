<?php
// Conexão com o banco
$conn = new mysqli("localhost", "root", "", "bdsinfonia");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Buscar tipos
$tipos_result = $conn->query("SELECT * FROM tipo");

// Buscar marcas
$marcas_result = $conn->query("SELECT * FROM marca");
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
                    <tr id="itens">

                    </tr>
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
                                        <?php while ($tipo = $tipos_result->fetch_assoc()): ?>
                                            <option value="<?= $tipo['tipo_id'] ?>"><?= $tipo['tipo_nome'] ?></option>
                                        <?php endwhile; ?>
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
                                            <<?php while ($marca = $marcas_result->fetch_assoc()): ?>
                                                <option value="<?= $marca['id_marca'] ?>"><?= $marca['nome'] ?></option>
                                            <?php endwhile; ?>
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
    <script src="assets/js/estoque.js"></script>
</body>

</html>