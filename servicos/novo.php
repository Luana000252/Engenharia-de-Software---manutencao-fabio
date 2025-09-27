<?php
session_start(); if(!isset($_SESSION['user'])) { header('Location: ../login.php'); exit; }
include("../db.php");
$clientes = $conn->query("SELECT id,nome FROM clientes ORDER BY nome");
$maquinas = $conn->query("SELECT id, tipo, modelo FROM maquinas ORDER BY id DESC");
if($_POST){
    $tipo = $conn->real_escape_string($_POST['tipo']);
    $descricao = $conn->real_escape_string($_POST['descricao']);
    $data = $_POST['data_servico'] ? "'".$conn->real_escape_string($_POST['data_servico'])."'" : "NULL";
    $cliente_id = intval($_POST['cliente_id']);
    $maquina_id = intval($_POST['maquina_id']);
    $conn->query("INSERT INTO servicos (tipo,descricao,data_servico,cliente_id,maquina_id) VALUES ('$tipo','$descricao',$data,$cliente_id,$maquina_id)");
    header('Location: index.php'); exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Novo Serviço - Sistema de Manutenção</title>
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
        <h1>Registrar Serviço</h1>
      </div>
      
      <form method="post">
        <div class="form-group">
          <label for="tipo">Tipo de Serviço</label>
          <select name="tipo" id="tipo" class="form-control">
            <option value="Preventiva">Preventiva</option>
            <option value="Corretiva">Corretiva</option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="descricao">Descrição</label>
          <textarea name="descricao" id="descricao" class="form-control" rows="4" placeholder="Descreva o serviço realizado..."></textarea>
        </div>
        
        <div class="form-group">
          <label for="data_servico">Data do Serviço</label>
          <input type="date" name="data_servico" id="data_servico" class="form-control">
        </div>
        
        <div class="form-group">
          <label for="cliente_id">Cliente</label>
          <select name="cliente_id" id="cliente_id" class="form-control">
            <option value="">Selecione um cliente</option>
            <?php while($c = $clientes->fetch_assoc()){ echo '<option value="'.$c['id'].'">'.htmlentities($c['nome']).'</option>'; } ?>
          </select>
        </div>
        
        <div class="form-group">
          <label for="maquina_id">Máquina</label>
          <select name="maquina_id" id="maquina_id" class="form-control">
            <option value="">Selecione uma máquina</option>
            <?php while($m = $maquinas->fetch_assoc()){ echo '<option value="'.$m['id'].'">'.htmlentities($m['tipo'].' - '. $m['modelo']).'</option>'; } ?>
          </select>
        </div>
        
        <div style="margin-top: 35px;">
          <button type="submit" class="btn">Salvar Serviço</button>
          <a href="index.php" class="btn" style="margin-left: 15px; background: #6c757d;">Cancelar</a>
        </div>
      </form>
      </div>
    </div>
  </div>
</body>
</html>
