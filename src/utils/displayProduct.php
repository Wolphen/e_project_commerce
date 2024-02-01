<?php
require_once __DIR__ . '/../init.php';
$iduser = 0;
if ($user != false) {
    $iduser = $user->id;
}

function addToTheCart(int $idd, string $nom, float $prix, int $quantity, $iduser)
{
    $pdo = requeteConnexion();
    $pdoStatement = $pdo->prepare("INSERT INTO panier (nomProduit, acheteur, price, idProduit, quantiterProduit)
    VALUES (:nomProduit, :acheteur, :price, :idProduit, :quantiterProduit)");
    $pdoStatement->execute([
        ":nomProduit" => $nom,
        ":acheteur" => $iduser,
        ":price" => $prix,
        ":idProduit" => $idd,
        ":quantiterProduit" => $quantity
    ]);
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
    <title>Document</title>
</head>

<body>
    <div class='container mt-4'>
        <form method='post'>
        <table class='table table-bordered'>
            <thead class='thead-dark'>
                <tr>
                    <th scope='col'>Image</th>
                    <th scope='col'>Nom</th>
                    <th scope='col'>Description</th>
                    <th scope='col'>Prix</th>
                    <th scope='col'>Commentaire</th>
                    <th scope='col' style='width: 50px;'>Étoile</th>
                    <th scope='col' style='width: 80px;'>Action</th>
                </tr>
            </thead>
    <tbody>
</body>

</html>
