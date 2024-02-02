<?php
require_once __DIR__ . '/../../src/init.php';
if ($user !== false) {
    $idUtilisateur = $user->id; 
} else {
    header('Location: index.php');
}
/* commande pour stocker et ensuite insert dans la table commande passer en deletant le panier */
$idd = $_POST['id'] ?? '';
$nom = $_POST['nom'] ?? '';
$prix = $_POST['prix'] ?? '';
$quantity = $_POST['quantite'] ?? ''; 
$adresseLivraison = $_POST['adresse'];


$pdo = requeteConnexion();
$pdoStatement = $pdo->prepare("INSERT INTO listcommandes (acheteur, produits, quantiterProduit, adress)
                                VALUES (:acheteur, :idProduit, :quantiterProduit, :adress)");
$pdoStatement->execute([':acheteur' => $idUtilisateur, ':idProduit' => $idd, ':quantiterProduit' => $quantity, ':adress' => $adresseLivraison]);

$pdo->exec("DELETE FROM panier WHERE acheteur = $idUtilisateur");

header("Location: mes_commandes.php"); 
exit();
