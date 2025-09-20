<?php
session_start(); if(!isset($_SESSION['user'])) { header('Location: ../login.php'); exit; }
include("../db.php");
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Máquinas</title></head><body>
<h1>Máquinas</h1>
<p><a href="novo.php">Nova Máquina</a> | <a href="../index.php">Voltar</a></p>
<table border="1" cellpadding="5">
<tr><th>ID</th><th>Tipo</th><th>Modelo</th><th>Última Manutenção</th><th>Cliente</th><th>Ações</th></tr>
<?php
$res = $conn->query("SELECT m.*, c.nome as cliente FROM maquinas m LEFT JOIN clientes c ON m.cliente_id=c.id ORDER BY m.id DESC");
while($r = $res->fetch_assoc()){
    echo '<tr>';
    echo '<td>'.$r['id'].'</td>';
    echo '<td>'.htmlentities($r['tipo']).'</td>';
    echo '<td>'.htmlentities($r['modelo']).'</td>';
    echo '<td>'.$r['ultima_manutencao'].'</td>';
    echo '<td>'.htmlentities($r['cliente']).'</td>';
    echo '<td><a href="editar.php?id='.$r['id'].'">Editar</a> | <a href="excluir.php?id='.$r['id'].'" onclick="return confirm(\'Excluir?\')">Excluir</a></td>';
    echo '</tr>';
}
?>
</table>
</body></html>
