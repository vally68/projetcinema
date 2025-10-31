<?php ob_start(); ?>

<p class="uk-label uk-label-warning">
    Il y a <?= $requete->rowCount() ?> acteurs
</p>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($requete->fetchAll() as $actor): ?>
            <tr>
                <td>
                    <a href="index.php?action=DetailActors&id=<?= $actor['id_people'] ?>" class="text-decoration-none text-dark">
                        <?= htmlspecialchars($actor["first_name"]) ?>
                    </a>
                </td>
                <td>
                    <a href="index.php?action=DetailActors&id=<?= $actor['id_people'] ?>" class="text-decoration-none text-dark">
                        <?= htmlspecialchars($actor["last_name"]) ?>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
$titre = "Liste des acteurs";
$titre_secondaire = "Nom et prénom";
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
  <title><?= htmlspecialchars($titre) ?></title>
</head>
<body>
    <div id="wrapper" class="uk-container uk-container-expand">
        <main>
            <div id="contenu">
                <h1 class="uk-heading-divider">Projet Cinéma</h1>
                <h2 class="uk-heading-bullet"><?= htmlspecialchars($titre_secondaire) ?></h2>
                <?= $contenu ?>
            </div>
        </main>
    </div>
</body>
</html>
