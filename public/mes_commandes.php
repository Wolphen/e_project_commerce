<?php
require_once __DIR__ . '/../src/init.php';

function displayOrders(): string
{
    global $user;
    if ($user !== false) {
        $idUtilisateur = $user->id; 
        $pdo = requeteConnexion();

        $pdoStatement = $pdo->prepare("SELECT *
                                        FROM listcommandes c
                                        JOIN produit p ON c.produits = p.id
                                        WHERE c.acheteur = :idUtilisateur
                                        ORDER BY c.dateAcheter DESC");

        $pdoStatement->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
        $pdoStatement->execute();
        $result = $pdoStatement->fetchAll();

        $display = "<table class='table table-bordered'>";
        $display .= "<thead class='thead-dark'>";
        $display .= "<tr>";
        $display .= "<th scope='col'>Date</th>";
        $display .= "<th scope='col'>Adresse de Livraison</th>";
        $display .= "</tr>";
        $display .= "</thead>";
        $display .= "<tbody>";

        foreach ($result as $key) {
            $display .= "<tr>";
            $display .= "<td>{$key->dateAcheter}</td>";
            $display .= "<td>{$key->adress}</td>";
            $display .= "</tr>";
        }

        $display .= "</tbody>";
        $display .= "</table>";
    } else {
        $display = "<div class='alert alert-info'>Connectez-vous pour voir vos commandes.</div>";
    }

    return $display;
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
                <h1>Mes Commandes</h1>
                <?= displayOrders() ?>

                <?php if ($user !== false) : ?>
                    <a href="commentaire.php" class="btn btn-primary">Laisser un commentaire</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>