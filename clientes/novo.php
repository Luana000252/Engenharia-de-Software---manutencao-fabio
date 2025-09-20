<?php
session_start(); if(!isset($_SESSION['user'])) { header('Location: ../login.php'); exit; }
include("../db.php");
if($_POST){
    $nome = $conn->real_escape_string($_POST['nome']);
    $contato = $conn->real_escape_string($_POST['contato']);
    $endereco = $conn->real_escape_string($_POST['endereco']);
    $conn->query("INSERT INTO clientes (nome,contato,endereco) VALUES ('$nome','$contato','$endereco')");
    header('Location: index.php'); exit;
}
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Novo Cliente</title></head><body>
<h1>Novo Cliente</h1>
<form method="post">
Nome: <input type="text" name="nome" required><br>
Contato: <input type="text" name="contato"><br>
Endereço: <input type="text" name="endereco"><br>
<button type="submit">Salvar</button>
</form>
<p><a href="index.php">Voltar</a></p>
</body></html>
