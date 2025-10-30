<?php ob_start(); 

?>



<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Genre des films</th>
            <th> Nombre films associés</th>
            <th> Liste films associés</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requeteGF->fetchAll() as $listgenre) { ?>
                <tr>
                    <td><?= $listgenre["genre"] ?></td>
                    <td><?= $listgenre["nombre_film_par_genre"] ?></td>
                    <td><?= $listgenre["titre"] ?></td>   <?php //ici faire liste liés au film?>
                    
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php

$titre = "Genre des films";
$titre_secondaire = "Genre des films";

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