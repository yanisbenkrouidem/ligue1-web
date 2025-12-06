<?php
session_start();

$inscriptionMessage = "";
$connexionMessage = "";

// Connexion à la base de données
try {
    $bdd = new PDO("mysql:host=localhost;dbname=bdfoot2benkrouidembelkhiri;charset=utf8", "root", "");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

// Traitement de l'inscription
if (isset($_POST["btninscrit"])) {
    $pseudo = htmlspecialchars($_POST["txtuser"]);
    $mdp = $_POST["txtmdp"];

    // Vérifier si le pseudo existe déjà
    $req = $bdd->prepare("SELECT pseudoutil FROM utilisateur WHERE pseudoutil = :pseudo");
    $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $req->execute();
    $uneligne = $req->fetch();

    if ($uneligne) {
        $inscriptionMessage = "<p style='color: red;'>Ce pseudo est déjà utilisé.</p>";
    } else {
        // Insertion du nouvel utilisateur avec le mot de passe en texte clair
        $req = $bdd->prepare("INSERT INTO utilisateur (pseudoutil, mdputil) VALUES (:pse, :mdp)");
        $req->bindParam(':pse', $pseudo, PDO::PARAM_STR);
        $req->bindParam(':mdp', $mdp, PDO::PARAM_STR);

        if ($req->execute()) {
            $inscriptionMessage = "<p style='color: #4CAF50;'>Inscription réussie !</p>";
        } else {
            $inscriptionMessage = "<p style='color: red;'>Échec de l'inscription.</p>";
        }
    }
}

// Traitement de la connexion
if (isset($_POST["btnconnect"])) {
    $pseudo = htmlspecialchars($_POST["username"]);
    $mdp = $_POST["password"];

    // Récupération du mot de passe en texte clair depuis la base de données
    $req = $bdd->prepare("SELECT mdputil FROM utilisateur WHERE pseudoutil = :pseudo");
    $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $req->execute();
    $user = $req->fetch();

    // Vérification du mot de passe en texte clair
    if ($user && $mdp === $user["mdputil"]) {
        $_SESSION["user"] = $pseudo;
        header("Location: dashboard.php"); // ✅ Fichier au même niveau que login.php
        exit();
    } else {
        $connexionMessage = "<p style='color: red;'>Identifiants incorrects.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter - Yanis Benkrouidem</title>
    <link rel="stylesheet" href="../css/login.css">
    <script defer src="../js/login.js"></script>
</head>

<body>
    <div class="container" id="container">
        <!-- Formulaire Inscription -->
        <div class="form-container register-container">
            <form id="register-form" method="POST">
                <h1>S'inscrire</h1>
                <input type="text" name="txtuser" placeholder="Nom" required>
                <input type="password" name="txtmdp" placeholder="Mot de passe" required>
                <input type="submit" name="btninscrit" value="S'inscrire">
                <div id="inscription-message"><?php echo $inscriptionMessage; ?></div>
            </form>
        </div>

        <!-- Formulaire Connexion -->
        <div class="form-container login-container">
            <form method="POST">
                <h1>Connectez-vous ici</h1>
                <input type="text" name="username" placeholder="Nom d'utilisateur" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <button type="submit" name="btnconnect">Se connecter</button>
                <div id="connexion-message"><?php echo $connexionMessage; ?></div>
            </form>
        </div>

        <!-- Overlay Section -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="title">Amusez-vous bien !</h1>
                    <p>Si vous avez un compte, connectez-vous ici et amusez-vous</p>
                    <button class="ghost" id="login">Se connecter</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="title">Bienvenue sur la Ligue 1 McDonalds !</h1>
                    <p>Rejoignez-nous et commencez votre voyage</p>
                    <button class="ghost" id="register">Inscris-toi</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
