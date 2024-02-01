<?php 

function displayAllProductToDelete(): string
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
                        <form action='addProduct.php' method='POST'>
                            <input type='hidden' name='id' value='$key->id'>
                            <input type='hidden' name='prix' value='$key->prix'>
                            <input type='hidden' name='quantite' value='1'>
                            <input type='hidden' name='nom' value='$key->nom'>
                            <button type='submit' class='btn btn-primary btn-sm btn-''>Supprime l'objet</button>
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

function supprProduct(int $idd) :void {
    $pdo = requeteConnexion();
    $pdoStatement = $pdo->prepare("DELETE FROM produit
    WHERE id = :id");
    $pdoStatement->execute([":id" => "$idd"]);
}


if ($user->isAdmin = 1 && !empty($_POST['id'])){
    $idd = $_POST['id'] ?? '';
    try {
        supprProduct($idd);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}