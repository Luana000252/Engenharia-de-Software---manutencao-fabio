<?php
session_start(); if(!isset($_SESSION['user'])) { header('Location: ../login.php'); exit; }
include("../db.php");
$id = intval($_GET['id'] ?? 0);
$clientes = $conn->query("SELECT id,nome FROM clientes ORDER BY nome");
if($_POST){
    $tipo = $conn->real_escape_string($_POST['tipo']);
    $modelo = $conn->real_escape_string($_POST['modelo']);
    $ultima = $_POST['ultima_manutencao'] ? "'".$conn->real_escape_string($_POST['ultima_manutencao'])."'" : "NULL";
    $cliente_id = intval($_POST['cliente_id']);
    $conn->query("UPDATE maquinas SET tipo='$tipo', modelo='$modelo', ultima_manutencao=$ultima, cliente_id=$cliente_id WHERE id=$id");
    header('Location: index.php'); exit;
}
$res = $conn->query("SELECT * FROM maquinas WHERE id=$id");
$row = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Máquina - Sistema de Manutenção</title>
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
        <h1>Editar Máquina</h1>
      </div>
      
      <form method="post">
        <div class="form-group">
          <label for="tipo">Tipo *</label>
          <input type="text" name="tipo" id="tipo" class="form-control" value="<?php echo htmlentities($row['tipo']); ?>" required>
        </div>
        
        <div class="form-group">
          <label for="modelo">Modelo</label>
          <input type="text" name="modelo" id="modelo" class="form-control" value="<?php echo htmlentities($row['modelo']); ?>">
        </div>
        
        <div class="form-group">
          <label for="ultima_manutencao">Última Manutenção</label>
          <input type="date" name="ultima_manutencao" id="ultima_manutencao" class="form-control" value="<?php echo $row['ultima_manutencao']; ?>">
        </div>
        
        <div class="form-group">
          <label for="cliente_id">Cliente</label>
          <select name="cliente_id" id="cliente_id" class="form-control">
            <?php while($c = $clientes->fetch_assoc()){ $sel = ($c['id']==$row['cliente_id'])?'selected':''; echo '<option value="'.$c['id'].'" '.$sel.'>'.htmlentities($c['nome']).'</option>'; } ?>
          </select>
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
