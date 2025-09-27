<?php
session_start(); if(!isset($_SESSION['user'])) { header('Location: ../login.php'); exit; }
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Serviços - Sistema de Manutenção</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
  <div class="sidebar">
    <div class="sidebar-logo">
      <img src="../imagens/Logo basico - Art Deco.png" alt="Logo">
<h3>Sistema de<br>Manutenção</h3>
    </div>
    <ul class="sidebar-menu">
      <li><a href="../index.php">Início</a></li>
      <li><a href="../clientes/index.php">Clientes</a></li>
      <li><a href="../maquinas/index.php">Máquinas</a></li>
      <li><a href="../servicos/index.php" class="active">Serviços</a></li>
      <li><a href="../dashboard/index.php">Dashboard</a></li>
    </ul>
    <div class="sidebar-user">
      <p>Usuário: <strong><?php echo htmlentities($_SESSION['user']); ?></strong></p>
<a href="../logout.php">Sair</a>
    </div>
  </div>
  
  <div class="main-content">
    <div class="container-with-sidebar">
      <div class="header">
        <h1>Gerenciar Serviços</h1>
      </div>
      
      <div style="margin-bottom: 25px;">
        <a href="novo.php" class="btn">+ Registrar Serviço</a>
      </div>
      
      <div class="table-container">
        <table class="table">
          <thead>
            <tr><th>ID</th><th>Tipo</th><th>Descrição</th><th>Data</th><th>Máquina</th><th>Cliente</th><th>Status</th><th>Ações</th></tr>
          </thead>
          <tbody>
<?php
$res = $conn->query("SELECT s.*, m.tipo as maquina, c.nome as cliente FROM servicos s LEFT JOIN maquinas m ON s.maquina_id=m.id LEFT JOIN clientes c ON s.cliente_id=c.id ORDER BY s.id DESC");
while($r = $res->fetch_assoc()){
    echo '<tr>';
    echo '<td>'.$r['id'].'</td>';
    echo '<td><span style="background: '.($r['tipo']=='Preventiva'?'#48bb78':'#ed8936').'; color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem;">'.htmlentities($r['tipo']).'</span></td>';
    echo '<td>'.htmlentities(substr($r['descricao'], 0, 50)).(strlen($r['descricao']) > 50 ? '...' : '').'</td>';
    echo '<td>'.($r['data_servico'] ? date('d/m/Y', strtotime($r['data_servico'])) : 'Não informado').'</td>';
    echo '<td>'.htmlentities($r['maquina']).'</td>';
    echo '<td>'.htmlentities($r['cliente']).'</td>';
    
    $status = $r['status'] ?? 'Pendente';
    echo '<td><span style="background: '.($status=='Finalizado'?'#48bb78':'#ffa500').'; color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem;">'.$status.'</span></td>';
    
    echo '<td>';

    // Mostrar botão finalizar apenas se for pendente
    if(($r['status'] ?? 'Pendente') == 'Pendente') {
        echo '<a href="finalizar.php?id='.$r['id'].'" class="btn" style="margin-right: 5px; padding: 6px 12px; font-size: 0.75rem; background: #407355ff;">Finalizar</a>';
    }
    
    echo '<a href="editar.php?id='.$r['id'].'" class="btn" style="margin-right: 5px; padding: 6px 12px; font-size: 0.75rem;">Editar</a>';
    echo '<a href="excluir.php?id='.$r['id'].'" class="btn btn-danger" style="padding: 6px 12px; font-size: 0.75rem;" onclick="return confirm(\'Tem certeza que deseja excluir este serviço?\')">Excluir</a>';
    echo '</td>';
    echo '</tr>';
}
?>
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
