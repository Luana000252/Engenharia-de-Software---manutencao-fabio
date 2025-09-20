<?php
session_start(); if(!isset($_SESSION['user'])) { header('Location: ../login.php'); exit; }
include("../db.php");
$id = intval($_GET['id'] ?? 0);
if($_POST){
    $nome = $conn->real_escape_string($_POST['nome']);
    $contato = $conn->real_escape_string($_POST['contato']);
    $endereco = $conn->real_escape_string($_POST['endereco']);
    $conn->query("UPDATE clientes SET nome='$nome', contato='$contato', endereco='$endereco' WHERE id=$id");
    header('Location: index.php'); exit;
}
$res = $conn->query("SELECT * FROM clientes WHERE id=$id");
$row = $res->fetch_assoc();
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Editar Cliente</title></head><body>
<h1>Editar Cliente</h1>
<form method="post">
Nome: <input type="text" name="nome" value="<?php echo htmlentities($row['nome']); ?>" required><br>
Contato: <input type="text" name="contato" value="<?php echo htmlentities($row['contato']); ?>"><br>
Endereço: <input type="text" name="endereco" value="<?php echo htmlentities($row['endereco']); ?>"><br>
<button type="submit">Salvar</button>
</form>
<p><a href="index.php">Voltar</a></p>
</body></html>
