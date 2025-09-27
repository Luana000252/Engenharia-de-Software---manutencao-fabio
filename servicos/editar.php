<?php
session_start(); if(!isset($_SESSION['user'])) { header('Location: ../login.php'); exit; }
include("../db.php");
$id = intval($_GET['id'] ?? 0);
$clientes = $conn->query("SELECT id,nome FROM clientes ORDER BY nome");
$maquinas = $conn->query("SELECT id, tipo, modelo FROM maquinas ORDER BY id DESC");
if($_POST){
    $tipo = $conn->real_escape_string($_POST['tipo']);
    $descricao = $conn->real_escape_string($_POST['descricao']);
    $data = $_POST['data_servico'] ? "'".$conn->real_escape_string($_POST['data_servico'])."'" : "NULL";
    $cliente_id = intval($_POST['cliente_id']);
    $maquina_id = intval($_POST['maquina_id']);
    $conn->query("UPDATE servicos SET tipo='$tipo', descricao='$descricao', data_servico=$data, cliente_id=$cliente_id, maquina_id=$maquina_id WHERE id=$id");
    header('Location: index.php'); exit;
}
$res = $conn->query("SELECT * FROM servicos WHERE id=$id");
$row = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Serviço - Sistema de Manutenção</title>
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
        <h1>Editar Serviço</h1>
      </div>
      
      <form method="post">
        <div class="form-group">
          <label for="tipo">Tipo de Serviço</label>
          <select name="tipo" id="tipo" class="form-control">
            <option value="Preventiva" <?php if($row['tipo']=='Preventiva') echo 'selected'; ?>>Preventiva</option>
            <option value="Corretiva" <?php if($row['tipo']=='Corretiva') echo 'selected'; ?>>Corretiva</option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="descricao">Descrição</label>
          <textarea name="descricao" id="descricao" class="form-control" rows="4"><?php echo htmlentities($row['descricao']); ?></textarea>
        </div>
        
        <div class="form-group">
          <label for="data_servico">Data do Serviço</label>
          <input type="date" name="data_servico" id="data_servico" class="form-control" value="<?php echo $row['data_servico']; ?>">
        </div>
        
        <div class="form-group">
          <label for="cliente_id">Cliente</label>
          <select name="cliente_id" id="cliente_id" class="form-control">
            <?php while($c = $clientes->fetch_assoc()){ $sel = ($c['id']==$row['cliente_id'])?'selected':''; echo '<option value="'.$c['id'].'" '.$sel.'>'.htmlentities($c['nome']).'</option>'; } ?>
          </select>
        </div>
        
        <div class="form-group">
          <label for="maquina_id">Máquina</label>
          <select name="maquina_id" id="maquina_id" class="form-control">
            <?php while($m = $maquinas->fetch_assoc()){ $sel = ($m['id']==$row['maquina_id'])?'selected':''; echo '<option value="'.$m['id'].'" '.$sel.'>'.htmlentities($m['tipo'].' - '. $m['modelo']).'</option>'; } ?>
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
