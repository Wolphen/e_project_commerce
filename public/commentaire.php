<?php
require_once __DIR__ . '/../src/init.php';
$iduser = 0;
if ($user != false) {
    $iduser = $user->id;
}

function displayAllProduct(): string
{
    global $iduser;
    global $user;

    $pdo = requeteConnexion();
    $pdoStatement = $pdo->prepare("SELECT * 
    FROM produit 
    ORDER BY nom ASC");
    $pdoStatement->execute();
    $result = $pdoStatement->fetchAll();

    $display = "";
    foreach ($result as $key) {
        $display .= "<tr>";
        $display .= "<td style='width: 100px; height: 100px; overflow: hidden;'><img src='$key->img' style='width: 100%; object-fit: cover;' class='img-fluid'></td>";
        $display .= "<td style='width: 150px;'><p>$key->nom</p></td>";
        $display .= "<td><p>$key->detail</p></td>";
        $display .= "<td>$key->prix</td>";
        $display .= "<td><p>Commentaire</p></td>";
        $display .= "<td><p>Étoile</p></td>";
        $display .= "<td>
                        <form action='index.php' method='POST'>
                            <input type='hidden' name='id' value='$key->id'>
                            <input type='hidden' name='prix' value='$key->prix'>
                            <input type='hidden' name='quantite' value='1'>
                            <input type='hidden' name='nom' value='$key->nom'>
                            <button type='submit' class='btn btn-primary btn-sm''>Ajouter au panier</button>
                        </form>
                    </td>";
        $display .= "</tr>";
    }

    $display .= "</tbody>";
    $display .= "</table>";
    $display .= "</form>";
    $display .= "</div>";

    return $display;
}

if ($user && isset($iduser) && !empty($_POST['id'])) {
    $idd = $_POST['id'] ?? '';
    $nom = $_POST['nom'] ?? '';
    $prix = $_POST['prix'] ?? '';
    $quantity = $_POST['quantite'] ?? '';

    try {
        addToTheCart($idd, $nom, $prix, $quantity, $iduser);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    
}


    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Commandes</title>
    <?php require_once __DIR__ . '/../src/partials/head_css.php'; ?>
</head>
<body>
    <?php require_once __DIR__ . '/../src/partials/menu.php'; ?>
    <?php require_once __DIR__ . '/../src/partials/show_error.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Commentaires</h1>
                <?php echo displayAllProduct() ?>
                <?php if ($user !== false) : ?>
                    <a href="commentaire.php" class="btn btn-primary">Laisser un commentaire</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>