<?php
require_once __DIR__ . '/classes/login.php';
require_once __DIR__ . '/classes/DB.php';
$validador = new Login();
$validador->verificar_logado();

$db = new DB(); // instanciando corretamente a classe DB

// Cadastrar novo produto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome_produto']) && !isset($_POST['id'])) {
    $data = [
        'nome_produto' => $_POST['nome_produto'],
        'preco' => $_POST['preco'],
        'descricao' => $_POST['descricao'],
        'categoria' => $_POST['categoria']
    ];

    if ($db->insert('produtos_artesanais', $data)) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Produto cadastrado com sucesso!',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'home.php';
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro ao cadastrar produto',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema do lojista</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- lib sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #6c63ff;
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        main {
            padding: 40px;
            text-align: center;
        }

        .btn-container {
            margin-top: 30px;
        }

        a.button {
            display: inline-block;
            padding: 12px 24px;
            margin: 10px;
            background-color: #6c63ff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        a.button:hover {
            background-color: #4e47d4;
        }

        footer {
            text-align: center;
            margin-top: 40px;
            color: #777;
            font-size: 0.9em;
        }
    </style>
</head>
<body>

    <header>
        <h1>Cadastro de Produtos da Lojinha</h1>
    </header>
        
    <main>
        <h2>Bem-vindo(a), Lojista!</h2>

        <div class="btn-container">
            <a  class="button"  onclick="showRegistrationForm()">Cadastrar Produto</a>
            <a href="list_products.php" class="button">Visualizar Produtos</a>
            <!-- <a class="button" onclick="confirmDelete(<?= $produto['id'] ?>)">Remover Produto</a> -->
            <a href="login.php" class="button">Logout</a>
        </div>
    </main>


<!-- Modal de Registro de Produto -->
<div class="modal fade" id="registrationModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" id="productForm" class="modal-content needs-validation" novalidate>
      <div class="modal-header">
        <h5 class="modal-title">Registro de Produto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="productName" class="form-label">Nome do produto</label>
          <input type="text" class="form-control" id="productName" name="nome_produto" required>
        </div>
        <div class="mb-3">
          <label for="productDescription" class="form-label">Descrição</label>
          <textarea class="form-control" id="productDescription" name="descricao" rows="3" required></textarea>
        </div>
        <div class="mb-3">
          <label for="productValue" class="form-label">Valor</label>
          <input type="number" class="form-control" id="productValue" name="preco" step="0.01" min="0" required>
        </div>
        <div class="mb-3">
          <label for="productCategory" class="form-label">Categoria</label>
          <input type="text" class="form-control" id="productCategory" name="categoria" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Salvar produto</button>
      </div>
    </form>
  </div>
</div>

    <footer>
        &copy; 2025 Lojinha Artesanal - Fatec Araras
    </footer>

    <!-- Script para abrir o modal de registro de produto -->
 <script>
function showRegistrationForm() {
    var modal = new bootstrap.Modal(document.getElementById('registrationModal'));
    modal.show();
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

