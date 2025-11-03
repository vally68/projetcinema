<?php ob_start(); ?>

<p class="uk-label uk-label-warning">
    Il y a <?= $requete->rowCount() ?> films
</p>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Année de sortie</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($requete->fetchAll() as $film): ?>
            <tr>
                <td>
                    <a href="index.php?action=DetailFilms&id=<?= $film['id_film'] ?>">
                        <?= ($film["title"]) ?>
                    </a>
                </td>
                <td><?= ($film ["release_year_france"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- 🟢 Formulaire d’ajout d’un nouveau film -->
<h3>Ajouter un nouveau film</h3>
<form action="index.php?action=AddFilms" method="post" class="mt-3">
    <div class="input-group mb-3" style="max-width:400px;">
        <input type="text" name="new_films" class="form-control" placeholder="Nom du film">
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </div>
</form>

<?php
$titre = "Liste des films";
$titre_secondaire = "Gestion des films";
$contenu = ob_get_clean();
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1" /> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <title><?= htmlspecialchars($titre) ?></title>
</head>
<body>
    <div id="wrapper" class="container mt-4">
        <main>
            <h1 class="mb-4">Projet Cinéma</h1>
            <h2><?= htmlspecialchars($titre_secondaire) ?></h2>
            <?= $contenu ?>
        </main>
    </div>
</body>
</html>
