<?php

namespace Controller;
use Model\Connect;

class PersonController {

    

     public function ListActors()  {
        /**
     * Lister les acteurs
     */

        $pdo= Connect:: seConnecter();
        $requete = $pdo->query("
        SELECT 
            person.first_name,
            person.last_name,
            person.id_people
        
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
            person.last_name,
            film.title,
            id_film
        FROM director
        INNER JOIN person ON person.id_people = director.id_people
		INNER JOIN film ON  film.id_film = director.id_director
        ");
     
//crée la "vue" ListDirectors.php afin de rendre le site dynamique
        require "view/ListDirectors.php";
        
    }
    

         public function DetailActors($id)  {


        $pdo= Connect:: seConnecter();
        $requete = $pdo->prepare("
SELECT
        film.id_film,
  film.title AS film,
  CONCAT(person.first_name, ' ', person.last_name) AS acteurs,
  film.release_year_france AS année_de_sortie,
  film_role.name_role AS rôle
FROM
  film
INNER JOIN
  play ON film.id_film = play.id_film
INNER JOIN
  film_role ON play.id_role = film_role.id_role
INNER JOIN
  actor ON play.id_actor = actor.id_actor
INNER JOIN
  person ON actor.id_people = person.id_people
WHERE
  play.id_actor = :id;
        ");
         $requete->execute(["id" => $id]);
     

        require "view/DetailActors.php";
        
    }

 


}


?>
