<?php 
require_once __DIR__ . '/../src/init.php';
require_once __DIR__ . '/../src/utils/register_connexion.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <?php require_once __DIR__ . '/../src/partials/menu.php'; ?>
    <?php require_once __DIR__ . '/../src/partials/show_error.php'; ?>
    <div class="forms">
        <form  method="post">
            <label for="mail" class="labell"></label>
            <input type="text" id="email" name="email" placeholder="Email" required class="inputl">

            <br>
            <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo" required class="inputl">

            <br>
            <label for="password" class="labell"></label>
            <input type="text" id="password" name="passwrd" placeholder="Mot de passe" required class="inputl" onkeyup="passwordCheck()">

            <br>
            <label for="password" class="labell"></label>
            <input type="text" id="password" name="passwordConfirm" placeholder="Confirmer le mot de passe" required class="inputl">

            <br>
            <input type="submit" value="inscription" class="inputsubmit">
            <label class="creecompte"><a href="login.php">Déjà un compte ? Connectez-vous ici.</a></label>
            </label>

            <?php
                $email = $_POST['email'] ?? '';
                $pseudo = $_POST['pseudo'] ?? '';
                $passwrd = $_POST['passwrd'] ?? '';
                $passwordConfirm = $_POST['passwordConfirm'] ?? '';
                try {
                    if (isset($_POST['email'], $_POST['pseudo'], $_POST['passwrd'], $_POST['passwordConfirm'])) {
                        subscribeFormUser($email, $pseudo, $passwrd, $passwordConfirm);
                        echo "<script type='text/javascript'>document.location.replace('login.php');</script>";
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                }


?>
</body>
</html>
