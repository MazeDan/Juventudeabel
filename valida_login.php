<?php
session_start();


require_once "db.php";


$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM admins WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $admin = $result->fetch_assoc();

    if (password_verify($senha, $admin['senha'])) {
        $_SESSION['admin_logado'] = true;
        $_SESSION['admin_usuario'] = $usuario;
        header("Location: visualizar_inscricoes.php");
        exit;
    }
}

header("Location: login.php?erro=1");
exit;
?>
