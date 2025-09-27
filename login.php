<?php
session_start();
if(isset($_SESSION['user'])) {
    header('Location: index.php'); exit;
}
$message = '';
if($_POST){
    $u = $_POST['usuario'] ?? '';
    $p = $_POST['senha'] ?? '';
    include 'db.php';
    $stmt = $conn->prepare('SELECT senha FROM usuarios WHERE usuario = ? LIMIT 1');
    $stmt->bind_param('s',$u);
    $stmt->execute();
    $stmt->bind_result($hash);
    if($stmt->fetch()){
        // plain-text compare for simplicity in this educational project
        if($p === $hash){
            $_SESSION['user'] = $u;
            header('Location: index.php'); exit;
        } else {
            $message = 'Usuário ou senha inválidos';
        }
    } else {
        $message = 'Usuário ou senha inválidos';
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Sistema de Manutenção</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="login-container">
    <div class="login-card">
      <div style="text-align: center; margin-bottom: 30px;">
        <img src="imagens/Apresentacao.png" alt="Logo" style="max-width: 200px; height: auto;">
      </div>
<h2 class="login-title">Sistema de Manutenção</h2>
      <?php if($message) echo '<div class="alert alert-danger">'.htmlentities($message).'</div>'; ?>
      <form method="post">
        <div class="form-group">
<label for="usuario">Usuário</label>
          <input type="text" name="usuario" id="usuario" class="form-control" required>
        </div>
        <div class="form-group">
<label for="senha">Senha</label>
          <input type="password" name="senha" id="senha" class="form-control" required>
        </div>
<button type="submit" class="btn" style="width: 100%;">Entrar</button>
      </form>
    </div>
  </div>
</body>
</html>
