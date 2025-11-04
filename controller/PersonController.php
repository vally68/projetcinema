<?php

namespace Controller;
use Model\Connect;

class PersonController {

    public function listActorsAndDirectors()  {
        /**
     * Lister les acteurs
     */

        $pdo= Connect:: seConnecter();
        $requeteActor = $pdo->query("
        SELECT 
            person.first_name,
            person.last_name,
            person.id_people
        
        FROM actor
        INNER JOIN person ON person.id_people = actor.id_people
        
        ");

        $pdo= Connect:: seConnecter();
     $requeteDirector = $pdo->query("
        SELECT DISTINCT
            person.first_name,
            person.last_name,
            person.id_people
        FROM director
        INNER JOIN person ON person.id_people = director.id_people
        ");


        require "view/ListPerson.php";


        
    }

     public function ListActors()  {
        /**
     * Lister les acteurs
     */

        $pdo= Connect:: seConnecter();
        $requeteActor = $pdo->query("
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
        $requeteDirector = $pdo->query("
SELECT DISTINCT
            person.first_name,
            person.last_name
        FROM director
        INNER JOIN person ON person.id_people = director.id_people
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
  person.id_people = :id
        ");
         $requete->execute(["id" => $id]);
     

        require "view/DetailActors.php";
        
    }

     public function detailDirectors($id)  {


        $pdo= Connect:: seConnecter();
        $requete5 = $pdo->prepare("
 SELECT 
    film.id_film, 
    film.title AS film_real,
    film.id_director,
     person.gender AS Genre,
CONCAT(person.first_name, ' ', person.last_name) AS Nom_prénom 
FROM film
INNER JOIN director 
    ON film.id_director = director.id_director
INNER JOIN person 
    ON director.id_people = person.id_people
   WHERE
  person.id_people = :id
        ");
         $requete5->execute(["id" => $id]);
     

        require "view/DetailDirectors.php";
        
    }

}


?>
