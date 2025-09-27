<?php
session_start(); 
if(!isset($_SESSION['user'])) { 
    header('Location: ../login.php'); 
    exit; 
}
include("../db.php");

$id = intval($_GET['id'] ?? 0);
if($id > 0) {
    // Verificar se coluna status existe
    $result = $conn->query("SHOW COLUMNS FROM servicos LIKE 'status'");
    
    if($result->num_rows == 0) {
        // Adicionar coluna se não existir
        $conn->query("ALTER TABLE servicos ADD COLUMN status ENUM('Pendente','Finalizado') DEFAULT 'Pendente'");
    }
    
    // Atualizar status
    $conn->query("UPDATE servicos SET status='Finalizado' WHERE id=$id");
}
header('Location: index.php');
exit;
?>