<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Login do Administrador</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 15px;
    }

    .container {
        width: 100%;
        max-width: 400px;
        background: #fff;
        padding: 40px 30px;
        border-radius: 12px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        text-align: center;
    }

    h2 {
        margin-bottom: 30px;
        color: #333;
        font-size: 1.8rem;
    }

    .input-group {
        position: relative;
        margin-bottom: 20px;
    }

    .input-group svg {
        position: absolute;
        top: 50%;
        left: 12px;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        fill: #6a11cb;
    }

    label {
        display: block;
        text-align: left;
        margin-bottom: 5px;
        font-weight: 600;
        color: #555;
    }

    input {
        width: 100%;
        padding: 12px 40px 12px 40px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 1rem;
        transition: 0.3s;
    }

    input:focus {
        border-color: #6a11cb;
        box-shadow: 0 0 5px rgba(106,17,203,0.4);
        outline: none;
    }

    button {
        width: 100%;
        padding: 14px;
        background: #6a11cb;
        color: #fff;
        font-size: 1.1rem;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s;
    }

    button:hover {
        background: #2575fc;
    }

    .erro {
        color: red;
        font-weight: bold;
        margin-top: 15px;
    }

    @media (max-width: 480px) {
        .container {
            padding: 30px 20px;
        }

        h2 {
            font-size: 1.5rem;
        }

        input, button {
            padding: 12px;
            font-size: 1rem;
        }

        .input-group svg {
            width: 18px;
            height: 18px;
        }
    }
</style>
</head>
<body>
<div class="container">
    <h2>Área Administrativa</h2>
    <form action="valida_login.php" method="POST">

        <div class="input-group">
            <label>Usuário:</label>
            <input type="text" name="usuario" placeholder="Digite seu usuário" required>
        </div>

        <div class="input-group">
            <label>Senha:</label>
            <input type="password" name="senha" placeholder="Digite sua senha" required>
        </div>

        <button type="submit">Entrar</button>
    </form>

    <?php
        if (isset($_GET['erro'])) {
            echo "<p class='erro'>Usuário ou senha inválidos!</p>";
        }
    ?>
</div>
</body>
</html>
