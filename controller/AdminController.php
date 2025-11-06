<?php

namespace Controller;
use Model\Connect;

class AdminController {

    public function ajouterGenre() {
        $pdo = Connect::seConnecter();

        // Vérifier que le formulaire a bien été soumis a refaire
        if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["nouveau_genre"])) {
            // Sécuriser l'entrée utilisateur
           
              $nouveauGenre = filter_input (INPUT_POST,"nouveau_genre", FILTER_SANITIZE_SPECIAL_CHARS);
            if ($nouveauGenre !== "") {
                // Vérifier que le genre n’existe pas déjà
                $verif = $pdo->prepare("SELECT COUNT(*) FROM film_type WHERE labelled = :labelled");
                $verif->execute(["labelled" => $nouveauGenre]);
                $existe = $verif->fetchColumn();

                if ($existe == 0) {
                    
                    $requete = $pdo->prepare("
                        INSERT INTO film_type (labelled)
                        VALUES (:labelled)
                    ");
                    $requete->bindValue(":labelled", $nouveauGenre, \PDO::PARAM_STR);
                    $requete->execute();
    

                    // Redirection vers la liste des genres après ajout
                    header("Location: index.php?action=listGenres");
                    exit;
                } else {
                    // Message si le genre existe déjà
                    echo "<p class='text-danger text-center'> Ce genre existe déjà.</p>";
                }
            } else {
                echo "<p class='text-danger text-center'> Le nom du genre ne peut pas être vide.</p>";
            }
        }
    }

        public function addFilms() {
        $pdo = Connect::seConnecter();

        // Vérifier que le formulaire a bien été soumis
        if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["new_films"])) {
            // Sécuriser l'entrée utilisateur
         
              $newFilms = filter_input (INPUT_POST,"new_films", FILTER_SANITIZE_SPECIAL_CHARS);

            if ($newFilms !== "") {
                // Vérifier que le genre n’existe pas déjà
                $verif = $pdo->prepare("SELECT COUNT(*) FROM film WHERE title = :title");
                $verif->execute(["title" => $newFilms]);
                $existe = $verif->fetchColumn();

                if ($existe == 0) {
                    
                    $requete = $pdo->prepare("
                        INSERT INTO film (title)
                        VALUES (:title)
                    ");
                    $requete->bindValue(":title", $newFilms, \PDO::PARAM_STR);
                    $requete->execute();

                    // Redirection vers la liste des genres après ajout
                    header("Location: index.php?action=listFilms");
                    exit;
                } else {
                    // Message si le genfilm re existe déjà
                    echo "<p class='text-danger text-center'> Ce film existe déjà.</p>";
                }
            } else {
                echo "<p class='text-danger text-center'> Le nom du film ne peut pas être vide.</p>";
            }
        }
    }


        public function addPerson() {
    $pdo = Connect::seConnecter(); //a mettre filter imput

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      //  $first_name = trim($_POST["first_name"]);
          $first_name = filter_input (INPUT_POST,"first_name", FILTER_SANITIZE_SPECIAL_CHARS);

       // $last_name = trim($_POST["last_name"]);
          $last_name = filter_input (INPUT_POST,"last_name", FILTER_SANITIZE_SPECIAL_CHARS);

        $birthday =  filter_input (INPUT_POST,"birthday", FILTER_SANITIZE_SPECIAL_CHARS);
        $gender =  filter_input (INPUT_POST,"gender", FILTER_SANITIZE_SPECIAL_CHARS);

        // Ces deux cases peuvent être cochées indépendamment
        $isActor = isset($_POST["is_actor"]);
        $isDirector = isset($_POST["is_director"]);

        if ($first_name && $last_name && $birthday && $gender) {
            try {
                $pdo->beginTransaction();

                // 1 Insertion dans `person`
                $stmt = $pdo->prepare("
                    INSERT INTO person (first_name, last_name, birthday, gender)
                    VALUES (:first_name, :last_name, :birthday, :gender)
                ");
                $stmt->execute([
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "birthday" => $birthday,
                    "gender" => $gender
                ]);

                //  Récupération du dernier id_people
                $id_people = $pdo->lastInsertId();

                //  Si acteur → insertion dans `actor`
                if ($isActor) {
                    $stmtActor = $pdo->prepare("INSERT INTO actor (id_people) VALUES (:id_people)");
                    $stmtActor->execute(["id_people" => $id_people]);
                }

                //  Si réalisateur → insertion dans `director`
                if ($isDirector) {
                    $stmtDirector = $pdo->prepare("INSERT INTO director (id_people) VALUES (:id_people)");
                    $stmtDirector->execute(["id_people" => $id_people]);
                }

                $pdo->commit();

                // Redirection vers une page de confirmation ou de liste
                header("Location: index.php?action=listPerson");
                exit;

            } catch (\PDOException $e) {
                $pdo->rollBack();
                echo "<p class='text-danger'>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
            }
        } else {
            echo "<p class='text-warning'> Veuillez remplir tous les champs obligatoires.</p>";
        }
    }

    // Afficher le formulaire d’ajout
    require "view/person.php";
}


