

<?php ob_start(); ?>



<?php
$titre = "acceuil";
$titre_secondaire = "page d'acceuil";
$contenu = ob_get_clean();

?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1" /> 
  <link rel="stylesheet" href="../public/css/style.css">
  <!-- <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
  <title><?= $titre ?></title>
  <script src="../public/js/app.js" async></script>
</head>
<body>
   <nav class="menu">
		
					<ul>
						<li><a href="index.html"><label for="site-search"></label> <input type="search" id="site-search" name="q" /></a></li>
						<li><a href="#tradition">FILM</a></li>
						<li><a href="#services">REALISATEUR</a></li>
						<li><a href="index.html">ACTEUR</a></li>
						<li><a href="index.html">Connexion</a></li>
					</ul>
				
				</nav>
    <div id="wrapper" class="uk-container uk-container-expand">
        <main>
<p>CINEMA WEBSITE</p>
<p>
    <label for="site-search"></label>
        <input type="search" id="site-search" name="q" />
            <button>Search</button>
</p>
<button></button>
<!-- Conteneur principal pour le carrousel -->
    <div class="container">
        <!-- Élément carrousel -->
        <div class="carousel">
            <!-- Conteneur interne pour les diapositives -->
            <div class="carousel-inner">
                <!-- Première diapositive -->
                <div class="slide">
                    <!-- Image de la première diapositive -->
                    <img src="../public/img/scene/01.jpg"
                        alt="Image 1">
                </div>
                <!-- Deuxième diapositive -->
                <div class="slide">
                    <!-- Image de la deuxième diapositive -->
                    <img src="../public/img/scene/02.png"
                        alt="Image 2">
                </div>
                <!-- Troisième diapositive -->
                <div class="slide">
                    <!-- Image de la troisième diapositive -->
                    <img src="../public/img/scene/03.jpg"
                        alt="Image 3">
                </div>
                <!-- Quatrième diapositive -->
                <div class="slide">
                    <!-- Image de la quatrième diapositive -->
                    <img src="../public/img/scene/04.jpg"
                        alt="Image 4">
                </div>
                <!-- Cinquième diapositive -->
                <div class="slide">
                    <!-- Image de la cinquième diapositive -->
                    <img src="../public/img/scene/05.jpg"
                        alt="Image 5">
                </div>
            </div>
            <!-- Conteneur pour les boutons de navigation -->
            <div class="carousel-controls">
                <!-- Bouton pour passer à la diapositive précédente -->
                <button id="prev">Précédent</button>
                <!-- Bouton pour passer à la diapositive suivante -->
                <button id="next">Suivant</button>
            </div>
            <!-- Conteneur pour les points de navigation -->
            <div class="carousel-dots"></div>
        </div>
    </div>
        </main>
    </div>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</body>
</html>