<?php
require_once __DIR__ . '/../init.php';
$iduser = 0;
if ($user != false) {
    $iduser = $user->id;
}

function addAtTheCart(int $idd, string $nom, float $prix, int $quantity, $iduser){
   
    $pdo = requeteConnexion();
    $pdoStatement = $pdo->prepare("INSERT INTO panier (nomProduit, acheteur, price, idProduit, quantiterProduit)
    VALUES (:nomProduit, :acheteur, :price, :idProduit, :quantiterProduit)");
    $pdoStatement->execute(["nomProduit"=> $nom, ":acheteur"=> $iduser, "price"=> $prix, "idProduit" => $idd, ":quantiterProduit"=>$quantity]);
    $result = $pdoStatement->fetch();
    var_dump($result); 
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
    $result = $pdoStatement->fetchALL();
  
    $display = "<div class='container mt-4'>";
$display .= "<form method='post'>";
$display .= "<table class='table table-bordered'>";
$display .= "<thead class='thead-dark'>";
$display .= "<tr>";
$display .= "<th scope='col'>Image</th>";
$display .= "<th scope='col'>Nom</th>";
$display .= "<th scope='col'>Description</th>";
$display .= "<th scope='col'>Prix</th>";
$display .= "<th scope='col'>Commentaire</th>";
$display .= "<th scope='col' style='width: 50px;'>Étoile</th>";
$display .= "<th scope='col' style='width: 80px;'>Action</th>";
$display .= "</tr>";
$display .= "</thead>";
$display .= "<tbody>";

foreach ($result as $key) {
    $display .= "<tr>";
    $display .= "<td style='width: 100px; height: 100px; overflow: hidden;'><img src='$key->img' style='width: 100%; object-fit: cover;' class='img-fluid'></td>";
    $display .= "<td style='width: 150px;'><p>$key->nom</p></td>";
    $display .= "<td><p>$key->detail</p></td>";
    $display .= "<td>$key->prix</td>";
    $display .= "<td><p>Commentaire</p></td>";
    $display .= "<td><p>Étoile</p></td>";
    $display .= "<td>
                    <input type='hidden' name='id' value='$key->id'>
                    <input type='hidden' name='prix' value='$key->prix'>
                    <input type='hidden' name='quantite' value='1'>
                    <input type='hidden' name='nom' value='$key->nom'>
                    <button type='submit' class='btn btn-primary btn-sm' name='ajouter_au_panier'>Ajouter au panier</button>
                    
    
                </td>";
                  
                
    $display .= "</tr>";
}
  $idd = $_POST['id'] ?? '';
                    $nom = $_POST['nom'] ?? '';
                    $prix = $_POST['prix'] ?? '';
                    $quantity = $_POST['quantite'] ?? '';
                    try {
                        if ($user && isset($iduser) && isset($_POST['ajouter_au_panier'])) {
                            addAtTheCart($idd, $nom, $prix, $quantity, $iduser);
                        }
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }


$display .= "</tbody>";
$display .= "</table>";
$display .= "</form>";
$display .= "</div>";

return $display;
}

