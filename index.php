<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'eleves_wk';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION).
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
}
catch (PDOException $exception) {
    die("erreur: " .$exception->getMessage());
}
echo "<h1>Eleves et information d'élèves</h1>";

$request = $conn->prepare("
    SELECT el.prenom,el.nom,el.login,el.password,info.rue,info.cp,info.ville,info.pays
    FROM eleve as el
    INNER JOIN eleve_information as info ON el.information_id = info.id
");

$request->execute();
echo "<pre";
print_r($request->fetchAll());
echo "</pre>";

echo "<h1>Compétence et niveau de compétence</h1>";

$request = $conn->prepare("
    SELECT elcomp.niveau, comp.titre,comp.description, el.prenom, el.nom
    FROM eleve_competence as elcomp
    INNER JOIN competence as comp ON elcomp.competence_id = comp.id
    INNER JOIN eleve as el ON elcomp.eleve_id = el.id
");

$request->execute();
echo "<pre>";
print_r($request->fetchAll());
echo "</pre>";
