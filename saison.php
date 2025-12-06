<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'bdfoot2benkrouidembelkhiri';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "
        SELECT 
            c.idclub,
            c.nomcourt,
            c.logo,
            c.nbpoints,
            c.butsmarques,
            c.butsencaisses,
            (c.butsmarques - c.butsencaisses) AS diffbuts
        FROM club c
        ORDER BY c.nbpoints DESC, diffbuts DESC
    ";
    $stmt = $pdo->query($query);
    $clubs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Classement Ligue 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            color: #fff;
            background: url('images/wee.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .overlay {
            padding: 40px 20px;
            background: rgba(0, 0, 0, 0.6);
            min-height: 100vh;
            backdrop-filter: blur(5px);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5em;
            animation: fadeIn 1s ease-out;
        }

        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            overflow: hidden;
            backdrop-filter: blur(8px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }

        th, td {
            padding: 14px 12px;
            text-align: center;
        }

        th {
            background-color: rgba(255,255,255,0.1);
            text-transform: uppercase;
            font-size: 0.9em;
            letter-spacing: 1px;
        }

        tr {
            transition: background 0.3s ease;
        }

        tr:hover {
            background: rgba(255,255,255,0.08);
        }

        img.logo {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            vertical-align: middle;
        }

        td.club-name {
            text-align: left;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .champions {
            border-left: 6px solid #4FC3F7;
        }

        .barrage {
            border-left: 6px solid #FF9800;
        }

        .relegation {
            border-left: 6px solid #E57373;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        /* Navbar */
        .brand-circle {
            width: 35px;
            height: 35px;
            background-color: black;
            color: #fff;
            font-weight: bold;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            margin-right: 10px;
        }

        .nav-link:hover {
            text-decoration: underline;
        }

        .dropdown img {
            border-radius: 50%;
        }

        nav.navbar {
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(6px);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm px-4 fixed-top">
    <a class="navbar-brand" href="#">
        <div class="brand-circle">L</div>
        <span class="fw-bold text-white">Ligue 1</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-3">
            <li class="nav-item"><a class="nav-link active" href="classement.php">Accueil</a></li>
            <li class="nav-item"><a class="nav-link" href="saison.php">Classement</a></li>
            <li class="nav-item"><a class="nav-link" href="journee.php">Journée</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Calendrier</a></li>
        </ul>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Chercher..." aria-label="Search">
        </form>
        <div class="dropdown ms-3">
            <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://via.placeholder.com/32" alt="Utilisateur" width="32" height="32" class="rounded-circle">
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Profil</a></li>
                <li><a class="dropdown-item" href="#">Paramètres</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Déconnexion</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Classement -->
<div class="overlay pt-5 mt-5">
    <h1>Classement Ligue 1 2024-2025</h1>
    <table>
        <tr>
            <th>Pos</th>
            <th>Club</th>
            <th>Pts</th>
            <th>BM</th>
            <th>BE</th>
            <th>Diff</th>
        </tr>
        <?php
        $position = 1;
        foreach ($clubs as $club) {
            $diff = $club['butsmarques'] - $club['butsencaisses'];
            $class = '';
            if ($position <= 3) $class = 'champions';
            elseif ($position == 16) $class = 'barrage';
            elseif ($position >= count($clubs) - 1) $class = 'relegation';

            echo "<tr class='$class'>
                <td>$position</td>
                <td class='club-name'>
                    <a href='club.php?idclub={$club['idclub']}'>
                        <img class='logo' src='..images/{$club['logo']}' alt='Logo'>
                        {$club['nomcourt']}
                    </a>
                </td>
                <td>{$club['nbpoints']}</td>
                <td>{$club['butsmarques']}</td>
                <td>{$club['butsencaisses']}</td>
                <td>$diff</td>
            </tr>";
            $position++;
        }
        ?>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
