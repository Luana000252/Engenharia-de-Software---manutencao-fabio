<?php
session_start(); if(!isset($_SESSION['user'])) { header('Location: ../login.php'); exit; }
include("../db.php");
$labels = [];
$data = [];
$res = $conn->query("SELECT c.nome, COUNT(s.id) as total FROM clientes c LEFT JOIN servicos s ON s.cliente_id=c.id GROUP BY c.id");
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
  <title>Dashboard - Sistema de Manutenção</title>
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
        <h1>Dashboard</h1>
      </div>
      
      <div class="dashboard-stats">
        <?php
        $total_clientes = $conn->query("SELECT COUNT(*) as total FROM clientes")->fetch_assoc()['total'];
        $total_maquinas = $conn->query("SELECT COUNT(*) as total FROM maquinas")->fetch_assoc()['total'];
        $total_servicos = $conn->query("SELECT COUNT(*) as total FROM servicos")->fetch_assoc()['total'];
        try {
            $total_finalizados = $conn->query("SELECT COUNT(*) as total FROM servicos WHERE status='Finalizado'")->fetch_assoc()['total'];
        } catch(Exception $e) {
            $total_finalizados = 0;
        }
        
        $preventivas = $conn->query("SELECT COUNT(*) as total FROM servicos WHERE tipo='Preventiva'")->fetch_assoc()['total'];
        $corretivas = $conn->query("SELECT COUNT(*) as total FROM servicos WHERE tipo='Corretiva'")->fetch_assoc()['total'];
        ?>
        <div class="stat-card">
          <div class="stat-number"><?php echo $total_clientes; ?></div>
          <div class="stat-label">Clientes</div>
        </div>
        <div class="stat-card">
          <div class="stat-number"><?php echo $total_maquinas; ?></div>
          <div class="stat-label">Máquinas</div>
        </div>
        <div class="stat-card">
          <div class="stat-number"><?php echo $total_servicos; ?></div>
          <div class="stat-label">Serviços</div>
        </div>
      </div>
      
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px; margin-bottom: 30px;">
        <a href="finalizados.php" class="nav-item" style="text-decoration: none;">
          <h3>Serviços Finalizados</h3>
          <div style="font-size: 2rem; font-weight: 700; color: #48bb78; margin: 10px 0;"><?php echo $total_finalizados; ?></div>
          <p>Ver detalhes dos serviços concluídos</p>
        </a>
        <a href="tipos.php" class="nav-item" style="text-decoration: none;">
          <h3>Tipos de Serviços</h3>
          <div style="font-size: 1.2rem; color: #667eea; margin: 10px 0;"><?php echo $preventivas; ?> Preventivas | <?php echo $corretivas; ?> Corretivas</div>
          <p>Comparativo entre preventivas e corretivas</p>
        </a>
      </div>
      
      <div class="table-container">
        <div style="padding: 30px;">
          <h3 style="margin-bottom: 25px; color: #4a5568; font-weight: 600; font-size: 1.1rem;">Serviços por Cliente (Geral)</h3>
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
      type: 'bar',
      data: {
          labels: labels,
          datasets: [{ 
              label: 'Serviços por Cliente', 
              data: data,
              backgroundColor: 'rgba(102, 126, 234, 0.8)',
              borderColor: '#667eea',
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
          },
          scales: {
              y: {
                  beginAtZero: true,
                  ticks: {
                      color: '#4a5568'
                  }
              },
              x: {
                  ticks: {
                      color: '#4a5568'
                  }
              }
          }
      }
  });
  </script>
</body>
</html>
