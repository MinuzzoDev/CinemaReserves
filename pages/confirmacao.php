<?php
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_cliente = $_POST['nome_cliente'];
    $filme_id = $_POST['filme_id'];
    $assento = $_POST['assento'];

    // adicionar reserva no banco de dados
    $query = "INSERT INTO reservas (nome_cliente, filme_id, assento) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$nome_cliente, $filme_id, $assento]);

    // mostrar mensagem de sucesso
    echo "<h1>Reserva Confirmada!</h1>";
    echo "<p>Obrigado, {$nome_cliente}! Seu assento {$assento} foi reservado para o filme.</p>";
} else {
    echo "<p>Erro ao processar a reserva.</p>";
}
?>
