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
<head><meta charset="utf-8"><title>Login</title></head>
<body>
  <h2>Login</h2>
  <?php if($message) echo '<p style="color:red;">'.htmlentities($message).'</p>'; ?>
  <form method="post">
    Usuário: <input type="text" name="usuario"><br>
    Senha: <input type="password" name="senha"><br>
    <button type="submit">Entrar</button>
  </form>
</body>
</html>
