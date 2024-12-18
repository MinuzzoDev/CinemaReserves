<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Reserva</title>
    <link rel="stylesheet" href="../assets/css/confirmation_style.css">
</head>
<body>
    <div class="container">
        <h1>Reserva Confirmada!</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nome_cliente = htmlspecialchars($_POST["nome_cliente"]);
            $filme_id = intval($_POST["filme_id"]);
            $assentos = isset($_POST["seats"]) ? $_POST["seats"] : [];

            // connect com db
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "cinema_reservas";

            // criar connect
            $conn = new mysqli($servername, $username, $password, $dbname);

            // se tiver erro de conexao
            if ($conn->connect_error) {
                die("Falha na conexão: " . $conn->connect_error);
            }

            // nome do filme de acordo com a id dele
            $stmt = $conn->prepare("SELECT nome FROM filmes WHERE id = ?");
            $stmt->bind_param("i", $filme_id);
            $stmt->execute();
            $stmt->bind_result($nome_filme);
            $stmt->fetch();
            $stmt->close();

            // ver quais assentos disponiveis
            $unavailableSeats = [];
            foreach ($assentos as $assento) {
                $stmt = $conn->prepare("SELECT COUNT(*) FROM reserva WHERE assento = ? AND filme_id = ?");
                $stmt->bind_param("si", $assento, $filme_id);
                $stmt->execute();
                $stmt->bind_result($count);
                $stmt->fetch();
                $stmt->close();

                if ($count > 0) {
                    $unavailableSeats[] = $assento;
                }
            }

            if (!empty($unavailableSeats)) {
                echo "<p><strong>Erro:</strong> Os seguintes assentos já estão reservados: " . implode(", ", $unavailableSeats) . "</p>";
            } else {
                // se tiver disponivel, ele reserva o assento
                foreach ($assentos as $assento) {
                    $stmt = $conn->prepare("INSERT INTO reserva (nome_cliente, filme_id, assento, data_reserva) VALUES (?, ?, ?, NOW())");
                    $stmt->bind_param("sis", $nome_cliente, $filme_id, $assento);
                    $stmt->execute();
                    $stmt->close();
                }

                echo "<p><strong>Nome do Cliente:</strong> $nome_cliente</p>";
                echo "<p><strong>Filme Escolhido:</strong> $nome_filme</p>";
                echo "<p><strong>Assentos Reservados:</strong> " . implode(", ", $assentos) . "</p>";
            }

            $conn->close();
        } else {
            echo "<p>Erro ao processar a reserva.</p>";
        }
        ?>
        <a href="index.php" class="btn">Voltar para a seleção</a>
    </div>
</body>
</html>
