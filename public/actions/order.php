<?php
require_once __DIR__ . '/../../src/init.php';

$idd = $_POST['id'] ?? '';
$nom = $_POST['nom'] ?? '';
$prix = $_POST['prix'] ?? '';
$quantity = $_POST['quantite'] ?? ''; 
$adresseLivraison = $_POST['adresse'];

$idUtilisateur = $user->id;

$pdo = requeteConnexion();
$pdoStatement = $pdo->prepare("INSERT INTO listcommandes (acheteur, produits, quantiterProduit, adress)
                                VALUES (:acheteur, :idProduit, :quantiterProduit, :adress)");
$pdoStatement->execute([':acheteur' => $idUtilisateur, ':idProduit' => $idd, ':quantiterProduit' => $quantity, ':adress' => $adresseLivraison]);

$pdo->exec("DELETE FROM panier WHERE acheteur = $idUtilisateur");

header("Location: mes_commandes.php"); 
exit();
