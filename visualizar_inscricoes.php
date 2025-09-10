<?php
session_start();
if (!isset($_SESSION['admin_logado']) || $_SESSION['admin_logado'] !== true) {
    header("Location: login.php");
    exit;
}

require_once "db.php";

$sql = "SELECT id, nome, idade, email, telefone, comunidade, paroquia, alergias, medicamentos, data_inscricao 
        FROM juventude ORDER BY data_inscricao DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Lista de Inscrições</title>
<style>
    body { font-family: Arial, sans-serif; background-color: #f4f7f8; padding: 20px; }
    h2 { text-align: center; color: #333; margin-bottom: 20px; }
    .top-bar { text-align: center; margin-bottom: 20px; }
    .top-bar a { text-decoration: none; color: #fff; background-color: #007BFF; padding: 8px 15px; border-radius: 4px; margin-left: 10px; transition: 0.3s; }
    .top-bar a:hover { background-color: #0056b3; }
    
    .view-buttons { text-align: center; margin-bottom: 20px; }
    .view-buttons button { padding: 8px 15px; margin: 0 5px; border: none; border-radius: 4px; cursor: pointer; background-color: #007BFF; color: #fff; transition: 0.3s; }
    .view-buttons button.active { background-color: #0056b3; }
    .view-buttons button:hover { background-color: #0056b3; }

    .table-container { overflow-x: auto; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); background: #fff; padding: 10px; }

    table { width: 100%; border-collapse: collapse; min-width: 800px; }
    th, td { padding: 12px 15px; text-align: left; font-size: 14px; }
    th { background-color: #007BFF; color: #fff; text-transform: uppercase; font-size: 13px; }
    tr:nth-child(even) { background-color: #f9f9f9; }
    tr:hover { background-color: #e9f0f7; }

    /* Responsivo: cards para mobile */
    @media (max-width: 768px) {
        table, thead, tbody, th, td, tr { display: block; }
        thead tr { display: none; }
        tr { margin-bottom: 15px; border: 1px solid #ddd; border-radius: 8px; padding: 10px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        td { text-align: right; padding-left: 50%; position: relative; font-size: 14px; }
        td::before { content: attr(data-label); position: absolute; left: 15px; width: calc(50% - 30px); font-weight: bold; text-align: left; color: #555; }
    }

    /* Oculta / mostra tabelas */
    .hidden { display: none; }
</style>
</head>
<body>

<h2>Lista de Inscrições - Gincana Bíblica</h2>
<div class="top-bar">
    Bem-vindo, <?php echo htmlspecialchars($_SESSION['admin_usuario']); ?> |
    <a href="logout.php">Sair</a>
</div>

<div class="view-buttons">
    <button id="btn-resumida" class="active">Resumida</button>
    <button id="btn-extensa">Extensa</button>
</div>

<!-- Tabela resumida -->
<div class="table-container" id="resumida">
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Idade</th>
            <th>Email</th>
            <th>Comunidade</th>

        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            $n = 0;
            $result->data_seek(0); // reinicia o ponteiro
            while ($row = $result->fetch_assoc()) {
                $n++;
                echo "<tr>
                        <td data-label='ID'>".$n."</td>
                        <td data-label='Nome'>".$row['nome']."</td>
                        <td data-label='Idade'>".$row['idade']."</td>
                        <td data-label='Email'>".$row['email']."</td>
                        <td data-label='Email'>".$row['comunidade']."</td>

                      </tr>";
            }
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Tabela extensa -->
<div class="table-container hidden" id="extensa">
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Idade</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Comunidade</th>
            <th>Paróquia</th>
            <th>Alergias</th>
            <th>Medicamentos</th>
            <th>Data</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            $result->data_seek(0); // reinicia o ponteiro
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td data-label='ID'>".$row['id']."</td>
                        <td data-label='Nome'>".$row['nome']."</td>
                        <td data-label='Idade'>".$row['idade']."</td>
                        <td data-label='Email'>".$row['email']."</td>
                        <td data-label='Telefone'>".$row['telefone']."</td>
                        <td data-label='Comunidade'>".$row['comunidade']."</td>
                        <td data-label='Paróquia'>".$row['paroquia']."</td>
                        <td data-label='Alergias'>".(!empty($row['alergias']) ? $row['alergias'] : "Nenhuma")."</td>
                        <td data-label='Medicamentos'>".(!empty($row['medicamentos']) ? $row['medicamentos'] : "Nenhum")."</td>
                        <td data-label='Data'>".$row['data_inscricao']."</td>
                      </tr>";
            }
        }
        $conn->close();
        ?>
        </tbody>
    </table>
</div>

<script>
    const btnResumida = document.getElementById('btn-resumida');
    const btnExtensa = document.getElementById('btn-extensa');
    const tabelaResumida = document.getElementById('resumida');
    const tabelaExtensa = document.getElementById('extensa');

    btnResumida.addEventListener('click', () => {
        tabelaResumida.classList.remove('hidden');
        tabelaExtensa.classList.add('hidden');
        btnResumida.classList.add('active');
        btnExtensa.classList.remove('active');
    });

    btnExtensa.addEventListener('click', () => {
        tabelaResumida.classList.add('hidden');
        tabelaExtensa.classList.remove('hidden');
        btnResumida.classList.remove('active');
        btnExtensa.classList.add('active');
    });
</script>

</body>
</html>
