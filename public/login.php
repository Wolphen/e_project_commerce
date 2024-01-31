<?php 
require_once __DIR__ . '/../src/init.php';
require_once __DIR__ . '/../src/utils/register_connexion.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php require_once __DIR__ . '/../src/partials/menu.php'; ?>
    <?php require_once __DIR__ . '/../src/partials/show_error.php'; ?>


    <form class="formm" method="POST">
        <input type="text" id="mail" name="emailUser" placeholder="Email" required class="inputtexte">
        <br>
        <input type="password" id="password" name="passwrdCo" placeholder="Mot de passe" required class="inputtexte">
        <br>
        <input type="submit" value="Connexion" class="inputsubmit">
        <label for="connexion" class="creecompte"><a href="register.php"> Pas de compte ? Crée un compte ici.</a></label>

        <?php if (isset($_POST['emailUser'])) {
            $userConnectionOk = connexionUser(($_POST['emailUser']), ($_POST['passwrdCo']));
            if (!$userConnectionOk) {  ?>
                <p class="warning">Identifiants incorrects. Veuillez réessayer.</p>
        <?php
            } else {
                $_SESSION['user_id'] = $userConnectionOk->id;
                echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
                }
            }
        


        ?>
    </form>
    <h1>Si je suis connecter mon pseudo apparait là</h1>
    <?php if ($user != false) {
            echo $user->prenom;
          
        }
        else {
            echo 'pas co';
        }?>
</body>
</html>
