<?php
include('../includes/db.php');

$query = "SELECT * FROM filmes";
$filmes = $conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Assentos - CinePoa</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header>
    <div class="logo">
        <h1>CinePoa</h1>
    </div>
</header>


<div class="filmes">
    <?php foreach($filmes as $filme): ?>
        <div class="filme">
            <img src="../images/<?php echo $filme['imagem']; ?>" alt="<?php echo $filme['nome']; ?>">
            <h2><?php echo $filme['nome']; ?></h2>
            <p><?php echo $filme['descricao']; ?></p>
            <a href="reserva.php?filme_id=<?php echo $filme['id']; ?>">Reservar Assento</a>
        </div>
    <?php endforeach; ?>
</div>
<footer>
    <div class="footer-content">
        <p>&copy; 2024 CinePoa . Todos os direitos reservados.</p>
    </div>
</footer>

</body>
</html>
