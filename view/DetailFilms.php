

<?php ob_start(); ?>



<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Titre</th>
            <th scope="col"> Date de sortie</th>
            <th scope="col"> Durée</th>
            <th scope="col"> résumé</th>
            <th scope="col"> note</th>
            <th scope="col"> Affiche</th>
            <th scope="col"> Casting</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $defilm) { ?>
                <tr>
                    <td > <?= $defilm["title"] ?></td>
                    <td> <?= $defilm["release_year_france"] ?></td>
                    <td> <?= $defilm["duration"] ?> mn</td>
                    <td> <?= $defilm["synopsis"] ?></td>
                    <td> <?= $defilm["note"] ?></td>
<td>
    <?php echo '<img class="img-thumbnail" src="public/img/' . $defilm['poster'] . '" style="display: block; margin: 0 auto; width: 35%; height: 35%;">'; ?>
</td>

                    <td> <?php foreach($requetecasting as $acteur): ?> <?= $acteur['first_name'] . " " . $acteur['acteur'] ?> 
                        (<?= $acteur['sexe'] ?>)<?php endforeach; ?></td>
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
  <link rel="stylesheet" href="style.css">
   <link href="public/css/bootstrap.min.css" rel="stylesheet">
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
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</body>
</html>