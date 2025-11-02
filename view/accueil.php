<?php
require_once "../model/connect.php"; // chemin relatif à adapter si nécessaire
use Model\Connect;

// Connexion à la base
$pdo = Connect::seConnecter();

// Récupérer tous les genres
$stmt = $pdo->query("SELECT id_type_film, labelled FROM film_type");
$allGenres = $stmt->fetchAll(\PDO::FETCH_ASSOC);

$titre = "Accueil";
$titre_secondaire = "Page d'accueil";
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <link rel="stylesheet" href="../public/css/style.css">
    <title><?= $titre ?></title>
    <script src="../public/js/app.js" async></script>
</head>
<body>
<header>
    <nav class="menu">
        <ul>
            <li>
                <a href="#">
                    <label for="site-search"></label>
                    <input type="search" id="site-search" name="q" />
                </a>
            </li>
            <li><a href="../index.php?action=ListDirectors">REALISATEUR</a></li>
            <li><a href="../index.php?action=ListActors">ACTEUR</a></li>
            <li><a href="../index.php?action=ListFilms">FILM</a></li>
           
            <li>
                <!-- Select genres -->
                <select class="form-select" id="id_type_film" name="id_type_film" onchange="if(this.value) window.location.href=this.value;">
                    <option value="">-- Sélectionner un genre de film --</option>
                    <?php foreach ($allGenres as $genre): ?>
                        <option value="../index.php?action=ListTypeFilms&id=<?= $genre['id_type_film'] ?>">
                            <?= htmlspecialchars($genre['labelled']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </li>
            <li><a href="../index.php?action=Connexion">Connexion</a></li>
        </ul>
    </nav>
</header>

<div id="wrapper" class="uk-container uk-container-expand">
    <main>
        <h1><?= $titre_secondaire ?></h1>

        <p>CINEMA WEBSITE</p>
        <p>
            <label for="site-search"></label>
            <input type="search" id="site-search" name="q" />
            <button>Search</button>
        </p>

        <!-- Carrousel -->
        <div class="container">
            <div class="carousel">
                <div class="carousel-inner">
                    <div class="slide"><img src="../public/img/scene/01.jpg" alt="Image 1"></div>
                    <div class="slide"><img src="../public/img/scene/02.png" alt="Image 2"></div>
                    <div class="slide"><img src="../public/img/scene/03.jpg" alt="Image 3"></div>
                    <div class="slide"><img src="../public/img/scene/04.jpg" alt="Image 4"></div>
                    <div class="slide"><img src="../public/img/scene/05.jpg" alt="Image 5"></div>
                </div>
                <div class="carousel-controls">
                    <button id="prev">Précédent</button>
                    <button id="next">Suivant</button>
                </div>
                <div class="carousel-dots"></div>
            </div>
        </div>
    </main>
</div>

<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</body>
</html>
