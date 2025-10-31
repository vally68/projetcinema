<?php
$rows = array();
require_once('config.php');
require_once('DB.php');

$DB=NULL;


session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != 1) {
    header('Location: ../espacemembres/espacemembre.php');
    exit;
}


try {


    $DB = new DB();


  if (isset($_POST['action'])) {

        // Récupération des données du formulaire
        $action = $_POST['action'];
        $figurines_id = isset($_POST['figurines_id']) ? $_POST['figurines_id'] : null;
        $figurines_name = $_POST['figurines_name'];
        $figurines_price = $_POST['figurines_price'];
        $figurine_pics = $_POST['figurine_pics'];
        $figurine_stock = $_POST['figurine_stock'];
        $figurine_etat = $_POST['figurine_etat'];
        $figurine_type = $_POST['figurine_type'];



        {
            // Traitement des actions //query $this->_DB->
            switch ($action) {
                case 'insert':
                 $image_dir = "../Image/Boutique/Figurine";
                 $uploaded_file = $_FILES['figurine_image']['tmp_name'];
        $file_name = $_FILES['figurine_image']['name'];
          $target_file = $image_dir . "/" . $file_name;
        move_uploaded_file($uploaded_file, $target_file);

        $target_file = $image_dir . "/" . $file_name;
        move_uploaded_file($uploaded_file, $target_file);
                    $sql ="INSERT INTO figurines(figurines_name, figurines_price, figurine_pics, figurine_stock,figurine_etat,figurine_type) VALUES (:figurines_name, :figurines_price, :figurine_pics, :figurine_stock,:figurine_etat,:figurine_type);";                 
                    $DB->query($sql);
                    $DB->bind(':figurines_name', $figurines_name);
                    $DB->bind(':figurines_price', $figurines_price);
                    $DB->bind(':figurine_pics', $file_name);
                    $DB->bind(':figurine_stock', $figurine_stock);
                    $DB->bind(':figurine_etat', $figurine_etat);
                    $DB->bind(':figurine_type', $figurine_type);
                    $DB->single_insert();
                   
                    break;
                case 'update':
                    $sql ="UPDATE figurines SET figurines_name = :figurines_name, figurines_price = :figurines_price, figurine_pics = :figurine_pics, figurine_stock = :figurine_stock, figurine_etat = :figurine_etat, figurine_type= :figurine_type WHERE figurines_id = :figurines_id";
                    $stmt = $DB->query($sql);
                    $DB->bind(':figurines_id', $figurines_id);
                    $DB->bind(':figurines_name', $figurines_name);
                    $DB->bind(':figurines_price', $figurines_price);
                    $DB->bind(':figurine_pics', $figurine_pics);
                    $DB->bind(':figurine_stock', $figurine_stock);
                    $DB->bind(':figurine_etat', $figurine_etat);
                    $DB->bind(':figurine_type', $figurine_type);
                    $DB->updateAllTable();
                    break;
                case 'delete':
                    $sql ="DELETE FROM figurines WHERE figurines_id = :figurines_id;";
                    $DB->query($sql);
                    $DB->bind(':figurines_id', $figurines_id);
                    $DB->execute();
                    break;
                default:
                    echo "Erreur : action non reconnue";
            }

        }
    }
     $sql = "SELECT * FROM figurines;";
     $stmt = $DB->query($sql);
     $rows=$DB->resultset();


} catch (PDOException $e) {
    echo "Échec : " . $e->getMessage();
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion figurines</title>
      <style>

</style>
<link href="../Ressource/back.css" style rel="stylesheet"> 
<link href="../Ressource/backresp.css" style rel="stylesheet"> 
</head>
<body>
<div class="enhaut">
    <form action="" method="post" enctype="multipart/form-data">

    <h1>Ajouter dans la base de données figurines</h1>
        <input type="hidden" name="action" value="insert"> <!-- Changer la valeur pour 'update' ou 'delete' selon l'opération souhaitée -->
        <input type="hidden" name="id" value="1"> <!-- L'ID de l'enregistrement à modifier ou supprimer, si nécessaire -->
        <input type="text" name="figurines_name" placeholder="Nom">
        <input type="text" name="figurines_price" placeholder="Prix">
        <input type="hidden" name="figurine_pics" value="<?php echo (isset($file_name)) ? $file_name : ''; ?>">

        <input type="text" name="figurine_stock" placeholder="Stock">

         <select name="figurine_etat" id="figurine_etat">
            <option value="Neuf">Neuf</option>
            <option value="occasion">Occasion</option>
        </select>

 <select name="figurine_type" id="figurine_type">
            <option value="Amiibo">Amiibo</option>
            <option value="Statuette">Statuette</option>
            <option value="Pop">Pop</option>
        </select>
                <input type="file" name="figurine_image">
        <input type="submit" value="Envoyer">
    </form></div>
<br>
    <table id="pip">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Image</th>
            <th>Stock</th>
            <th>Etat</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rows as $row): ?>
            <tr>
                <form action="" method="post">
                    <td><?php echo $row['figurines_id']; ?></td>
                    <td><input type="text" name="figurines_name" value="<?php echo $row['figurines_name']; ?>"></td>
                    <td><input type="text" name="figurines_price" value="<?php echo $row['figurines_price']; ?>"></td>
                    <td><input type="text" name="figurine_pics" value="<?php echo $row['figurine_pics']; ?>"></td>
                    <td><input type="text" name="figurine_stock" value="<?php echo $row['figurine_stock']; ?>"></td>
                    <td>
                        <select name="figurine_etat" id="figurine_etat">
                            <option value="neuf" <?php echo ($row['figurine_etat'] == "neuve") ? "selected" : ""; ?>>Neuve</option>
                            <option value="occasion" <?php echo ($row['figurine_etat'] == "occasion") ? "selected" : ""; ?>>Occasion</option>
                        </select></td>

                    <td>
                        <select name="figurine_type" id="figurine_type">
                            <option value="Amiibo" <?php echo ($row['figurine_type'] == "Amiibo") ? "selected" : ""; ?>>Amiibo</option>
                            <option value="Statuette" <?php echo ($row['figurine_type'] == "Statuette") ? "selected" : ""; ?>>Statuette</option>
                            <option value="Pop" <?php echo ($row['figurine_type'] == "Pop") ? "selected" : ""; ?>>Pop</option>
                        </select>                        
                    </td>

                    <td>
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="figurines_id" value="<?php echo $row['figurines_id']; ?>">
                        <input type="submit" value="Modifier">
                    </form>
                    <form action="" method="post">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="figurines_id" value="<?php echo $row['figurines_id']; ?>">
    <input type="hidden" name="figurines_name" value="<?php echo $row['figurines_name']; ?>">
    <input type="hidden" name="figurines_price" value="<?php echo $row['figurines_price']; ?>">
    <input type="hidden" name="figurine_pics" value="<?php echo $row['figurine_pics']; ?>">
    <input type="hidden" name="figurine_stock" value="<?php echo $row['figurine_stock']; ?>">
    <input type="hidden" name="figurine_etat" value="<?php echo $row['figurine_etat']; ?>">
    <input type="hidden" name="figurine_type" value="<?php echo $row['figurine_type']; ?>">

    <input type="submit" value="Supprimer">
