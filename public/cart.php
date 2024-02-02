<?php
require_once __DIR__ . '/../src/init.php';

function displayCart(): string
{
    global $user;
    if ($user !== false) {
        $idUtilisateur = $user->id; 
        $pdo = requeteConnexion();

        $pdoStatement = $pdo->prepare("SELECT *
                                        FROM produit p
                                        JOIN panier pa ON p.id = pa.idProduit
                                        WHERE pa.acheteur = :idUtilisateur
                                        ORDER BY p.nom ASC");

        $pdoStatement->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
        $pdoStatement->execute();
        $result = $pdoStatement->fetchAll();

        $display = "<form method='POST' action='actions/order.php'>";
        $display .= "<table class='table table-bordered'>";
        $display .= "<thead class='thead-dark'>";
        $display .= "<tr>";
        $display .= "<th scope='col'>Image</th>";
        $display .= "<th scope='col'>Nom</th>";
        $display .= "<th scope='col'>Description</th>";
        $display .= "<th scope='col'>Prix</th>";
        $display .= "<th scope='col'>Quantite</th>";
        $display .= "</tr>";
        $display .= "</thead>";
        $display .= "<tbody>";

        foreach ($result as $key) {
            $display .= "<tr>";
            $display .= "<td style='width: 100px; height: 100px; overflow: hidden;'><img src='$key->img' style='width: 100%; object-fit: cover;' class='img-fluid'></td>";
            $display .= "<td style='width: 150px;'><p>$key->nom</p></td>";
            $display .= "<td><p>$key->detail</p></td>";  
            $display .= "<td>$key->prix</td>";
            $display .= "<td>$key->quantiterProduit</td>";
            $display .= "</tr>";
        }

        $display .= "</tbody>";
        $display .= "</table>";
        $display .= "<input type='text' name='adresse' placeholder='Entrez votre adresse de livraison' required>"; /* ont met l'adresse de livraison obligatoire */
        $display .= "<input type='hidden' name='id' value='$key->idProduit'>";
        $display .= "<input type='hidden' name='nom' value='$key->nom'>";
        $display .= "<input type='hidden' name='quantite' value='$key->quantiterProduit'>";
        $display .= "<button type='submit' class='btn btn-primary' name='commanderTout'>Commander Tout le Panier</button>"; /* on setup ici le bouton pour commander */
        $display .= "</form>";
        $display .= "</div>";
    } else {
        $display = "<div class='alert alert-info'>Connectez-vous pour voir votre panier.</div>";
    }

    return $display;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require_once __DIR__ . '/../src/partials/head_css.php'; ?>
</head>
<body>
    <?php require_once __DIR__ . '/../src/partials/menu.php'; ?>
    <?php require_once __DIR__ . '/../src/partials/show_error.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Bonjour</h1>
                <div class="alert alert-success">
                    Voici votre panier  <?php if ($user != false) {
            echo $user->prenom;
        };?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
         <div class ="row">
             <div class="col">
            </div>
        </div>
    </div>

    <div class='container mt-4'>
        <?php 
        echo displayCart(); ?>
    </div>
</body>
</html>
