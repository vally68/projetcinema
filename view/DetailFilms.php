

<?php ob_start(); ?>

<p class ="uk-label uk-label-warning"> Il y a <?= $requete->rowCount() ?> films </p>

<table class="uk-table uk-table-stripped">
    <thead>
        <tr>
            <th>Titre</th>
            <th> Date de sortie</th>
            <th> Durée</th>
            <th> résumé</th>
            <th> note</th>
            <th> Affiche</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $defilm) { ?>
                <tr>
                    <td><?= $defilm["title"] ?></td>
                    <td> <?= $defilm["release_year_france"] ?></td>
                    <td> <?= $defilm["duration"] ?></td>
                    <td> <?= $defilm["synopsis"] ?></td>
                    <td> <?= $defilm["note"] ?></td>
                    <td>
                    <img src="<?= ($defilm["poster"]) ?>" 
                 alt="Affiche du film <?= ($defilm["poster"]) ?>" 
                 style="width:100px; height:auto;">
        </td>
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php
$titre = "liste des films";
$titre_secondaire = "détail du film";
$contenu = ob_get_clean();

?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1" /> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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