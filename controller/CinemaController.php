<?php

namespace Controller;
use Model\Connect;

class CinemaController {

    /**
     * Lister les films
     */
    public function ListFilms()  {

        $pdo= Connect:: seConnecter();
        $requete = $pdo->query("
        SELECT title, release_year_france
        FROM film
        ");

        require "view/ListFilms.php";
        
    }

     public function ListActors()  {

        $pdo= Connect:: seConnecter();
        $requete = $pdo->query("
        SELECT 
            person.first_name,
            person.last_name,
        CONCAT(person.first_name, ' ', person.last_name) AS Nom_prenom
        FROM actor
        INNER JOIN person ON person.id_people = actor.id_people
        ");
     

        require "view/ListActors.php";
        
    }

         public function ListDirectors()  {

        $pdo= Connect:: seConnecter();
        $requete = $pdo->query("
     SELECT DISTINCT
            person.first_name,
            person.last_name,
        CONCAT(person.first_name, ' ', person.last_name) AS Nom_prenom
        FROM director
        INNER JOIN person ON person.id_people = director.id_people
        ");
     

        require "view/ListDirectors.php";
        
    }
}


?>
