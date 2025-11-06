<?php ob_start(); ?>

<table class="table table-striped table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th>Genre</th>
            <th>Liste des films associés</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($requeteGF->fetchAll() as $listgenre): ?>
            <tr>
                <td><?= htmlspecialchars($listgenre["genre"]) ?></td>
                <td><?= htmlspecialchars($listgenre["titres"] ?? "—") ?></td>
                <td>
                    <form 
                        action="index.php?action=deletetypefilm" 
                        method="post" 
                        onsubmit="return confirm('Voulez-vous vraiment supprimer ce genre ?');"
                        class="d-inline"
                    >
                        <input 
                            type="hidden" 
                            name="id_type_film" 
                            value="<?= htmlspecialchars($listgenre['id_type_film'] ?? '') ?>"
                        >
                        <button type="submit" class="btn btn-danger btn-sm">
                            🗑 Supprimer
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<hr>

<!-- 🟢 Formulaire d’ajout d’un nouveau genre -->
<h3>Ajouter un nouveau genre</h3>
<form action="index.php?action=ajouterGenre" method="post" class="mt-3">
    <div class="input-group mb-3" style="max-width:400px;">
        <input 
            type="text" 
            name="nouveau_genre" 
            class="form-control" 
            placeholder="Nom du genre (ex : Comédie)" 
            required
        >
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </div>
</form>

<?php
$titre = "Genres de films";
$titre_secondaire = "Gestion des genres";
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
