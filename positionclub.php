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
    
   // Requête basique
$sql = "SELECT idclub, nomcourt, nbpoints, butsmarques, butsencaises 
FROM club ORDER BY nbpoints DESC";
$stmt = $conn->query($sql);

$position = 1;
while ($row = $stmt->fetch()) {
echo '<tr>';
echo '<td>'.$position.'</td>';
echo '<td><img src="assets/imgs/'.strtolower($row['nomcourt']).'.png" class="team-logo"> '.$row['nomcourt'].'</td>';
echo '<td>'.$row['nbpoints'].'</td>';
echo '<td>'.($row['butsmarques'] - $row['butsencaises']).'</td>';
// ... autres colonnes ...
echo '</tr>';
$position++;
}
?>