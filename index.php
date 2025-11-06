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
        case "ListFilms":
            $ctrlCinema->ListFilms();
            break;

        case "DetailFilms":
            $ctrlCinema->DetailFilms($id);
            break;

        // ACTEURS
        case "DetailActors":
            $ctrlPerson->DetailActors($id);
            break;

        case "ListActors":
            $ctrlPerson->ListActors();
            break;

        // RÉALISATEURS
        case "ListDirectors":
            $ctrlPerson->ListDirectors();
            break;

        case "DetailDirectors":
            $ctrlPerson->detailDirectors($id);
            break;

        // GENRES
        case "ListTypesFilms":
            $ctrlCinema->ListTypesFilms(); // Liste de tous les genres
            break;

        case "ListTypeFilms":
            if ($id) {
                $ctrlCinema->ListTypeFilms($id); // Films d’un genre spécifique
            } else {
                header("Location: index.php?action=ListTypesFilms");
                exit;
            }
            break;

        case "ajouterGenre":
            $ctrlAdmin->ajouterGenre();
            break;

        // AJOUTS
        case "AddFilms":
            $ctrlAdmin->addFilms();
            break;

        case "AddPerson":
            $ctrlAdmin->addPerson();
            break;

        // SUPPRESSIONS
        case "DeleteActor":
            $ctrl = new PersonController();
            $ctrl->deleteActor();
            break;

        case "DeleteDirector":
            $ctrl = new PersonController();
            $ctrl->deleteDirector();
            break;

            case "deletetypefilm":
            $ctrl = new CinemaController();
            $ctrl->deletetypefilm();
            break;

            case "DeleteFilm":
            $ctrl = new AdminController();
            $ctrl->deletefilm();
            break;

        // PAR DÉFAUT
        case "ListPerson":
            $ctrlPerson->listActorsAndDirectors();
            break;

        case "Connexion":
            // Aucun code ici pour le moment
            break;

        default:
            $ctrlHome->PageHome();
            break;
    }
} else {
    // Si aucune action n’est définie ou erreur dans le titre,retour  page d’accueil
    $ctrlHome->PageHome();
}
?>
