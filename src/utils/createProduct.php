<?php
function addProduct(string $nomProduit, float $prix, string $description, int $quantite, string $urlImage) : void {
    $pdo = requeteConnexion();
    $pdoStatement = $pdo->prepare("INSERT INTO produit (nom, detail, prix, quantite, commentaire, img, etoile)
    VALUES (:nom, :detail, :prix, :quantite, :commentaire, :img, :etoile)");
    $pdoStatement->execute([":nom" => $nomProduit, ":prix" => $prix, ":detail" => $description, ":quantite" => $quantite, ":commentaire" => "", ":img" => $urlImage, ":etoile" => 1 ]);
}