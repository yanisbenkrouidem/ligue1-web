<?php
session_start();
$imageProfil = $_SESSION['user']['photo'] ?? 'https://via.placeholder.com/32';
$pseudo = $_SESSION['user']['pseudoutil'] ?? null;

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
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ligue 1 McDonalds</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
        }

        header {
            height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.2)), url('images/wee.jpg') no-repeat center center/cover;
            color: white;
            position: relative;
        }

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

        .btn-custom {
            background-color: #ffc107;
            border: none;
            color: black;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .btn-custom:hover {
            background-color: transparent;
            border: 1px solid #fff;
            color: #fff;
        }

        .hero-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .hero-text h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        .hero-text p {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .dropdown img {
            border-radius: 50%;
        }
        .profile-option {
  cursor: pointer;
  border: 2px solid transparent;
  border-radius: 50%;
  transition: border 0.3s;
}

input[type="radio"]:checked + .profile-option {
  border: 2px solid #ffc107;
  box-shadow: 0 0 5px #ffc107;
}

    </style>
</head>
<!-- Modal Auth -->
<div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="authModalLabel">Authentification</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <!-- Onglets -->
        <ul class="nav nav-tabs mb-3" id="authTabs">
          <li class="nav-item">
            <a class="nav-link active" id="login-tab" data-bs-toggle="tab" href="#login">Connexion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="register-tab" data-bs-toggle="tab" href="#register">Inscription</a>
          </li>
        </ul>

        <div class="tab-content">
          <!-- Connexion -->
          <div class="tab-pane fade show active" id="login">
            <form action="login.php" method="POST">
              <div class="mb-3">
                <label class="form-label">Pseudo</label>
                <input type="text" name="pseudoutil" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="motdepasse" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-custom w-100">Se connecter</button>
            </form>
          </div>

          <!-- Inscription -->
          <div class="tab-pane fade" id="register">
            <form action="register.php" method="POST">
              <div class="mb-3">
                <label class="form-label">Pseudo</label>
                <input type="text" name="pseudoutil" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="motdepasse" class="form-control" required>
              </div>
          <div class="mb-3">
  <label class="form-label d-block">Choisir une photo de profil</label>
  <div class="d-flex gap-3">
    <label class="position-relative">
  <input type="radio" name="photo" value="img/pp1.jpeg" required hidden>
  <img src="img/pp1.jpeg" width="64" height="64" class="img-thumbnail rounded-circle profile-option">
</label>
    <label class="position-relative">
  <input type="radio" name="photo" value="img/pp2.jpg" required hidden>
  <img src="img/pp2.jpg" width="64" height="64" class="img-thumbnail rounded-circle profile-option">
</label>
  <label class="position-relative">
  <input type="radio" name="photo" value="img/pp4.jpg" required hidden>
  <img src="img/pp4.jpg" width="64" height="64" class="img-thumbnail rounded-circle profile-option">
</label>
  </div>
</div>

              <button type="submit" class="btn btn-custom w-100">S'inscrire</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<body>
    <?php if (isset($_SESSION['success_message'])): ?>
<div class="alert alert-success text-center m-4">
    <?= htmlspecialchars($_SESSION['success_message']) ?>
</div>
<?php unset($_SESSION['success_message']); endif; ?>


<!-- HEADER -->
<header class="d-flex flex-column justify-content-between">

    <!-- Navbar importée -->
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
                <img src="<?= htmlspecialchars($_SESSION['user']['photo'] ?? 'https://via.placeholder.com/32') ?>" alt="Utilisateur" width="32" height="32" class="rounded-circle">

            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="">Profil</a></li>
                <li><a class="dropdown-item" href="">Paramètres</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="">Déconnexion</a></li>
            </ul>
        </div>
    </div>
</nav>


                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                   <a class="dropdown-item" href="login.php" data-bs-toggle="modal" data-bs-target="#authModal">Profil</a>

                    <li><a class="dropdown-item" href="">Paramètres</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="">Déconnexion</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Texte central -->
    <div class="container hero-text">
        <h1 class="display-4 fw-bold">Classement de la saison 2024-2025</h1>
        <p class="lead">Ligue 1 McDonald's</p>
        <a href="saison.php" class="btn btn-custom px-4 py-2">Voir le Classement</a>
    </div>
</header>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
