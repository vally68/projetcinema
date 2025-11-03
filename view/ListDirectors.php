<!-- création de l'objet php -->
<?php ob_start(); ?>

<p class ="uk-label uk-label-warning"> Il y a <?= $requeteDirector->rowCount() ?> réalisateurs </p>

<table class="uk-table uk-table-stripped">
    <thead>
        <tr>
            <th>Prénom</th>
            <th> Nom</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requeteDirector->fetchAll() as $director) { ?>
                <tr>
                    <td><?= $director["first_name"] ?></td>
                    <td><?= $director["last_name"] ?></td>
                    <!-- <td><a href="index.php?action=DetailFilms&id=<?= $director['id_film'] ?>"><?= $director["title"] ?></td></a> -->
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php

$titre = "liste des réalisateurs";
$titre_secondaire = "Réalisateurs et réalisatrice";
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
$titre = "Liste des acteurs";
$titre_secondaire = "Nom et prénom";

?>
        </main>
    </div>
</body>
</html>