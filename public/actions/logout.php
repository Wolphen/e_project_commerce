<?php 
/* destroy la session pour se déco */
require_once __DIR__ . '/../../src/init.php';
session_destroy();
header('Location: index.php');




