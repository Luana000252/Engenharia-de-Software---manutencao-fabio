<?php
session_start(); if(!isset($_SESSION['user'])) { header('Location: ../login.php'); exit; }
include("../db.php");
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Serviços</title></head><body>
<h1>Serviços</h1>
<p><a href="novo.php">Registrar Serviço</a> | <a href="../index.php">Voltar</a></p>
<table border="1" cellpadding="5">
<tr><th>ID</th><th>Tipo</th><th>Descrição</th><th>Data</th><th>Máquina</th><th>Cliente</th><th>Ações</th></tr>
<?php
$res = $conn->query("SELECT s.*, m.tipo as maquina, c.nome as cliente FROM servicos s LEFT JOIN maquinas m ON s.maquina_id=m.id LEFT JOIN clientes c ON s.cliente_id=c.id ORDER BY s.id DESC");
while($r = $res->fetch_assoc()){
    echo '<tr>';
    echo '<td>'.$r['id'].'</td>';
    echo '<td>'.htmlentities($r['tipo']).'</td>';
    echo '<td>'.htmlentities($r['descricao']).'</td>';
    echo '<td>'.$r['data_servico'].'</td>';
    echo '<td>'.htmlentities($r['maquina']).'</td>';
    echo '<td>'.htmlentities($r['cliente']).'</td>';
    echo '<td><a href="editar.php?id='.$r['id'].'">Editar</a> | <a href="excluir.php?id='.$r['id'].'" onclick="return confirm(\'Excluir?\')">Excluir</a></td>';
    echo '</tr>';
}
?>
</table>
</body></html>
