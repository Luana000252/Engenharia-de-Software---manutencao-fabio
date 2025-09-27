<?php
include("db.php");

try {
    // Verificar se a coluna já existe
    $result = $conn->query("SHOW COLUMNS FROM servicos LIKE 'status'");
    
    if($result->num_rows == 0) {
        // Adicionar coluna status se não existir
        $conn->query("ALTER TABLE servicos ADD COLUMN status ENUM('Pendente','Finalizado') DEFAULT 'Pendente'");
        echo "Coluna 'status' adicionada com sucesso!<br>";
    } else {
        echo "Coluna 'status' já existe.<br>";
    }
    
    // Atualizar registros existentes sem status
    $conn->query("UPDATE servicos SET status='Pendente' WHERE status IS NULL OR status = ''");
    echo "Registros atualizados com sucesso!<br>";
    
    echo "<br><strong>Banco de dados atualizado! Agora você pode usar o sistema normalmente.</strong>";
    echo "<br><br><a href='servicos/index.php'>Ir para Serviços</a> | <a href='dashboard/index.php'>Ir para Dashboard</a>";
    
} catch(Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>