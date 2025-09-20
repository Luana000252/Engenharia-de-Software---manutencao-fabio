<?php
session_start(); if(!isset($_SESSION['user'])) { header('Location: ../login.php'); exit; }
include("../db.php");
$id = intval($_GET['id'] ?? 0);
$clientes = $conn->query("SELECT id,nome FROM clientes ORDER BY nome");
$maquinas = $conn->query("SELECT id, tipo, modelo FROM maquinas ORDER BY id DESC");
if($_POST){
    $tipo = $conn->real_escape_string($_POST['tipo']);
    $descricao = $conn->real_escape_string($_POST['descricao']);
    $data = $_POST['data_servico'] ? "'".$conn->real_escape_string($_POST['data_servico'])."'" : "NULL";
    $cliente_id = intval($_POST['cliente_id']);
    $maquina_id = intval($_POST['maquina_id']);
    $conn->query("UPDATE servicos SET tipo='$tipo', descricao='$descricao', data_servico=$data, cliente_id=$cliente_id, maquina_id=$maquina_id WHERE id=$id");
    header('Location: index.php'); exit;
}
$res = $conn->query("SELECT * FROM servicos WHERE id=$id");
$row = $res->fetch_assoc();
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Editar Serviço</title></head><body>
<h1>Editar Serviço</h1>
<form method="post">
Tipo: <select name="tipo"><option value="Preventiva" <?php if($row['tipo']=='Preventiva') echo 'selected'; ?>>Preventiva</option><option value="Corretiva" <?php if($row['tipo']=='Corretiva') echo 'selected'; ?>>Corretiva</option></select><br>
Descrição: <br><textarea name="descricao" rows="4" cols="50"><?php echo htmlentities($row['descricao']); ?></textarea><br>
Data: <input type="date" name="data_servico" value="<?php echo $row['data_servico']; ?>"><br>
Cliente: <select name="cliente_id"><?php while($c = $clientes->fetch_assoc()){ $sel = ($c['id']==$row['cliente_id'])?'selected':''; echo '<option value="'.$c['id'].'" '.$sel.'>'.htmlentities($c['nome']).'</option>'; } ?></select><br>
Máquina: <select name="maquina_id"><?php while($m = $maquinas->fetch_assoc()){ $sel = ($m['id']==$row['maquina_id'])?'selected':''; echo '<option value="'.$m['id'].'" '.$sel.'>'.htmlentities($m['tipo'].' - '. $m['modelo']).'</option>'; } ?></select><br>
<button type="submit">Salvar</button>
</form>
<p><a href="index.php">Voltar</a></p>
</body></html>
