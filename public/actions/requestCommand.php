<?php 
require_once __DIR__ . '/../init.php';
$iduser = 0;
if ($user != false) {
    $iduser = $user->id;
}
function addToCommandPasser(int $idd, string $nom, float $prix, int $quantity, $iduser, string $adress)
{
    $pdo = requeteConnexion();

    $existingProduct = $pdo->prepare("SELECT idProduit, quantiterProduit FROM panier WHERE idProduit = :idProduit AND acheteur = :acheteur");
    $existingProduct->execute([
        ":idProduit" => $idd,
        ":acheteur" => $iduser
    ]);

  

   
        $pdoStatement = $pdo->prepare("INSERT INTO listCommandes (acheteur, productName, idProduct, prix, adress, quantiterProduit)
        VALUES ( :acheteur, :productName, :idProduct, :prix, :adress, quantiterProduit)");
        $pdoStatement->execute([
            ":nomProduit" => $nom,
            ":acheteur" => $iduser,
            ":price" => $prix,
            ":idProduct" => $idd,
            ":quantiterProduit" => $quantity,
            ":adress" => $adress
        ]);
    
}

if ($user && isset($iduser) && !empty($_POST['id']) && !empty($_POST['adress'])) {
    $nameProduct = $_POST['nom'] ?? '';
    $price = $_POST['prix'] ?? '';
    $quantity = $_POST['quantite'] ?? '';
    $adress = $_POST['adress'] ?? '';

    try {
        addToCommandPasser($iduser, $nameProduct, $idd, $price, $adress, $quantity);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    
}