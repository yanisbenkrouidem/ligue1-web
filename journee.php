<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journées du Championnat</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
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

        :root {
            --primary-color: #ffffff;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: url('images/wee.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Montserrat', sans-serif;
            min-height: 100vh;
            padding: 0;
            color: var(--primary-color);
            position: relative;
        }

        .main-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7);
            animation: fadeIn 0.8s ease-out;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        h1 {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--primary-color);
            font-size: 2.5rem;
            position: relative;
            padding-bottom: 1rem;
            width: 100%;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--secondary-color);
            border-radius: 2px;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            width: 35%;
            text-align: center;
        }

        label {
            font-size: 1rem;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        select, input[type="submit"] {
            padding: 0.8rem 1.5rem;
            font-size: 1.1rem;
            border-radius: 50px;
            border: none;
            margin-top: 10px;
        }

        select {
            border: 2px solid var(--secondary-color);
            background-color: #34495e;
            color: var(--primary-color);
        }

        select:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        select:focus {
            border-color: var(--accent-color);
        }

        input[type="submit"] {
            background-color: var(--secondary-color);
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        input[type="submit"]:hover {
            background-color: var(--accent-color);
        }

        .results-container {
            width: 60%;
            padding: 2rem;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.7);
            overflow-y: auto;
            max-height: 600px;
            display: block;
            cursor: pointer;
        }

        .rencontre-item {
            background: rgba(0, 0, 0, 0.8);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .club-container {
            display: flex;
            justify-content: space-between;
            align-items: center;

        }

        .club {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .club img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .match-time {
            background-color: var(--secondary-color);
            color: white;
            padding: 0.3rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .comment-section {
            display: none;
            padding: 1rem;
            margin-top: 1rem;
            background-color: #34495e;
            border-radius: 10px;
        }

        .comment {
            background: #2c3e50;
            padding: 0.8rem;
            margin-bottom: 0.5rem;
            border-radius: 8px;
        }

        .comment-input {
            width: 100%;
            padding: 0.8rem;
            border-radius: 8px;
            border: 1px solid var(--secondary-color);
            background-color: #34495e;
            color: var(--primary-color);
        }

        .comment-btn {
            background-color: var(--secondary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            border: none;
            margin-top: 0.5rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
            }

            .form-container, .results-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm px-4">
    <a class="navbar-brand" href="#">
        <div class="brand-circle">L</div>
        <span class="fw-bold text-white">Ligue 1</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-3">
            <li class="nav-item"><a class="nav-link active text-white" href="classement.php">Acceuil</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="saison.php">Classement</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#">Journée</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#">Calendrier</a></li>
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

<!-- CONTENU PRINCIPAL -->
<div class="main-container">
    <div class="form-container">
        <h1>Journées du Championnat</h1>
        <form method="GET" action="">
            <label for="cbojour">Sélectionner une journée :</label>
            <select name="cbojour" id="cbojour">
                <?php
                try {
                    $bdd = new PDO("mysql:host=localhost;dbname=bdfoot2benkrouidembelkhiri;charset=utf8", "root", "");
                    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $req = $bdd->prepare("SELECT idjournee FROM journee");
                    $req->execute();
                    $leslignes = $req->fetchAll();
                    foreach ($leslignes as $uneligne) {
                        echo "<option value='" . htmlspecialchars($uneligne['idjournee']) . "'>Journée " . htmlspecialchars($uneligne['idjournee']) . "</option>";
                    }
                    $req->closeCursor();
                } catch (Exception $e) {
                    echo 'Erreur : ' . $e->getMessage();
                }
                ?>
            </select>
            <input type="submit" name="btnvalider" value="Valider" />
        </form>
    </div>

    <div class="results-container">
        <?php
        if (isset($_GET["cbojour"]) && $_GET["cbojour"] != '') {
            echo "<h2>Rencontres de la journée <u>" . htmlspecialchars($_GET['cbojour']) . "</u></h2><br/>";

            try {
                $req = $bdd->prepare("SELECT daterenc, heurerenc, numrenc, scoreclubdom, scoreclubext, clubdom.nomcourt AS nomcourt_dom, clubdom.logo AS logodom, clubext.nomcourt AS nomcourt_ext, clubext.logo AS logoext 
                FROM rencontre 
                INNER JOIN club AS clubdom ON rencontre.idclubdom = clubdom.idclub 
                INNER JOIN club AS clubext ON rencontre.idclubext = clubext.idclub 
                WHERE idjournee = :idjournee");

                $req->bindParam(':idjournee', $_GET["cbojour"], PDO::PARAM_INT);
                $req->execute();
                $leslignes = $req->fetchAll();

                if (count($leslignes) > 0) {
                    foreach ($leslignes as $uneligne) {
                        echo "<div class='rencontre-item' onclick='toggleComments(" . htmlspecialchars($uneligne['numrenc']) . ")'>
                            <h3>Rencontre N°" . htmlspecialchars($uneligne['numrenc']) . "</h3>
                            <p><strong>Date :</strong> " . htmlspecialchars($uneligne['daterenc']) . " <strong>Heure :</strong> " . htmlspecialchars($uneligne['heurerenc']) . "</p>
                            <div class='club-container'>
                                <div class='club'>
                                    <img src='images/" . htmlspecialchars($uneligne['logodom']) . "' alt='Logo domicile'>
                                    <p>" . htmlspecialchars($uneligne['nomcourt_dom']) . " (" . htmlspecialchars($uneligne['scoreclubdom']) . ")</p>
                                </div>
                                <div class='club'>
                                    <img src='images/" . htmlspecialchars($uneligne['logoext']) . "' alt='Logo extérieur'>
                                    <p>" . htmlspecialchars($uneligne['nomcourt_ext']) . " (" . htmlspecialchars($uneligne['scoreclubext']) . ")</p>
                                </div>
                            </div>
                            <div class='match-time'>" . htmlspecialchars($uneligne['heurerenc']) . "</div>
                        </div>
                        <div class='comment-section' id='comments-" . htmlspecialchars($uneligne['numrenc']) . "'>
                            <h4>Commentaires :</h4>
                            <div class='comments-list' id='comment-list-" . htmlspecialchars($uneligne['numrenc']) . "'></div>
                            <input type='text' class='comment-input' id='comment-input-" . htmlspecialchars($uneligne['numrenc']) . "' placeholder='Ajouter un commentaire'>
                            <button class='comment-btn' onclick='addComment(" . htmlspecialchars($uneligne['numrenc']) . ")'>Envoyer</button>
                        </div>
                        <hr/>";
                    }
                } else {
                    echo "<p class='no-matches'>Aucune rencontre trouvée pour cette journée.</p>";
                }
                $req->closeCursor();
            } catch (Exception $e) {
                echo 'Erreur : ' . $e->getMessage();
            }
        }
        ?>
    </div>
</div>

<script>
    let comments = {};

    function toggleComments(id) {
        let section = document.getElementById(`comments-${id}`);
        section.style.display = section.style.display === "block" ? "none" : "block";
        loadComments(id);
    }

    function addComment(id) {
        let input = document.getElementById(`comment-input-${id}`);
        let commentText = input.value.trim();

        if (commentText) {
            if (!comments[id]) {
                comments[id] = [];
            }
            comments[id].push(commentText);
            input.value = "";
            loadComments(id);
        }
    }

    function loadComments(id) {
        let list = document.getElementById(`comment-list-${id}`);
        list.innerHTML = "";

        if (comments[id]) {
            comments[id].forEach(comment => {
                let div = document.createElement("div");
                div.classList.add("comment");
                div.textContent = comment;
                list.appendChild(div);
            });
        }
    }
</script>

</body>
</html>
