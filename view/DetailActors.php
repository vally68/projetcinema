<?php ob_start(); ?>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Titre du film</th>
            <th scope="col">Année de sortie</th>
            <th scope="col">Rôle</th>
            <th scope="col">Acteur</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($requete->fetchAll() as $defilm): ?>
            <tr>
                <td>
                    <a href="index.php?action=DetailFilms&id=<?= $defilm['id_film'] ?>" 
                       class="text-decoration-none text-dark">
                        <?= htmlspecialchars($defilm["film"]) ?>
                    </a>
                </td>
                <td><?= htmlspecialchars($defilm["année_de_sortie"]) ?></td>
                <td><?= htmlspecialchars($defilm["rôle"]) ?></td>
                <td><?= htmlspecialchars($defilm["acteurs"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
$titre = "Filmographie de l’acteur";
$titre_secondaire = "Détail de la filmographie";
$contenu = ob_get_clean();
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1" /> 
  <link href="public/css/bootstrap.min.css" rel="stylesheet">
  <title><?= $titre ?></title>
</head>
<body>
    <div id="wrapper" class="uk-container uk-container-expand">
        <main>
            <div id="contenu">
                <h1 class="uk-heading-divider">Projet Cinéma</h1>
                <h2 class="uk-heading-bullet"><?= $titre_secondaire ?></h2>
                <?= $contenu ?>
            </div>
        </main>
    </div>
</body>
</html>
