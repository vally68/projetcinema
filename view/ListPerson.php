<?php ob_start(); ?>


<!-- TABLE ACTEURS -->
<h3>Liste des acteurs</h3>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($requeteActor->fetchAll() as $actor): ?>
            <tr>
                <td>
                    <a href="index.php?action=DetailActors&id=<?= $actor['id_people'] ?>" class="text-decoration-none text-dark">
                        <?= ($actor["first_name"]) ?>
                    </a>
                </td>
                <td>
                    <a href="index.php?action=DetailActors&id=<?= $actor['id_people'] ?>" class="text-decoration-none text-dark">
                        <?= ($actor["last_name"]) ?>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- TABLE REALISATEURS -->
<h3>Liste des réalisateurs</h3>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($requeteDirector->fetchAll() as $director) : ?>
            <tr>
                <td>
                     <a href="index.php?action=DetailDirectors&id=<?= $director['id_people'] ?>" class="text-decoration-none text-dark">
                <?= ($director["first_name"]) ?></a></td>
        </a>
                <td>
                <a href="index.php?action=DetailDirectors&id=<?= $director['id_people'] ?>" class="text-decoration-none text-dark">
                <?= ($director["last_name"]) ?></a></td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<h2>Ajouter une nouvelle personne</h2>

<form action="index.php?action=AddPerson" method="post" class="mt-3" style="max-width:500px;">
    <div class="mb-3">
        <label class="form-label">Prénom</label>
        <input type="text" name="first_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input type="text" name="last_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Date de naissance</label>
        <input type="date" name="birthday" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Genre</label>
        <select name="gender" class="form-select" required>
            <option value="">-- Sélectionner --</option>
            <option value="M">Homme</option>
            <option value="F">Femme</option>
            <option value="Autre">Autre</option>
        </select>
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" name="is_actor" id="is_actor">
        <label for="is_actor" class="form-check-label">Acteur</label>
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" name="is_director" id="is_director">
        <label for="is_director" class="form-check-label">Réalisateur</label>
    </div>

    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
<?php
$titre = "Liste des réalisateurs et acteurs";
$titre_secondaire = "Réalisateurs et acteurs";
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