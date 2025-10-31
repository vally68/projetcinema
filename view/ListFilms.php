

<?php ob_start(); ?>

<p class ="uk-label uk-label-warning"> Il y a <?= $requete->rowCount() ?> films </p>

<table class="table table-striped  table-hover">
    <thead>
        <tr>
            <th>Titre</th>
            <th> ANNEE de SORTIE</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $film) { ?>
               <tr>
    <td>
        <a href="index.php?action=DetailFilms&id=<?= $film['id_film'] ?>">
            <?= $film["title"] ?>
        </a>
    </td>
    <td><?= $film["release_year_france"] ?></td>
</tr>

            <?php } ?>
    </tbody>
</table>

<?php

$titre = "liste des films";
$titre_secondaire = "liste des films";
$contenu = ob_get_clean();

?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1" /> 
<link href="public/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="public/css/style.css">
  <title><?= $titre ?></title>
  <script src="script.js"></script>
</head>
<body>
    <nav class="uk-navbar-container" uk-navbar uk-sticky>
    </nav>
    <div id="wrapper" class="uk-container uk-container-expand">
        <main>
            <div id="contenu">
                <h1 class ="uk-heading-divider">Projet Cinema</h1>
                <h2 class ="uk-heading-bullet"><?= $titre_secondaire ?></h2>
                <?= $contenu ?>
            </div>
        </main>
    </div>
</body>
</html>