<?php
session_start(); if(!isset($_SESSION['user'])) { header('Location: ../login.php'); exit; }
include("../db.php");

$preventivas = $conn->query("SELECT COUNT(*) as total FROM servicos WHERE tipo='Preventiva'")->fetch_assoc()['total'];
$corretivas = $conn->query("SELECT COUNT(*) as total FROM servicos WHERE tipo='Corretiva'")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tipos de Serviços - Sistema de Manutenção</title>
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
        <h1>Tipos de Serviços</h1>
      </div>
      
      <div style="margin-bottom: 25px;">
        <a href="index.php" class="btn">← Voltar ao Dashboard</a>
      </div>
      
      <div class="dashboard-stats">
        <div class="stat-card">
          <div class="stat-number"><?php echo $preventivas; ?></div>
          <div class="stat-label">Preventivas</div>
        </div>
        <div class="stat-card">
          <div class="stat-number"><?php echo $corretivas; ?></div>
          <div class="stat-label">Corretivas</div>
        </div>
        <div class="stat-card">
          <div class="stat-number"><?php echo $preventivas + $corretivas; ?></div>
          <div class="stat-label">Total</div>
        </div>
      </div>
      
      <div class="table-container">
        <div style="padding: 30px;">
          <h3 style="margin-bottom: 25px; color: #4a5568; font-weight: 600; font-size: 1.1rem;">Comparativo: Preventivas vs Corretivas</h3>
          <canvas id="chart" width="600" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
  const ctx = document.getElementById('chart').getContext('2d');
  new Chart(ctx, {
      type: 'bar',
      data: {
          labels: ['Preventivas', 'Corretivas'],
          datasets: [{ 
              label: 'Quantidade de Serviços', 
              data: [<?php echo $preventivas; ?>, <?php echo $corretivas; ?>],
              backgroundColor: ['#48bb78', '#ed8936'],
              borderColor: ['#48bb78', '#ed8936'],
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