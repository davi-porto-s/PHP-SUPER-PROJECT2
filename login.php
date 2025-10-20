<?php
session_start();

$usuario = $_POST['usuario'] ?? ''; 
$senha = $_POST['senha'] ?? '';
$tema = $_POST['tema'] ?? 'claro';

// Credenciais fixas para teste: admin/123
if ($usuario === 'admin' && $senha === '123') {
    $_SESSION['usuario'] = $usuario;
    $_SESSION['tema'] = $tema; // Salva o tema escolhido na sessão
    
    // Redireciona para a página de produtos
    header("Location: produtos.php");
    exit;
} else {
    echo "
        <!DOCTYPE html>
        <html>
        <head><title>Erro</title></head>
        <body>
            <h2 style='color: red;'>Acesso Negado</h2>
            <p>Usuário ou senha incorretos.</p>
            <p><a href='index.php'>Tentar novamente</a></p>
        </body>
        </html>
    ";
}
?>
