<?php 
require "controller/CinemaController.php";
require "model/connect.php";


use Controller\CinemaController;

spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;
// $type =(isset($_get["type"])) ? $-get["type"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]) {
            //Films faire case defaut
        case "ListFilms" : $ctrlCinema->ListFilms(); break;
        case "DetailFilms" : $ctrlCinema->DetailFilms($id); break;
        case "ListActors" : $ctrlCinema->ListActors(); break;
        case "ListDirectors" : $ctrlCinema->ListDirectors(); break;
    }
}


?>

