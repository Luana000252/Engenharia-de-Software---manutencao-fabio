<?php
session_start(); if(!isset($_SESSION['user'])) { header('Location: ../login.php'); exit; }
include("../db.php");
$clientes = $conn->query("SELECT id,nome FROM clientes ORDER BY nome");
if($_POST){
    $tipo = $conn->real_escape_string($_POST['tipo']);
    $modelo = $conn->real_escape_string($_POST['modelo']);
    $ultima = $_POST['ultima_manutencao'] ? "'".$conn->real_escape_string($_POST['ultima_manutencao'])."'" : "NULL";
    $cliente_id = intval($_POST['cliente_id']);
    $conn->query("INSERT INTO maquinas (tipo,modelo,ultima_manutencao,cliente_id) VALUES ('$tipo','$modelo',$ultima,$cliente_id)");
    header('Location: index.php'); exit;
}
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Nova Máquina</title></head><body>
<h1>Nova Máquina</h1>
<form method="post">
Tipo: <input type="text" name="tipo" required><br>
Modelo: <input type="text" name="modelo"><br>
Última manutenção: <input type="date" name="ultima_manutencao"><br>
Cliente: <select name="cliente_id">
<?php while($c = $clientes->fetch_assoc()){ echo '<option value="'.$c['id'].'">'.htmlentities($c['nome']).'</option>'; } ?>
</select><br>
<button type="submit">Salvar</button>
</form>
<p><a href="index.php">Voltar</a></p>
</body></html>
