<?php
require_once __DIR__ . '/../src/init.php';
require_once __DIR__ . '/../src/partials/menu.php';
require_once __DIR__ . '/../src/partials/show_error.php';
require_once __DIR__ . '/../src/utils/createProduct.php';
require_once __DIR__ . '/../src/utils/supprProduct.php';
require_once __DIR__ . '/../src/partials/head_css.php';
require_once __DIR__ . '/../src/utils/requestCommand.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.php">Index</a>
    <div>
        <h1>Création d'un produit</h1>
        <form method="post">
            <input type="text" name = "nomProduit" placeholder="Nom">
            <br>
            <input type="number" name = "prix" placeholder="Prix"><label for="">€</label>
            <br>
            <input type="text" name = "description" placeholder="Description">
            <br>
            <input type="number" name = "quantite" placeholder="Quantité">
            <br>
            <input type="text" name = "urlImage" placeholder="URL Image">
            <br>
            <input type="submit">
            <?php 
            $nomProduit = $_POST['nomProduit'] ?? '';
            $prix = $_POST['prix'] ?? '';
            $description = $_POST['description'] ?? '';
            $quantite = $_POST['quantite'] ?? '';
            $urlImage = $_POST['urlImage'] ?? '';
            try {
                if (isset($_POST['nomProduit'], $_POST['prix'], $_POST['description'], $_POST['quantite'], $_POST['urlImage'])) {
                    addProduct($nomProduit, $prix, $description, $quantite, $urlImage);
                    echo "Ajout réussi !";
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            ?>
        </form>
        <div class="container">
        <div class="row">
            <div class="col">
                <h1>Bonjour</h1>
                <div class="alert alert-success">
                    Bienvenue dans ton panier ou tu peut tout supprimer ou ajouter  <?php if ($user != false) {
            echo $user->prenom;
        };?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
         <div class ="row">
             <div class="col">
                 <?php echo displayAllProductToDelete(); 
                 ?>
               
            </div>
        </div>
    </div>
</body>
</html>