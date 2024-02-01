<?php
require_once __DIR__ . '/../src/init.php';

function displayCart(): string
{
    global $user;
    if ($user !== false) {
        $idUtilisateur = $user->id; 
        $pdo = requeteConnexion();

        $pdoStatement = $pdo->prepare("SELECT p.img, p.nom, p.detail, p.prix
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
            $display .= "</tr>";
        }

        $display .= "</table>";
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
                    <tr>
                        <th scope='col'>Image</th>
                        <th scope='col'>Nom</th>
                        <th scope='col'>Description</th>
                        <th scope='col'>Prix</th>
                        <?php echo displayCart(); ?>
                    </tr>
                </thead>
            </table>
        </form>
    </div>
</body>
</html>