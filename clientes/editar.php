<?php
session_start(); if(!isset($_SESSION['user'])) { header('Location: ../login.php'); exit; }
include("../db.php");
$id = intval($_GET['id'] ?? 0);
if($_POST){
    $nome = $conn->real_escape_string($_POST['nome']);
    $contato = $conn->real_escape_string($_POST['contato']);
    $endereco = $conn->real_escape_string($_POST['endereco']);
    $conn->query("UPDATE clientes SET nome='$nome', contato='$contato', endereco='$endereco' WHERE id=$id");
    header('Location: index.php'); exit;
}
$res = $conn->query("SELECT * FROM clientes WHERE id=$id");
$row = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Cliente - Sistema de Manutenção</title>
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
      <li><a href="../clientes/index.php" class="active">Clientes</a></li>
      <li><a href="../maquinas/index.php">Máquinas</a></li>
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
        <h1>Editar Cliente</h1>
      </div>
      
      <form method="post">
        <div class="form-group">
          <label for="nome">Nome *</label>
          <input type="text" name="nome" id="nome" class="form-control" value="<?php echo htmlentities($row['nome']); ?>" required>
        </div>
        
        <div class="form-group">
          <label for="contato">Contato</label>
          <input type="text" name="contato" id="contato" class="form-control" value="<?php echo htmlentities($row['contato']); ?>">
        </div>
        
        <div class="form-group">
          <label for="endereco">Endereço</label>
          <input type="text" name="endereco" id="endereco" class="form-control" value="<?php echo htmlentities($row['endereco']); ?>">
        </div>
        
        <div style="margin-top: 30px;">
          <button type="submit" class="btn">Salvar Alterações</button>
          <a href="index.php" class="btn" style="margin-left: 10px; background: #6c757d;">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
