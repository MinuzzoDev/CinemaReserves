<?php
// connect com o db
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema_reservas";

$conn = new mysqli($servername, $username, $password, $dbname);

// connect sucess
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// recupera o id do filme com a url 
$filme_id = isset($_GET['filme_id']) ? intval($_GET['filme_id']) : 1; // default para 1 se não tiver filme_id na url

// nome do filme de acordo com a id dele
$stmt = $conn->prepare("SELECT nome FROM filmes WHERE id = ?");
$stmt->bind_param("i", $filme_id);
$stmt->execute();
$stmt->bind_result($nome_filme);
$stmt->fetch();
$stmt->close();

// busca os assentos ocupados pro filme
$occupiedSeats = [];
$sql = "SELECT assento FROM reserva WHERE filme_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $filme_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $occupiedSeats[] = $row['assento'];
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Assentos - <?php echo htmlspecialchars($nome_filme); ?></title>
    <link rel="stylesheet" href="../assets/css/reserva.css">
    <script>
        function selectSeat(seat) {
            if (!seat.classList.contains('occupied')) {
                seat.classList.toggle('selected');
                const checkbox = seat.querySelector('input');
                checkbox.checked = !checkbox.checked;
            }
        }
    </script>
</head>
<body>
    <h1>Escolha seus Assentos para: <?php echo htmlspecialchars($nome_filme); ?></h1>
    <div class="screen">Tela</div>
    <form method="POST" action="process_reservation.php">
        <input type="text" name="nome_cliente" placeholder="Seu nome" required>
        <input type="hidden" name="filme_id" value="<?php echo $filme_id; ?>">

        <?php
        // assentos disponíveis para o filme
        $rows = ['O', 'N', 'M', 'L', 'K', 'J', 'I', 'H', 'G', 'F', 'E', 'D', 'C', 'B', 'A'];

        foreach ($rows as $row) {
            echo '<div class="row">';
            for ($col = 1; $col <= 14; $col++) {
                $seatId = $row . $col;
                $isOccupied = in_array($seatId, $occupiedSeats); // verifica se o assento está ocupado
                $class = $isOccupied ? 'seat occupied' : 'seat';
                echo "<div class='$class' onclick='selectSeat(this)'>";
                if (!$isOccupied) {
                    echo "<input type='checkbox' name='seats[]' value='$seatId' hidden>";
                }
                echo "</div>";
            }
            echo '</div>';
        }
        ?>

        <button type="submit">Reservar</button>
    </form>
</body>
</html>

<?php $conn->close(); ?>
