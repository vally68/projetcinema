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
    



}


?>