</form>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>

 <?php
  $top= 0;
// Tableau contenant les liens et les noms des pages à afficher
$links = [
    ['url' => 'backofficeindex.php', 'text' => 'Accueil gestion boutique'],
    ['url' => 'gconsole.php', 'text' => 'gestion console'],
    ['url' => 'gvetements.php', 'text' => 'gestion vetements'],
    ['url' => 'glivres.php', 'text' => 'gestion livres'],
    ['url' => 'gjeux.php', 'text' => 'gestion jeux'],
    ['url' => 'gretro.php', 'text' => 'gestion jeux rétro'],
    ['url' => 'figurines.php', 'text' => 'gestion figurines'],
];

// Génère les boutons pour chaque lien
foreach ($links as $link) {
    echo '<div style="position: fixed; top: ' . ($top += 25) . 'px; right: 10px;">
        <a href="' . $link['url'] . '"><button>' . $link['text'] . '</button></a>
    </div>';
}
?>
<div id="essai"><h3>
<a href="backofficeindex.php"> Retour Index</a> <br/>
<a href="gconsole.php">Gestion Console</a> <br/>
<a href="gvetements.php">Gestion Vetements</a> <br/>
<a href="glivres.php">Gestion Livres</a> <br/>
<a href="gjeux.php">Gestion jeux</a> <br/>
<a href="gretro.php">Gestion jeux rétro</a> <br/>
<a href="figurines.php">Gestion figurines</a> <br/>
</h3>
  </div>
  
</body>
</html>
