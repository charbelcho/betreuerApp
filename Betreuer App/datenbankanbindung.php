<?php 
    $dbname = 'betreuerdatenbank';
    $dbuser = 'root';
    $dbpw = '';

    $pdo = new PDO("mysql:host=localhost;dbname=$dbname", $dbuser, $dbpw);
?>