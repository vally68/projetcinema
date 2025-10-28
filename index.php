<?php 
require "controller/CinemaController.php";
require "controller/PersonController.php";
require "model/connect.php";


use Controller\CinemaController;
use Controller\PersonController;

spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();
$ctrlPerson = new PersonController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;
// $type =(isset($_get["type"])) ? $-get["type"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]) {
            //Films faire case defaut
        case "ListFilms" : $ctrlCinema->ListFilms(); break;
        case "DetailFilms" : $ctrlCinema->DetailFilms($id); break;
        case "ListActors" : $ctrlPerson->ListActors(); break;
        case "ListDirectors" : $ctrlPerson->ListDirectors(); break;
        case "Default" : $ctrlCinema->ListDirectors(); break;
    }
}


?>

