<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    // Uso da superglobal $_SERVER para pegar a URL e informar
    echo "Acesso negado à página: " . $_SERVER['REQUEST_URI'] . ". <a href='index.php'>Faça login</a>";
    exit;
}

// 1. Definição dos temas (Requisito: Mais temas)
$tema = $_SESSION['tema'] ?? 'claro';
$styles = [
    'claro' => 'background-color: #f4f4f4; color: #333;',
    'escuro' => 'background-color: #222; color: #eee;',
    'azul' => 'background-color: #e0f2f7; color: #004d40;',
];
$body_style = $styles[$tema] ?? $styles['claro'];

// 2. Lista de produtos detalhada (Requisito: Mais produtos/informações)
$produtos = [
    ['id' => 1, 'nome' => 'Camisa Polo Básica', 'preco' => 79.90, 'desc' => 'Algodão Pima, ajuste regular.'],
    ['id' => 2, 'nome' => 'Calça Jeans Skinny', 'preco' => 129.50, 'desc' => 'Denim com elastano, lavagem escura.'],
    ['id' => 3, 'nome' => 'Tênis Esportivo Casual', 'preco' => 199.99, 'desc' => 'Leve e respirável, ideal para o dia a dia.'],
    ['id' => 4, 'nome' => 'Boné Aba Curva Classic', 'preco' => 35.00, 'desc' => '100% poliéster, ajuste snapback.'],
    ['id' => 5, 'nome' => 'Meia Social Kit 3 Pares', 'preco' => 45.00, 'desc' => 'Algodão e poliamida, cano alto.'],
    ['id' => 6, 'nome' => 'Mochila Notebook Pro', 'preco' => 249.90, 'desc' => 'Compartimento acolchoado para notebook de 15".'],
];

// 3. Processamento do filtro de busca
$filtro = $_GET['busca'] ?? ''; // Usa a superglobal $_GET

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Produtos - Projeto 2</title>
    <style>
        body { font-family: Arial, sans-serif; <?= $body_style ?> padding: 20px; }
        .container { max-width: 900px; margin: 0 auto; }
        h2, h3 { border-bottom: 2px solid; padding-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background-color: <?= $tema === 'escuro' ? '#333' : '#fff' ?>; color: <?= $tema === 'escuro' ? '#eee' : '#333' ?>; }
        th, td { border: 1px solid <?= $tema === 'escuro' ? '#555' : '#ccc' ?>; padding: 12px; text-align: left; }
        th { background-color: <?= $tema === 'escuro' ? '#444' : '#ddd' ?>; }
        .info-box { padding: 10px; border: 1px dashed; margin-bottom: 20px; }
        .search-form input[type="text"] { padding: 8px; width: 300px; }
        .search-form input[type="submit"] { padding: 8px 15px; background-color: #007bff; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Área de Produtos (Tema: <?= ucfirst($tema) ?>)</h2>
        
        <div class="info-box">
            <p>Bem-vindo(a), **<?= $_SESSION['usuario'] ?>**.</p>
            <p><strong>Status do Servidor:</strong> Sua requisição foi feita usando o método **<?= $_SERVER['REQUEST_METHOD'] ?>**.</p>
            <p>Você está visualizando a página com o tema <strong><?= ucfirst($tema) ?></strong>.</p>
        </div>

        <form method='GET' class="search-form"> 
            Buscar (por nome ou descrição): <input type='text' name='busca' value='<?= htmlspecialchars($filtro) ?>'> 
            <input type='submit' value='Pesquisar'> 
            <a href="produtos.php" style="margin-left: 10px;">Limpar Filtro</a>
        </form>

        <h3>Catálogo de Produtos</h3>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço (R$)</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $encontrou = false;
                foreach ($produtos as $p) {
                    // Lógica do filtro
                    $termo_filtro = strtolower($filtro);
                    $nome_lower = strtolower($p['nome']);
                    $desc_lower = strtolower($p['desc']);

                    if ($filtro === '' || str_contains($nome_lower, $termo_filtro) || str_contains($desc_lower, $termo_filtro)) {
                        echo "<tr>";
                        echo "<td>" . $p['id'] . "</td>";
                        echo "<td>" . $p['nome'] . "</td>";
                        echo "<td>" . number_format($p['preco'], 2, ',', '.') . "</td>";
                        echo "<td>" . $p['desc'] . "</td>";
                        echo "</tr>";
                        $encontrou = true;
                    }
                }
                if (!$encontrou) {
                    echo "<tr><td colspan='4' style='text-align: center;'>Nenhum produto encontrado para '<strong>" . htmlspecialchars($filtro) . "</strong>'.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <p style="margin-top: 30px;"><a href='index.php'>Fazer Logout e Mudar Tema</a></p>
    </div>
</body>
</html>
