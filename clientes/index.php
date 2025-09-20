<?php
session_start(); if(!isset($_SESSION['user'])) { header('Location: ../login.php'); exit; }
include("../db.php");
?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Clientes</title></head><body>
<h1>Clientes</h1>
<p><a href="novo.php">Novo Cliente</a> | <a href="../index.php">Voltar</a></p>
<table border="1" cellpadding="5">
<tr><th>ID</th><th>Nome</th><th>Contato</th><th>Endereço</th><th>Ações</th></tr>
<?php
$res = $conn->query("SELECT * FROM clientes ORDER BY id DESC");
while($r = $res->fetch_assoc()){
    echo '<tr>';
    echo '<td>'.$r['id'].'</td>';
    echo '<td>'.htmlentities($r['nome']).'</td>';
    echo '<td>'.htmlentities($r['contato']).'</td>';
    echo '<td>'.htmlentities($r['endereco']).'</td>';
    echo '<td><a href="editar.php?id='.$r['id'].'">Editar</a> | <a href="excluir.php?id='.$r['id'].'" onclick="return confirm(\'Excluir?\')">Excluir</a></td>';
    echo '</tr>';
}
?>
</table>
</body></html>
