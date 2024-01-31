<?php 
function subscribeFormUser(string $mail, string $pseudo, string $passwrd, string $passwordConfirm): void
{
    $hashedPassword = hash('sha256', $passwrd);
    if (checkMailValidity($mail) && checkPseudoValidity($pseudo) && checkPasswordValidity($passwrd, $passwordConfirm)) {
        try {
            $pasAdmin = 0;
            $pdo = requeteConnexion();
            $pdoStatement = $pdo->prepare("INSERT INTO user (email, prenom, mot_de_passe, isAdmin)
            VALUES (:mail, :pseudo, :passwrd, :isAdmin)");
            $pdoStatement->execute([":mail" => $mail, ":pseudo" => $pseudo, ":passwrd" => $hashedPassword, "isAdmin" => $pasAdmin ]);
            
        } catch (PDOException $e) {
            echo $e->getMessage();
            throw new Exception("Erreur de connexion.");
        }
    } else {
        throw new Exception("Il y a une erreur dans le mail ou le pseudo.");
    }
}

function connexionUser(string $emailUser, string $passwrdCo): ?object
{
    $hashdPassword = hash('sha256', $_POST['passwrdCo']);
    $pdo = requeteConnexion();
    $pdoStatement = $pdo->prepare("SELECT *, mot_de_passe as mdp FROM user WHERE email = :mail");
    $pdoStatement->execute([":mail" => "$emailUser"]);
    $result = $pdoStatement->fetch();
  /*   var_dump($result); */
    if ($result->mdp == $hashdPassword) {
        return $result;
    }
    return null;
}