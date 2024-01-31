<?php
require_once __DIR__ . '/../src/init.php';
require_once __DIR__ . '/../src/utils/displayProduct.php';
require_once __DIR__ . '/../src/utils/paner.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonjour</title>
    <?php require_once __DIR__ . '/../src/partials/head_css.php'; ?>
</head>
<body>
    <?php require_once __DIR__ . '/../src/partials/menu.php'; ?>
    <?php require_once __DIR__ . '/../src/partials/show_error.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Bonjour</h1>
                <div class="alert alert-success">
                    Bienvenue sur la boutique, mon chère  <?php if ($user != false) {
            echo $user->id;
        };?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
         <div class ="row">
             <div class="col">
                 <?php echo displayAllProduct(); 
                 try {
                     if (isset($_POST['email'], $_POST['pseudo'], $_POST['passwrd'], $_POST['passwordConfirm'], $iduser)) {
                        addAtThePaner($idd, $nom, $prix, $quantity, $iduser);
                     }
                 } catch (Exception $e) {
                     echo $e->getMessage();
                 }
                 ?>
               
            </div>
        </div>
    </div>
</body>
</html>