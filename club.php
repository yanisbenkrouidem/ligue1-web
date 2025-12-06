<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'bdfoot2benkrouidembelkhiri';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si un ID de club est passé en paramètre
    if (!isset($_GET['idclub']) || empty($_GET['idclub'])) {
        die("Club introuvable !");
    }

    $idclub = intval($_GET['idclub']);

    // Récupérer les infos du club
    $query = "SELECT * FROM club WHERE idclub = :idclub";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['idclub' => $idclub]);
    $club = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$club) {
        die("Club non trouvé !");
    }
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($club['nomcourt']); ?> - Détails</title>
    <style>
        body {
            background: #0e0e0e;
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
            padding: 40px 20px;
            text-align: center;
        }

        h1 {
            font-size: 2.5em;
        }

        .club-info {
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 12px;
            width: 50%;
            margin: auto;
            box-shadow: 0 0 10px rgba(255,255,255,0.2);
        }

        img.logo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h1><?php echo htmlspecialchars($club['nomcourt']); ?></h1>
    <div class="club-info">
        <img class="logo" src="images/<?php echo htmlspecialchars($club['logo']); ?>" alt="Logo du club">
        <p><strong>Nom :</strong> <?php echo htmlspecialchars($club['nomlong']); ?></p>
        <p><strong>Fondation:</strong> <?php echo htmlspecialchars($club['fondation']); ?></p>
        <p><strong>Président:</strong> <?php echo htmlspecialchars($club['president']); ?></p>
        <p><strong>Entraîneur:</strong> <?php echo htmlspecialchars($club['entraineur']); ?></p>
        <p><strong>Site web:</strong> <a href="<?php echo htmlspecialchars($club['site']); ?>" target="_blank">Visiter</a></p>
        <p><strong>Points:</strong> <?php echo htmlspecialchars($club['nbpoints']); ?></p>
        <p><strong>Buts marqués:</strong> <?php echo htmlspecialchars($club['butsmarques']); ?></p>
        <p><strong>Buts encaissés:</strong> <?php echo htmlspecialchars($club['butsencaisses']); ?></p>
    </div>
    <a class="back-link" href="saison.php">Retour au classement</a>
</body>
</html>
