<?php
include("db.php");

echo "<h2>Criando coluna 'status' na tabela servicos...</h2>";

try {
    // Adicionar coluna status
    $conn->query("ALTER TABLE servicos ADD COLUMN status ENUM('Pendente','Finalizado') DEFAULT 'Pendente'");
    echo "<p style='color: green;'>✅ Coluna 'status' criada com sucesso!</p>";
    
    // Atualizar registros existentes
    $conn->query("UPDATE servicos SET status='Pendente' WHERE status IS NULL");
    echo "<p style='color: green;'>✅ Registros existentes atualizados!</p>";
    
    echo "<br><strong>Pronto! Agora você pode usar o botão 'Finalizar' nos serviços.</strong>";
    echo "<br><br><a href='servicos/index.php' style='background: #667eea; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Ir para Serviços</a>";
    
} catch(Exception $e) {
    if(strpos($e->getMessage(), 'Duplicate column name') !== false) {
        echo "<p style='color: orange;'>⚠️ Coluna 'status' já existe!</p>";
        echo "<br><a href='servicos/index.php' style='background: #667eea; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Ir para Serviços</a>";
    } else {
        echo "<p style='color: red;'>❌ Erro: " . $e->getMessage() . "</p>";
    }
}
?>