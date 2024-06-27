<?php
session_start();

$timeLimit = 30 * 60;

if (isset($_COOKIE['lastVisit'])) {
    $lastVisit = $_COOKIE['lastVisit'];
    $currentTime = time();

    // Verifica se o usuário já visitou recentemente
    if (($currentTime - $lastVisit) < $timeLimit) {
        $recentVisit = true;
    } else {
        $recentVisit = false;
    }
} else {
    $recentVisit = false;
}

// Define o cookie da última visita
setcookie('lastVisit', time(), time() + $timeLimit);

$filename = 'contador.txt';
if (!file_exists($filename)) {
    file_put_contents($filename, 0);
}

$counter = file_get_contents($filename);

// Incrementa o contador somente se não for uma visita recente
if (!$recentVisit) {
    $counter++;
    file_put_contents($filename, $counter);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de Phishing</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="https://images.emojiterra.com/google/noto-emoji/unicode-15.1/color/1024px/1f480.png">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: rgba(28, 28, 28, 0.95);
            color: #16cc16;
            font-family: 'Courier New', Courier, monospace;
            font-size: 3rem;
            text-align: center;
            text-shadow: 1px 1px 2px #000;
        }
        .message {
            border: 5px solid #16cc16;
            border-radius: 15px;
            padding: 20px;
            background-color: rgba(44, 44, 44, 0.8);
        }
        .bold {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="message text-center">
                    <?php if (!$recentVisit): ?>
                        <p class="bold">PARABÉNS</p>
                        <p>Você caiu em um teste de phishing!</p>
                    <?php endif; ?>
                    <p>Você é o visitante número <?php echo $counter; ?></p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>