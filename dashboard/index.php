<?php
session_start(); if(!isset($_SESSION['user'])) { header('Location: ../login.php'); exit; }
include("../db.php");
$labels = [];
$data = [];
$res = $conn->query("SELECT c.nome, COUNT(s.id) as total FROM clientes c LEFT JOIN servicos s ON s.cliente_id=c.id GROUP BY c.id");
while($r = $res->fetch_assoc()){
    $labels[] = $r['nome'];
    $data[] = (int)$r['total'];
}
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Dashboard</title></head><body>
<h1>Dashboard</h1>
<p><a href="../index.php">Voltar</a></p>
<canvas id="chart" width="600" height="300"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = <?php echo json_encode($labels); ?>;
const data = <?php echo json_encode($data); ?>;
const ctx = document.getElementById('chart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{ label: 'Serviços por Cliente', data: data }]
    }
});
</script>
</body></html>
