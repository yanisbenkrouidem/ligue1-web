<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'bdfoot2benkrouidembelkhiri';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
    // Requête pour récupérer les commentaires/actualités les plus récents
    $sql = "SELECT c.idcom, c.datecom, c.textecom, u.pseudouti 
            FROM commentaire c
            JOIN utilisateur u ON c.idutil = u.idutil
            ORDER BY c.datecom DESC
            LIMIT 10";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="news-item">';
        echo '<div class="news-source">' . strtoupper($row['pseudouti']) . '</div>';
        echo '<div class="news-title">' . substr($row['textecom'], 0, 50) . '...</div>';
        echo '</div>';
    }
} catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

$conn = null;
?>