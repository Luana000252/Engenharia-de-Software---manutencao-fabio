<?php
session_start(); if(!isset($_SESSION['user'])) { header('Location: ../login.php'); exit; }
include("../db.php");
$clientes = $conn->query("SELECT id,nome FROM clientes ORDER BY nome");
$maquinas = $conn->query("SELECT id, tipo, modelo FROM maquinas ORDER BY id DESC");
if($_POST){
    $tipo = $conn->real_escape_string($_POST['tipo']);
    $descricao = $conn->real_escape_string($_POST['descricao']);
    $data = $_POST['data_servico'] ? "'".$conn->real_escape_string($_POST['data_servico'])."'" : "NULL";
    $cliente_id = intval($_POST['cliente_id']);
    $maquina_id = intval($_POST['maquina_id']);
    $conn->query("INSERT INTO servicos (tipo,descricao,data_servico,cliente_id,maquina_id) VALUES ('$tipo','$descricao',$data,$cliente_id,$maquina_id)");
    header('Location: index.php'); exit;
}
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Novo Serviço</title></head><body>
<h1>Registrar Serviço</h1>
<form method="post">
Tipo: <select name="tipo"><option value="Preventiva">Preventiva</option><option value="Corretiva">Corretiva</option></select><br>
Descrição: <br><textarea name="descricao" rows="4" cols="50"></textarea><br>
Data: <input type="date" name="data_servico"><br>
Cliente: <select name="cliente_id"><?php while($c = $clientes->fetch_assoc()){ echo '<option value="'.$c['id'].'">'.htmlentities($c['nome']).'</option>'; } ?></select><br>
Máquina: <select name="maquina_id"><?php while($m = $maquinas->fetch_assoc()){ echo '<option value="'.$m['id'].'">'.htmlentities($m['tipo'].' - '. $m['modelo']).'</option>'; } ?></select><br>
<button type="submit">Salvar</button>
</form>
<p><a href="index.php">Voltar</a></p>
</body></html>
