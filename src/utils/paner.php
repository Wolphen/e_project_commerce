<?php 
function addAtThePaner(int $idd, string $nom, float $prix, int $quantity, $iduser){
   
    $pdo = requeteConnexion();
    $pdoStatement = $pdo->prepare("INSERT INTO panier (nomProduit, acheteur, price, idProduit, quantiterProduit)
    VALUES (:nomProduit, :acheteur, :price, :idProduit, :quantiterProduit)");
    $pdoStatement->execute(["nomProduit"=> $nom, ":acheteur"=> $iduser, "price"=> $prix, "idProduit" => $idd, ":quantiterProduit"=>$quantity]);
    $result = $pdoStatement->fetch();
    var_dump($result); 
}