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


        require "view/listPerson.php";


        
    }

     public function listActors()  {
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
     

        require "view/listActors.php";
        
    }

         public function listDirectors()  {
            /**
     * Lister les réalisateurs
     */

        $pdo= Connect:: seConnecter();
        $requeteDirector = $pdo->query("
SELECT DISTINCT
            person.first_name,
            person.last_name,
            person.id_people
        FROM director
        INNER JOIN person ON person.id_people = director.id_people
        ");
     
//crée la "vue" ListDirectors.php afin de rendre le site dynamique
        require "view/listDirectors.php";
        
    }
    

         public function detailActors($id)  {


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
     

        require "view/detailActors.php";
        
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
     

        require "view/detailDirectors.php";
        
    }

public function deleteActor()
{
    $pdo = Connect::seConnecter();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_people'])) {
        $id_people = (int) $_POST['id_people'];

        try {
            // Optionnel : transaction pour sécurité
            $pdo->beginTransaction();

            // Supprimer le rôle acteur et uniquement acteur
            $stmt = $pdo->prepare("DELETE FROM actor WHERE id_people = :id");
            $stmt->execute(['id' => $id_people]);

            $pdo->commit();
        } catch (\Throwable $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            //insérer fonction récup erreur
        }

        header("Location: index.php?action=listActors");
        exit;
    }

    
    header("Location: index.php?action=listActors");
    exit;
}

public function deleteDirector()
{
    $pdo = Connect::seConnecter();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_people'])) {
        $id_people = (int) $_POST['id_people'];

        try {
            // Optionnel : transaction pour sécurité
            $pdo->beginTransaction();

            // Supprimer le rôle acteur et uniquement acteur
            $stmt = $pdo->prepare("DELETE FROM director WHERE id_people = :id");
            $stmt->execute(['id' => $id_people]);

            $pdo->commit();
        } catch (\Throwable $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            //insérer fonction récup erreur
        }

        header("Location: index.php?action=listDirectors");
        exit;
    }

    
    header("Location: index.php?action=listDirectors");
    exit;
}

public function deleteTypeFIlm()
{
    $pdo = Connect::seConnecter();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_type_film'])) {
        $id_people = (int) $_POST['id_type_film'];

        try {
            // Optionnel : transaction pour sécurité
            $pdo->beginTransaction();

            // Supprimer le rôle acteur et uniquement acteur
            $stmt = $pdo->prepare("DELETE FROM film_type WHERE id_type_film= :id");
            $stmt->execute(['id' => $id_people]);

            $pdo->commit();
        } catch (\Throwable $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
             die("Erreur suppression : " . $e->getMessage());
        }

        header("Location: index.php?action=listDirectors");
        exit;
    }

 
}


}


?>
