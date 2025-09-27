<?php
session_start();
if(!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Manutenção - Início</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="container">
    <div class="header">
      <div style="margin-bottom: 20px;">
        <img src="imagens/Logo basico - Art Deco.png" alt="Logo" style="max-width: 80px; height: auto;">
      </div>
      <h1>Sistema de Manutenção</h1>
      <p style="font-size: 1.1rem; color: rgba(255,255,255,0.9); margin-top: 15px;">Bem-vindo, <strong><?php echo htmlentities($_SESSION['user']); ?></strong></p>
    </div>
      
      <div class="nav-grid">
        <a href="clientes/index.php" class="nav-item">
          <h3>Clientes</h3>
          <p>Gerenciar clientes</p>
        </a>
        <a href="maquinas/index.php" class="nav-item">
          <h3>Máquinas</h3>
          <p>Gerenciar máquinas</p>
        </a>
        <a href="servicos/index.php" class="nav-item">
          <h3>Serviços</h3>
          <p>Gerenciar serviços</p>
        </a>
        <a href="dashboard/index.php" class="nav-item">
          <h3>Dashboard</h3>
          <p>Relatórios e gráficos</p>
        </a>
      </div>
      
      <div style="text-align: center; margin-top: 40px;">
<a href="logout.php" class="btn btn-danger">Sair do Sistema</a>
      </div>
    </div>
  </div>
</body>
</html>
