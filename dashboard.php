<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../php/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Ligue 1 McDonalds</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

    <header class="navbar">
        <div class="logo">Ligue 1® McDonalds</div>
        <nav>
            <ul>
                <li><a href="../php/classement.php">Classement</a></li>
                <li><a href="../php/resultatjournee.php">Résultats</a></li>
                <li><a href="../html/calendrier.html">Calendrier</a></li>
                <li><a href="../php/logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

    <main class="dashboard-content">
        <section class="welcome-section">
            <h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['user']); ?> 👋</h1>
            <p>Voici votre tableau de bord.</p>
        </section>

        <section class="cards-grid">
            <div class="card">
                <h2>Classement</h2>
                <p>Voir le classement en temps réel.</p>
                <a href="../php/classement.php">Voir →</a>
            </div>
            <div class="card">
                <h2>Résultats</h2>
                <p>Voir les résultats des dernières journées.</p>
                <a href="../php/resultatjournee.php">Voir →</a>
            </div>
            <div class="card">
                <h2>Calendrier</h2>
                <p>Consultez les prochains matchs.</p>
                <a href="../html/calendrier.html">Voir →</a>
            </div>
        </section>
    </main>

</body>
</html>
