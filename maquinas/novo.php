<?php
session_start(); if(!isset($_SESSION['user'])) { header('Location: ../login.php'); exit; }
include("../db.php");
$clientes = $conn->query("SELECT id,nome FROM clientes ORDER BY nome");
if($_POST){
    $tipo = $conn->real_escape_string($_POST['tipo']);
    $modelo = $conn->real_escape_string($_POST['modelo']);
    $ultima = $_POST['ultima_manutencao'] ? "'".$conn->real_escape_string($_POST['ultima_manutencao'])."'" : "NULL";
    $cliente_id = intval($_POST['cliente_id']);
    $conn->query("INSERT INTO maquinas (tipo,modelo,ultima_manutencao,cliente_id) VALUES ('$tipo','$modelo',$ultima,$cliente_id)");
    header('Location: index.php'); exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nova Máquina - Sistema de Manutenção</title>
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
      <li><a href="../maquinas/index.php" class="active">Máquinas</a></li>
      <li><a href="../servicos/index.php">Serviços</a></li>
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
        <h1>Nova Máquina</h1>
      </div>
      
      <form method="post">
        <div class="form-group">
          <label for="tipo">Tipo *</label>
          <input type="text" name="tipo" id="tipo" class="form-control" required>
        </div>
        
        <div class="form-group">
          <label for="modelo">Modelo</label>
          <input type="text" name="modelo" id="modelo" class="form-control">
        </div>
        
        <div class="form-group">
          <label for="ultima_manutencao">Última Manutenção</label>
          <input type="date" name="ultima_manutencao" id="ultima_manutencao" class="form-control">
        </div>
        
        <div class="form-group">
          <label for="cliente_id">Cliente</label>
          <select name="cliente_id" id="cliente_id" class="form-control">
            <option value="">Selecione um cliente</option>
            <?php while($c = $clientes->fetch_assoc()){ echo '<option value="'.$c['id'].'">'.htmlentities($c['nome']).'</option>'; } ?>
          </select>
        </div>
        
        <div style="margin-top: 35px;">
          <button type="submit" class="btn">Salvar Máquina</button>
          <a href="index.php" class="btn" style="margin-left: 15px; background: #6c757d;">Cancelar</a>
        </div>
      </form>
      </div>
    </div>
  </div>
</body>
</html>
