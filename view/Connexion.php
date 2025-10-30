<?php ob_start(); 

?>


<?php echo("Y'A RIEN ICI !")?>

<?php

$titre = "CONNEXION";
$titre_secondaire = "Genre des films";

$contenu = ob_get_clean();

?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1" /> 
<link href="public/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="public/css/style.css">
  <title>CONNEXION</title>
  <script src="script.js"></script>
</head>
<body>
    <nav class="uk-navbar-container" uk-navbar uk-sticky>
    </nav>
    <div id="wrapper" class="uk-container uk-container-expand">
        <main>
            <div id="contenu">
                <h1 class ="uk-heading-divider">Projet Cinema</h1>
               <p> BOUH!</p>
            </div>
        </main>
    </div>
</body>
</html>