//creer fonction update

      public function updatePerson() {
    $pdo = Connect::seConnecter(); //a mettre filter imput

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      //  $first_name = trim($_POST["first_name"]);
          $first_name = filter_input (INPUT_POST,"first_name", FILTER_SANITIZE_SPECIAL_CHARS);

       // $last_name = trim($_POST["last_name"]);
          $last_name = filter_input (INPUT_POST,"last_name", FILTER_SANITIZE_SPECIAL_CHARS);

        $birthday = $_POST["birthday"] ?? null;
        $gender = $_POST["gender"] ?? null;

        // Ces deux cases peuvent être cochées indépendamment
        $isActor = isset($_POST["is_actor"]);
        $isDirector = isset($_POST["is_director"]);

        if ($first_name && $last_name && $birthday && $gender) {
            try {
                $pdo->beginTransaction();

                // 1 Insertion dans `person`
                $stmt = $pdo->prepare("
                    INSERT INTO person (first_name, last_name, birthday, gender)
                    VALUES (:first_name, :last_name, :birthday, :gender)
                ");
                $stmt->execute([
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "birthday" => $birthday,
                    "gender" => $gender
                ]);

                //  Récupération du dernier id_people
                $id_people = $pdo->lastInsertId();

                //  Si acteur → insertion dans `actor`
                if ($isActor) {
                    $stmtActor = $pdo->prepare("INSERT INTO actor (id_people) VALUES (:id_people)");
                    $stmtActor->execute(["id_people" => $id_people]);
                }

                //  Si réalisateur → insertion dans `director`
                if ($isDirector) {
                    $stmtDirector = $pdo->prepare("INSERT INTO director (id_people) VALUES (:id_people)");
                    $stmtDirector->execute(["id_people" => $id_people]);
                }

                $pdo->commit();

                // Redirection vers liste personnes
                 header("Location: index.php?action=listActors");
                exit;

            } catch (\PDOException $e) {
                $pdo->rollBack();
                echo "<p class='text-danger'>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
            }
        } else {
            echo "<p class='text-warning'> Veuillez remplir tous les champs obligatoires.</p>";
        }
    }

    // Afficher le formulaire d’ajout
    require "view/person.php";
}

//creer fonction effacer
public function deletefilm()
{
    $pdo = Connect::seConnecter();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_film'])) {
        $id_film = (int) $_POST['id_film'];

        try {
            // Optionnel : transaction pour sécurité
            $pdo->beginTransaction();

            // Supprimer le type de film
            $stmt = $pdo->prepare("DELETE FROM film WHERE id_film = :id");
            $stmt->execute(['id' => $id_film]);

            $pdo->commit();
        } catch (\Throwable $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            die("Erreur suppression : " . $e->getMessage()); // voir les message d'erreurs au lieu de repasser sur accueil
        }

        header("Location: index.php?action=listFilms"); //redirection apres suppression
        exit;
    }


}

}

?>
