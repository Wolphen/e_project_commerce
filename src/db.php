<?php 

function requeteConnexion() {
    
    $db_host = 'mariadb';
    $db_name = 'dbadmin';
    $db_port = '3306';
    $db_user = 'root';
    $db_pass = 'root';

    // data source name
    $dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name . ';port=' . $db_port . '';
    $driver_options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
       ];

    try {
        $db = new PDO($dsn, $db_user, $db_pass, $driver_options);
    }
    catch (Exception $e) {
        die('Erreur MySQL, maintenance en cours.' . $e->getMessage());
    }

    return $db;
}



