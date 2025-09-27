<?php
session_start(); if(!isset($_SESSION['user'])) { header('Location: ../login.php'); exit; }
include("../db.php");

$labels = [];
$data = [];
$res = $conn->query("SELECT c.nome, COUNT(s.id) as total FROM clientes c LEFT JOIN servicos s ON s.cliente_id=c.id WHERE COALESCE(s.status, 'Pendente')='Finalizado' GROUP BY c.id HAVING total > 0");
while($r = $res->fetch_assoc()){
    $labels[] = $r['nome'];
    $data[] = (int)$r['total'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Serviços Finalizados - Sistema de Manutenção</title>
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
      <li><a href="../servicos/index.php">Serviços</a></li>
      <li><a href="../dashboard/index.php" class="active">Dashboard</a></li>
    </ul>
    <div class="sidebar-user">
      <p>Usuário: <strong><?php echo htmlentities($_SESSION['user']); ?></strong></p>
      <a href="../logout.php">Sair</a>
    </div>
  </div>
  
  <div class="main-content">
    <div class="container-with-sidebar">
      <div class="header">
        <h1>Serviços Finalizados</h1>
      </div>
      
      <div style="margin-bottom: 25px;">
        <a href="index.php" class="btn">← Voltar ao Dashboard</a>
      </div>
      
      <div class="dashboard-stats">
        <?php
        $total_finalizados = $conn->query("SELECT COUNT(*) as total FROM servicos WHERE COALESCE(status, 'Pendente')='Finalizado'")->fetch_assoc()['total'];
        $total_pendentes = $conn->query("SELECT COUNT(*) as total FROM servicos WHERE COALESCE(status, 'Pendente')='Pendente'")->fetch_assoc()['total'];
        ?>
        <div class="stat-card">
          <div class="stat-number"><?php echo $total_finalizados; ?></div>
          <div class="stat-label">Finalizados</div>
        </div>
        <div class="stat-card">
          <div class="stat-number"><?php echo $total_pendentes; ?></div>
          <div class="stat-label">Pendentes</div>
        </div>
      </div>
      
      <div class="table-container">
        <div style="padding: 30px;">
          <h3 style="margin-bottom: 25px; color: #4a5568; font-weight: 600; font-size: 1.1rem;">Serviços Finalizados por Cliente</h3>
          <canvas id="chart" width="600" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
  const labels = <?php echo json_encode($labels); ?>;
  const data = <?php echo json_encode($data); ?>;
  const ctx = document.getElementById('chart').getContext('2d');
  new Chart(ctx, {
      type: 'doughnut',
      data: {
          labels: labels,
          datasets: [{ 
              label: 'Serviços Finalizados', 
              data: data,
              backgroundColor: ['#48bb78', '#667eea', '#ed8936', '#ff6b6b', '#38b2ac'],
              borderWidth: 2
          }]
      },
      options: {
          responsive: true,
          plugins: {
              legend: {
                  display: true,
                  labels: {
                      color: '#4a5568',
                      font: {
                          family: 'Inter',
                          weight: '600'
                      }
                  }
              }
          }
      }
  });
  </script>
</body>
</html>