<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'eleves_wk';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname,charset=utf8",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION).
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
}
catch (PDOException $exception) {
    die("erreur: " .$exception->getMessage());
}

$request = $conn->prepare("
    SELECT el.prenom,el.nom,el.login,el.password,info.rue,info.cp,info.ville,info.pays
    FROM eleve as el
    INNER JOIN eleve_information as info ON el.information_id = info.id
");

$request->execute();
echo "<pre";
print_r($request->fetchAll());
echo "</pre>";


