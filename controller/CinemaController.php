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

    // S'assurer que PDO lance des exceptions (utile pour debug)
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_type_film'])) {
        $id_type_film = (int) $_POST['id_type_film'];

        try {
            $pdo->beginTransaction();

            // 1) Supprimer les relations dans la table 'belong' si elles existent
            $stmtBelong = $pdo->prepare("DELETE FROM belong WHERE id_type_film = :id");
            $stmtBelong->execute(['id' => $id_type_film]);
            // facultatif : $deletedBelong = $stmtBelong->rowCount();

            // 2) Supprimer le type de film
            $stmtType = $pdo->prepare("DELETE FROM film_type WHERE id_type_film = :id");
            $stmtType->execute(['id' => $id_type_film]);
            $deleted = $stmtType->rowCount();

            if ($deleted === 0) {
                // pas de ligne supprimée → id introuvable
                $pdo->rollBack();
                // message d'erreur utile pour debug ; en production, logguer au lieu de die()
                die("Aucun genre trouvé avec id = {$id_type_film} — suppression annulée.");
            }

            $pdo->commit();

            // redirection si OK
            header("Location: index.php?action=ListTypeFilms");
            exit;
        } catch (\Throwable $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            // Affiche l'erreur pour debug ; remplacer par un log en production
            die("Erreur lors de la suppression : " . $e->getMessage());
        }
    }

    // Si pas de POST ou champ manquant, renvoyer vers la liste
    header("Location: index.php?action=ListTypeFilms");
    exit;
}





}
