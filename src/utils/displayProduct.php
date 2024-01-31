<?php
function displayAllProduct(): string
{
    $pdo = requeteConnexion();
    $pdoStatement = $pdo->prepare("SELECT * 
    FROM produit 
    ORDER BY nom ASC");
    $pdoStatement->execute();
    $result = $pdoStatement->fetchALL();
  
    $display = "<div class='container mt-4'>";
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
        $display .= "<td><a href='page_produit.php?id=$key->id' class='btn btn-primary btn-sm'>Ajouter au panier</a></td>";
        $display .= "</tr>";
    }
    
    $display .= "</tbody>";
    $display .= "</table>";
    $display .= "</div>";
    
    return $display;
}