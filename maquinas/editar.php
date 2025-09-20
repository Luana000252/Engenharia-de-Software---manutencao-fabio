<?php
session_start(); if(!isset($_SESSION['user'])) { header('Location: ../login.php'); exit; }
include("../db.php");
$id = intval($_GET['id'] ?? 0);
$clientes = $conn->query("SELECT id,nome FROM clientes ORDER BY nome");
if($_POST){
    $tipo = $conn->real_escape_string($_POST['tipo']);
    $modelo = $conn->real_escape_string($_POST['modelo']);
    $ultima = $_POST['ultima_manutencao'] ? "'".$conn->real_escape_string($_POST['ultima_manutencao'])."'" : "NULL";
    $cliente_id = intval($_POST['cliente_id']);
    $conn->query("UPDATE maquinas SET tipo='$tipo', modelo='$modelo', ultima_manutencao=$ultima, cliente_id=$cliente_id WHERE id=$id");
    header('Location: index.php'); exit;
}
$res = $conn->query("SELECT * FROM maquinas WHERE id=$id");
$row = $res->fetch_assoc();
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Editar Máquina</title></head><body>
<h1>Editar Máquina</h1>
<form method="post">
Tipo: <input type="text" name="tipo" value="<?php echo htmlentities($row['tipo']); ?>" required><br>
Modelo: <input type="text" name="modelo" value="<?php echo htmlentities($row['modelo']); ?>"><br>
Última manutenção: <input type="date" name="ultima_manutencao" value="<?php echo $row['ultima_manutencao']; ?>"><br>
Cliente: <select name="cliente_id"><?php while($c = $clientes->fetch_assoc()){ $sel = ($c['id']==$row['cliente_id'])?'selected':''; echo '<option value="'.$c['id'].'" '.$sel.'>'.htmlentities($c['nome']).'</option>'; } ?></select><br>
<button type="submit">Salvar</button>
</form>
<p><a href="index.php">Voltar</a></p>
</body></html>
