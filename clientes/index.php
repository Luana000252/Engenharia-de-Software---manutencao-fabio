<?php
session_start(); if(!isset($_SESSION['user'])) { header('Location: ../login.php'); exit; }
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clientes - Sistema de Manutenção</title>
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
      <div class="card">
      <div class="header">
        <h1>Gerenciar Clientes</h1>
      </div>
      
      <div style="margin-bottom: 25px;">
<a href="novo.php" class="btn">+ Novo Cliente</a>
      </div>
      
      <div class="table-container">
        <table class="table">
          <thead>
            <tr><th>ID</th><th>Nome</th><th>Contato</th><th>Endereço</th><th>Ações</th></tr>
          </thead>
          <tbody>
<?php
$res = $conn->query("SELECT * FROM clientes ORDER BY id DESC");
while($r = $res->fetch_assoc()){
    echo '<tr>';
    echo '<td>'.$r['id'].'</td>';
    echo '<td>'.htmlentities($r['nome']).'</td>';
    echo '<td>'.htmlentities($r['contato']).'</td>';
    echo '<td>'.htmlentities($r['endereco']).'</td>';
    echo '<td>';
    echo '<a href="editar.php?id='.$r['id'].'" class="btn" style="margin-right: 10px; padding: 8px 15px; font-size: 0.8rem;">Editar</a>';
    echo '<a href="excluir.php?id='.$r['id'].'" class="btn btn-danger" style="padding: 8px 15px; font-size: 0.8rem;" onclick="return confirm(\'Tem certeza que deseja excluir este cliente?\')">Excluir</a>';
    echo '</td>';
    echo '</tr>';
}
?>
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
