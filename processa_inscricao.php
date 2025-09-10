<?php
// Configurações do banco de dados
require_once "db.php";


// Receber dados do formulário
$nome = $_POST['nome'];
$idade = $_POST['idade'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$telefone = $_POST['telefone'];
$comunidade = $_POST['comunidade'];
$paroquia = $_POST['paroquia'];
$alergias = $_POST['alergias'];
$medicamentos = $_POST['medicamentos'];

// Inserir no banco
$sql = "INSERT INTO juventude 
        (nome, idade, email, senha, telefone, comunidade, paroquia, alergias, medicamentos) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sisssssss", $nome, $idade, $email, $senha, $telefone, $comunidade, $paroquia, $alergias, $medicamentos);

if ($stmt->execute()) {

    // Email HTML
    $assunto = "Confirmação de Inscrição - Gincana Bíblica Juventude Abel";

    $mensagem = "
    <html>
    <head>
        <title>Confirmação de Inscrição</title>
        <style>
            body { font-family: Arial, sans-serif; background-color: #f4f7f8; color: #333; }
            .container { max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
            h2 { color: #007BFF; text-align: center; }
            p { line-height: 1.6; font-size: 16px; }
            .datas { background-color: #e7f1ff; padding: 10px; border-radius: 5px; margin: 15px 0; }
            .footer { margin-top: 20px; font-size: 14px; color: #555; text-align: center; }
        </style>
    </head>
    <body>
        <div class='container'>
            <h2>Inscrição Confirmada!</h2>
            <p>Olá <strong>$nome</strong>,</p>
            <p>Sua inscrição para a <strong>Gincana Bíblica da Juventude Abel</strong> foi realizada com sucesso! 🙏</p>

            <div class='datas'>
                <p><strong>Datas e horários:</strong></p>
                <ul>
                    <li>Sábado, 20 de setembro: das 13h às 18h</li>
                    <li>Domingo, 21 de setembro: iniciando às 13h e encerrando com a missa às 17h</li>
                </ul>
            </div>

            <p>Prepare-se para momentos de aprendizado, confraternização e fé! Estamos ansiosos pela sua participação.</p>

            <p class='footer'>Atenciosamente,<br>Equipe Juventude Abel</p>
        </div>
    </body>
    </html>
    ";

    // Cabeçalhos para email HTML
    $cabecalhos = "MIME-Version: 1.0" . "\r\n";
    $cabecalhos .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $cabecalhos .= "From: Juventude Abel <gincanabiblica@juventudeabel.com.br>\r\n";
    $cabecalhos .= "Reply-To: gincanabiblica@juventudeabel.com.brm\r\n";

    mail($email, $assunto, $mensagem, $cabecalhos);

    // Mensagem de confirmação visual bonita
    echo "
    <!DOCTYPE html>
    <html lang='pt-br'>
    <head>
    <meta charset='UTF-8'>
    <title>Inscrição Realizada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .mensagem-container {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            text-align: center;
            max-width: 500px;
        }
        .mensagem-container h2 {
            color: #28a745;
            margin-bottom: 20px;
        }
        .mensagem-container p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .mensagem-container a {
            text-decoration: none;
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border-radius: 6px;
            transition: background 0.3s;
        }
        .mensagem-container a:hover {
            background-color: #0056b3;
        }
    </style>
    </head>
    <body>
        <div class='mensagem-container'>
            <h2>Inscrição realizada com sucesso!</h2>
            <p>Um email de confirmação foi enviado para <strong>$email</strong>.</p>
            <a href='index.php'>Voltar para inscrição</a>
        </div>
    </body>
    </html>
    ";
} else {
    echo "Erro: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
