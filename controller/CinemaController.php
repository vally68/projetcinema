<?php

namespace Controller;
use Model\Connect;

class CinemaController {

    public function ListFilms() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("SELECT id_film, title, release_year_france FROM film");
        require "view/ListFilms.php";
    }

    public function DetailFilms($id) {
        $pdo = Connect::seConnecter();

        $requete = $pdo->prepare("SELECT * FROM film WHERE id_film = :id");
        $requetecasting = $pdo->prepare("
            SELECT
        film.id_film,
        film.title AS titres,
        film.release_year_france,
        film_type.id_type_film,
        film_type.labelled AS genre
    FROM film
    INNER JOIN belong ON film.id_film = belong.id_film
    INNER JOIN film_type ON belong.id_type_film = film_type.id_type_film
    WHERE film_type.id_type_film = :id
    ORDER BY film.title ASC
        ");

        $requete->execute(["id" => $id]);
        $requetecasting->execute(["id" => $id]);

        require "view/DetailFilms.php";
    }

    // Liste de tous les genres avec films associés
    public function ListTypesFilms() {
        $pdo = Connect::seConnecter();
        $requeteGF = $pdo->query("
            SELECT 
                film_type.id_type_film,
                film_type.labelled AS genre,
                GROUP_CONCAT(film.title SEPARATOR ', ') AS titres
            FROM film_type
            LEFT JOIN belong ON film_type.id_type_film = belong.id_type_film
            LEFT JOIN film ON belong.id_film = film.id_film
            GROUP BY film_type.id_type_film, film_type.labelled
            ORDER BY film_type.labelled ASC
        ");

        require "view/ListTypeFilms.php";
    }

    // Liste des films pour un genre spécifique
    public function ListTypeFilms($id) {
        $pdo = Connect::seConnecter();
        $requeteGF = $pdo->prepare("
            SELECT 
                film.id_film,
                film.title AS titres,
                film.release_year_france,
                film_type.labelled AS genre
            FROM film
            INNER JOIN belong ON film.id_film = belong.id_film
            INNER JOIN film_type ON belong.id_type_film = film_type.id_type_film
            WHERE film_type.id_type_film = :id
            ORDER BY film.title ASC
        ");

        $requeteGF->execute(["id" => $id]);

        require "view/ListTypeFilms.php";
    }


public function deletetypefilm()
{
    $pdo = Connect::seConnecter();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_type_film'])) {
        $id_people = (int) $_POST['id_type_film'];

        try {
            // Optionnel : transaction pour sécurité
            $pdo->beginTransaction();

            // Supprimer le type de film
            $stmt = $pdo->prepare("DELETE FROM film_type WHERE id_film_type = :id");
            $stmt->execute(['id' => $id_people]);

            $pdo->commit();
        } catch (\Throwable $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
              die("Erreur suppression : " . $e->getMessage());
        }

        header("Location: index.php?action=ListTypeFilms");
        exit;
    }

    
    header("Location: index.php?action=ListTypeFilms");
    exit;
}



}
