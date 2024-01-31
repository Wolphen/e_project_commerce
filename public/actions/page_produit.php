<?php
// Vérifier si les paramètres sont présents dans l'URL
if (isset($_GET['id'], $_GET['prix'], $_GET['quantite'], $_GET['nom'])) {
    $product_id = $_GET['id'];
    $product_prix = $_GET['prix'];
    $product_quantite = $_GET['quantite'];
    $product_nom = $_GET['nom'];
    $pdo = requeteConnexion();
    $pdoStatement = $pdo->prepare("INSERT INTO panier (nomProduit, acheteur, price, idProduit, quantiterProduit)
    VALUES (:nomProduit, :acheteur, :price, :idProduit, :quantiterProduit)");
    $pdoStatement->execute(["nomProduit"=> $product_nom, ":acheteur"=> $user->id, "price"=> $product_prix, "idProduit" => $product_id, ":quantiterProduit"=>$product_quantite]);
    $result = $pdoStatement->fetch();
    var_dump($result); 
    /* header("Location: index.php"); */
    
} else {
    echo "<p>Paramètres manquants.</p>";    
}
echo 'troubadour';