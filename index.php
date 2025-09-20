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
  <title>Sistema de Manutenção - Início</title>
</head>
<body>
  <h1>Sistema de Manutenção - Bem-vindo, <?php echo htmlentities($_SESSION['user']); ?></h1>
  <ul>
    <li><a href="clientes/index.php">Gerenciar Clientes</a></li>
    <li><a href="maquinas/index.php">Gerenciar Máquinas</a></li>
    <li><a href="servicos/index.php">Gerenciar Serviços</a></li>
    <li><a href="dashboard/index.php">Dashboard</a></li>
    <li><a href="logout.php">Sair</a></li>
  </ul>
</body>
</html>
