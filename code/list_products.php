<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/classes/login.php';
require_once __DIR__ . '/classes/DB.php';


$validador = new Login();
$validador->verificar_logado();

$db = new DB();
$produtos = $db->getAll('produtos_artesanais');

// var_dump($produtos); // <- Teste para ver saída

// Editar produtos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $data = [
        'nome_produto' => $_POST['nome_produto'],
        'preco' => $_POST['preco'],
        'descricao' => $_POST['descricao'],
        'categoria' => $_POST['categoria']
    ];
// faz a edição do produto e exibe a mensagem de sucesso ou erro.
if ($db->update('produtos_artesanais', $id, $data)) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Produto editado com sucesso!',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'list_products.php';
            });
        });
    </script>";
} else {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Erro ao editar o produto',
                confirmButtonText: 'OK'
            });
        });
    </script>";
}
}
// Excluir produtos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];

    if ($db->delete('produtos_artesanais', $id)) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Produto excluído com sucesso!',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'list_products.php';
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro ao excluir o produto',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <title>Sistema do lojista</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

            <!-- <a  href="logout.php" class="btn btn-danger"></a> -->
             <a href="login.php" class="btn btn-danger" style="margin-left: 100px; margin-top: 50px;">Sair da conta</a>
             <a href="home.php" class="btn btn-secondary" style="margin-left: 100px; margin-top: 50px;">Voltar</a>
<div id="listView" class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lista de produtos</h2>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Valor</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th class="text-end">Ações</th>
            </tr>
        </thead>
        <tbody id="productList">
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= htmlspecialchars($produto['nome_produto']) ?></td>
                    <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars($produto['descricao']) ?></td>
                    <td><?= htmlspecialchars($produto['categoria']) ?></td>
                    <td class="text-end">
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-primary"
                                    onclick="openEditModal(<?= htmlspecialchars(json_encode($produto), ENT_QUOTES, 'UTF-8') ?>)">
                                Editar
                            </button>
                            <button class="btn btn-sm btn-danger"
                                    onclick="confirmDelete(<?= $produto['id'] ?>)">
                                Remover Produto
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal de edição -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" id="editForm" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Produto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="editId">
        <div class="mb-3">
          <label for="editNome" class="form-label">Nome do Produto</label>
          <input type="text" class="form-control" id="editNome" name="nome_produto" required>
        </div>
        <div class="mb-3">
          <label for="editPreco" class="form-label">Preço</label>
          <input type="number" class="form-control" id="editPreco" name="preco" step="0.01" required>
        </div>
        <div class="mb-3">
          <label for="editDescricao" class="form-label">Descrição</label>
          <textarea class="form-control" id="editDescricao" name="descricao" rows="3" required></textarea>
        </div>
        <div class="mb-3">
          <label for="editCategoria" class="form-label">Categoria</label>
          <input type="text" class="form-control" id="editCategoria" name="categoria" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Atualizar</button>
      </div>
    </form>
  </div>
</div>


<!--Abre o modal de edição quando o botão "Editar" for clicado-->
<script>
function openEditModal(produto) {
    document.getElementById('editId').value = produto.id;
    document.getElementById('editNome').value = produto.nome_produto;
    document.getElementById('editPreco').value = produto.preco;
    document.getElementById('editDescricao').value = produto.descricao;
    document.getElementById('editCategoria').value = produto.categoria;
    
    var modal = new bootstrap.Modal(document.getElementById('editModal'));
    modal.show();
}
</script>


<!-- Form oculto para função de deletar -->
 <form id="deleteForm" method="POST" style="display: none;">
    <input type="hidden" name="delete_id" id="delete_id">
</form>
<!-- Script para exclusão de produto com mensagem pra confirmação -->
<script>
function confirmDelete(id) {
     Swal.fire({
         title: 'Tem certeza?',
         text: 'Você não poderá desfazer essa ação!',
         icon: 'warning',
         showCancelButton: true,
         confirmButtonText: 'Sim, excluir!',
         cancelButtonText: 'Cancelar'
     }).then((result) => {
         if (result.isConfirmed) {
             document.getElementById('delete_id').value = id;
             document.getElementById('deleteForm').submit();
         }
     });
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
