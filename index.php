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

spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();
$ctrlPerson = new PersonController();
$ctrlHome = new HomeController();
$ctrlAdmin = new AdminController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;
// $type =(isset($_get["type"])) ? $-get["type"] : null;

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "ListFilms":
            $ctrlCinema->ListFilms();
            break;

        case "DetailFilms":
          
            $ctrlCinema->DetailFilms($id);
            break;

        case "DetailActors":
            $ctrlPerson->DetailActors($id);
            break;

            case "ListActors":
            $ctrlPerson->ListActors();
            break;

        case "ListDirectors":
            $ctrlPerson->ListDirectors();
            break;

        case "ListTypeFilms":
            $ctrlCinema->ListTypeFilms($id);
            break;

            case "Connexion":
           // $ctrlCinema->ListTypeFilms();
            break;

            case "ListPerson":
             $ctrlPerson->listActorsAndDirectors();
            break;

            case "DetailDirectors":
            $ctrlPerson->detailDirectors($id);
            break;

           case "ajouterGenre":
    $ctrlAdmin->ajouterGenre();
    break;

case "AddFilms":
    $ctrlAdmin->addFilms();
    break;

    case "AddPerson":
    $ctrlAdmin->addPerson();
    break;

        default:
           $ctrlHome->PageHome();
             break;
    }
} else {
    // Si aucune action n’est définie, on affiche la page d’accueil par défaut
    $ctrlHome->PageHome();
}



?>



