<?php 
require "controller/CinemaController.php";
require "controller/PersonController.php";
require "controller/HomeController.php";
require "model/connect.php";
require "controller/AdminController.php";

use Controller\AdminController;
use Controller\CinemaController;
use Controller\PersonController;
use Controller\HomeController;

// Autoload
spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

// Instances des contrôleurs
$ctrlCinema = new CinemaController();
$ctrlPerson = new PersonController();
$ctrlHome = new HomeController();
$ctrlAdmin = new AdminController();

// Récupération des paramètres GET
$id = isset($_GET["id"]) ? $_GET["id"] : null;

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        // FILMS
        case "listFilms":
            $ctrlCinema->listFilms();
            break;

        case "detailFilms":
            $ctrlCinema->detailFilms($id);
            break;

        // ACTEURS
        case "detailActors":
            $ctrlPerson->detailActors($id);
            break;

        case "listActors":
            $ctrlPerson->listActors();
            break;

        // RÉALISATEURS
        case "listDirectors":
            $ctrlPerson->listDirectors();
            break;

        case "detailDirectors":
            $ctrlPerson->detailDirectors($id);
            break;

        // GENRES
        case "listTypesFilms":
            $ctrlCinema->listTypesFilms(); // Liste de tous les genres
            break;

        case "listTypeFilms":
            if ($id) {
                $ctrlCinema->ListTypeFilms($id); // Films d’un genre spécifique
            } else {
                header("Location: index.php?action=listTypesFilms");
                exit;
            }
            break;

        case "ajouterGenre":
            $ctrlAdmin->ajouterGenre();
            break;

        // AJOUTS
        case "addFilms":
            $ctrlAdmin->addFilms();
            break;

        case "addPerson":
            $ctrlAdmin->addPerson();
            break;

        // SUPPRESSIONS
        case "deleteActor":
            $ctrl = new PersonController();
            $ctrl->deleteActor();
            break;

        case "deleteDirector":
            $ctrl = new PersonController();
            $ctrl->deleteDirector();
            break;

            case "deletetypefilm":
            $ctrl = new CinemaController();
            $ctrl->deletetypefilm();
            break;

            case "deleteFilm":
            $ctrl = new AdminController();
            $ctrl->deletefilm();
            break;

        // PAR DÉFAUT
        case "listPerson":
            $ctrlPerson->listActorsAndDirectors();
            break;

        case "Connexion":
            // Aucun code ici pour le moment
            break;

        default:
            $ctrlHome->pageHome();
            break;
    }
} else {
    // Si aucune action n’est définie ou erreur dans le titre,retour  page d’accueil
    $ctrlHome->pageHome();
}
?>
