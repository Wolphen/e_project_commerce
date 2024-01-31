<?php
// $pdo est dispo !

/* 
Vérification de l'email valable 
Argument $mail 
return $isMailValid
*/
function checkMailValidity(string $mail): bool
{
    $isMailValid = true;
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $isMailValid = false;
        throw new Exception("Le format de l'email n'est pas valide.");
    }
    return $isMailValid;
}
 
/* 
Vérification du pseudo valable 
Argument $pseudo
return $isPseudoValid
*/
function checkPseudoValidity(string $pseudo): bool
{
    $isPseudoValid = true;
    if (strlen($pseudo) < 4 || strlen($pseudo) > 16) {
        $isPseudoValid = false;
        throw new Exception("Le pseudo doit être compris entre 5 et 15 caractères");
    }

    return $isPseudoValid;
}

/* 
Vérification du mot de passe et confirmation
argument $passwrd et $passwordConfirm
return $isPasswordValid
*/
function checkPasswordValidity(string $passwrd, string $passwordConfirm): bool
{
    $isPasswordValid = true;
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*]).{8,}$/', $passwrd)) {
        $isPasswordValid = false;
        throw new Exception("Doit contenir une minuscule, une majuscule, un chiffre, un caractère spécial, et de minimum 8 caractères");
    } else if ($passwrd != $passwordConfirm) {
        $isPasswordValid = false;
        throw new Exception("Les mots de passes ne correspondent pas!");
    }
    return $isPasswordValid;
}