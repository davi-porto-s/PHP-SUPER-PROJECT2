<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Projeto 2 - Login</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .container { max-width: 400px; margin: 0 auto; border: 1px solid #ccc; padding: 20px; border-radius: 5px; }
        h2 { text-align: center; }
        label { display: block; margin-top: 10px; }
        input[type="text"], input[type="password"], select { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        input[type="submit"] { background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Projeto 2 - Login</h2>
        <form method="POST" action="login.php">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" value="admin" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" value="123" required>

            <label for="tema">Tema:</label>
            <select name="tema" id="tema">
                <option value="claro">Claro</option>
                <option value="escuro">Escuro</option>
                <option value="azul">Azul Empresarial</option>
            </select>
            
            <input type="submit" value="Entrar">
        </form>
        <p style="text-align: center; margin-top: 15px;">Use: admin/123</p>
    </div>
</body>
</html>
