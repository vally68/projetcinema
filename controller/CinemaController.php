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

    
    
public function DetailFilms($id) {
    //connexion bdd
    $pdo = Connect::seConnecter();

    // Requête pour les infos du film
    $requete = $pdo->prepare("
        SELECT * 
        FROM film 
        WHERE id_film = :id
    ");

    // Requête pour le casting
    $requetecasting = $pdo->prepare("
        SELECT
            film.title AS film,
            person.first_name,
            person.last_name AS acteur,
            person.gender AS sexe
        FROM
            film
        INNER JOIN play ON film.id_film = play.id_film
        INNER JOIN actor ON play.id_actor = actor.id_actor
        INNER JOIN person ON actor.id_people = person.id_people
        WHERE play.id_film = :id
    ");

    // Exécution des requêtes
    $requete->execute(["id" => $id]);
    $requetecasting->execute(["id" => $id]);
   
    require "view/DetailFilms.php";
}

//requete liste genre film

    public function ListTypeFilms($id)  {

        $pdo= Connect:: seConnecter();
        $requeteGF = $pdo->prepare("

 SELECT 
    film_type.labelled AS genre,
    film.id_film AS nombre_film_par_genre,
    film.title   AS titres
FROM 
    film
INNER JOIN 
    belong ON film.id_film = belong.id_film
INNER JOIN 
    film_type ON belong.id_type_film = film_type.id_type_film
    WHERE film_type.id_type_film = :id

        ");

    $requeteGF->execute(["id" => $id]);
    
 
    require "view/ListTypeFilms.php";
        
    }


}


?>
