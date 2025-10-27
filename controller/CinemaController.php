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
        /**
     * Lister les acteurs
     */

        $pdo= Connect:: seConnecter();
        $requete = $pdo->query("
        SELECT 
            person.first_name,
            person.last_name
        
        FROM actor
        INNER JOIN person ON person.id_people = actor.id_people
        ");
     

        require "view/ListActors.php";
        
    }

         public function ListDirectors()  {
            /**
     * Lister les réalisateurs
     */

        $pdo= Connect:: seConnecter();
        $requete = $pdo->query("
     SELECT DISTINCT
            person.first_name,
            person.last_name
        FROM director
        INNER JOIN person ON person.id_people = director.id_people
        ");
     
//crée la "vue" ListDirectors.php afin de rendre le site dynamique
        require "view/ListDirectors.php";
        
    }
    
  public function DetailFilms($id) {
    $pdo = Connect::seConnecter();
    $requete = $pdo->prepare("
        SELECT * 
        FROM film 
        WHERE id_film = :id
    ");
    $requete->execute(["id" => $id]);
    require "view/DetailFilms.php";
}


}


?>
