<?php
require_once __DIR__ . '/../src/init.php';

function displayCart(): string
{
    global $user;
    if ($user !== false) {
        $idUtilisateur = $user->id; 
        $pdo = requeteConnexion();

        $pdoStatement = $pdo->prepare("SELECT p.img, p.nom, p.detail, p.prix, pa.quantiterProduit
                                        FROM produit p
                                        JOIN panier pa ON p.id = pa.idProduit
                                        WHERE pa.acheteur = :idUtilisateur
                                        ORDER BY p.nom ASC");

        $pdoStatement->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
        $pdoStatement->execute();
        $result = $pdoStatement->fetchAll();

        $display = "";
        foreach ($result as $key) {
            $display .= "<tr>";
            $display .= "<td style='width: 100px; height: 100px; overflow: hidden;'><img src='$key->img' style='width: 100%; object-fit: cover;' class='img-fluid'></td>";
            $display .= "<td style='width: 150px;'><p>$key->nom</p></td>";
            $display .= "<td><p>$key->detail</p></td>";  
            $display .= "<td>$key->prix</td>";
            $display .= "<td>$key->quantiterProduit</td>
                    <input type='hidden' name='prix' value='$key->prix'>
                    <input type='hidden' name='quantite' value='1'>
                    <input type='hidden' name='nom' value='$key->nom'>";
            
            $display .= "</tr>";
        }
        $display .= "<button type='submit' class='btn btn-primary btn-sm''>Ajouter au panier</button>";
        $display .= "</form>";
        $display .= "</table>";
        $display .= "                <label>Livraison uniquement en île-de-france</label>
                                     <label>Vérifier bien votre adresse car vous n'aurez le droit qu'à une chance, ou alors vous devrez nous contacter si vous vous tromper à l'adresse
                                     quoicoupagnant@esiee-grayeit.true.</label>
        <input type='text' name='adress' id='adress' placeholder='Numéro de rue, nom de la rue, département, code postale' style='width: 500px;'>";
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
        <form method ='POST' action='cart.php'>
            <table class='table table-bordered'> 
                <thead class='thead-dark'>
                        <button href="/actions/requestCommand.php">Supprimer les articles du panier</button>
                        <button href="/public/actions/requestCommand.php">Passer la commande</button>
                    <tr>
                        <th scope='col'>Image</th>
                        <th scope='col'>Nom</th>
                        <th scope='col'>Description</th>
                        <th scope='col'>Prix</th>
                        <th scope='col'>Quantite</th>
                        <?php echo displayCart(); ?>
                    </tr>
                </thead>
            </table>
        </form>
    </div>
</body>
</html>
