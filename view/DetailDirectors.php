<?php ob_start(); ?>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Genre</th>
            <th scope="col">Film réalisé</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($requete5->fetchAll() as $deddirector): ?>
            <tr>
                
                <td><?= ($deddirector["Nom_prénom"]) ?></td>
                
                <td><?= ($deddirector["Genre"]) ?></td>
                <td>
                    <a href="index.php?action=detailFilms&id=<?= $deddirector['id_film'] ?>" 
                       class="text-decoration-none text-dark">
                        <?= ($deddirector["film_real"]) ?>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
$titre = "Filmographie du réalisateur";
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
