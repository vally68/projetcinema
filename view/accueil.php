<?php
require_once "../model/connect.php";
use Model\Connect;

$pdo = Connect::seConnecter();
$stmt = $pdo->query("SELECT id_type_film, labelled FROM film_type");
$allGenres = $stmt->fetchAll(\PDO::FETCH_ASSOC);

$titre = "Accueil";
$titre_secondaire = "CINEMA WEBSITE";
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($titre) ?></title>
    <link rel="stylesheet" href="../public/css/style.css">
    </head>
<body>

<header class="site-header">
    <div class="header-inner">
        <form class="header-search" action="../index.php" method="get">
            <input type="hidden" name="action" value="Search">
            <button type="submit" title="Rechercher">🔍</button>
            <input type="search" name="q" placeholder="Rechercher" aria-label="Rechercher">
        </form>

        <div class="brand">
            <a href="../index.php"><img src="../public/img/scene/logo.png" alt="logo" class="logo-img"></a>
        </div>

        <nav class="main-nav">
            <ul>
                <li><a href="../index.php?action=listFilms">FILM</a></li>
                <li><a href="../index.php?action=listDirectors">RÉALISATEUR</a></li>
                <li><a href="../index.php?action=listActors">ACTEUR</a></li>
                <li>
                <!-- Select genres -->
                <select class="form-select" id="id_type_film" name="id_type_film" onchange="if(this.value) window.location.href=this.value;">
                    <option value="">-- Sélectionner un genre de film --</option>
                    <?php foreach ($allGenres as $genre): ?>
                        <option value="../index.php?action=listTypeFilms&id=<?= $genre['id_type_film'] ?>">
                            <?= ($genre['labelled']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </li>
                </ul>
        </nav>

        <div class="nav-right">
            <a href="../index.php?action=Connexion" class="btn-connexion">Connexion</a>
        </div>
    </div>
</header>

<section class="cinma">
    <img src="../public/img/scene/cinema.png" alt="Salle de cinéma" class="cinma-bg">
    <div class="cinma-overlay"></div>
    <div class="cinma-content">
        <h1><?= htmlspecialchars($titre_secondaire) ?></h1>
        <form class="cinma-search" action="../index.php" method="get">
            <input type="hidden" name="action" value="Search">
            <input type="search" name="q" placeholder="Rechercher un film, un acteur..." aria-label="Rechercher">
            </form>
    </div>

</section>

<section class="carousel-wrapper">
    <div class="container carousel">
        <div class="carousel-inner">
            <div class="slide"><img src="../public/img/scene/01.jpg" alt="Image 1"></div>
            <div class="slide"><img src="../public/img/scene/02.png" alt="Image 2"></div>
            <div class="slide"><img src="../public/img/scene/03.jpg" alt="Image 3"></div>
            <div class="slide"><img src="../public/img/scene/04.jpg" alt="Image 4"></div>
            <div class="slide"><img src="../public/img/scene/05.jpg" alt="Image 5"></div>
        </div>

        <div class="carousel-controls">
            <button id="prev" class="carousel-btn">Précédent</button>
            <button id="next" class="carousel-btn">Suivant</button>
        </div>

        <div class="carousel-dots" id="carousel-dots"></div>
    </div>
</section>

<section class="film-section">
    <img src="../public/img/scene/fond.png" alt="Bande de film" class="film-strip"> <!-- image bobine -->
    <div class="camera-block">
        <img src="../public/img/scene/camera.png" alt="Caméra" class="camera-img">
        <div class="camera-buttons">
            <a href="../index.php?action=listDirectors">RÉALISATEUR</a>
            <a href="../index.php?action=listActors">ACTEUR</a>
            <a href="../index.php?action=listFilms">FILM</a>
        </div>
    </div>
</section>

<script src="../public/js/app.js" defer></script>
</body>
</html>