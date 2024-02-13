<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
  header("Location: ../login.php");
  exit();
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $region = $_POST["region"];
  $titre = $_POST["titre"];
  $description = $_POST["description"];
  $duree = $_POST["duree"];
  $evenements = $_POST["evenements"];
  $nomFormateur = $_POST["nomFormateur"];
  $emailFormateur = $_POST["emailFormateur"];
  $telephoneFormateur = $_POST["telephoneFormateur"];
  $prixFormation = $_POST["prixFormation"];
  $publicCible = $_POST["publicCible"];
  $destinataires = $_POST["destinataires"];
  $programme = $_POST["programme"];
  $objectifs = $_POST["objectifs"];


  $directory = "formations/" . $region;
  if (!is_dir($directory)) {
    mkdir($directory, 0777, true);
  }


  $index = 1;
  do {
    $filename = $directory . "/" . sprintf("%03d", $index) . ".json";
    $index++;
  } while (file_exists($filename));


  $formationData = [
    "id" => sprintf("%03d", $index - 1),
    "nom" => $titre,
    "description" => $description,
    "duree" => $duree,
    "evenements" => $evenements,
    "nomFormateur" => $nomFormateur,
    "emailFormateur" => $emailFormateur,
    "telephoneFormateur" => $telephoneFormateur,
    "prixFormation" => $prixFormation,
    "publicCible" => $publicCible,
    "destinataires" => $destinataires,
    "programme" => $programme,
    "objectifs" => $objectifs,
    "region" => $region
  ];
  


  $jsonData = json_encode($formationData, JSON_PRETTY_PRINT);


  if (file_put_contents($filename, $jsonData)) {
    header('Location: forma.php');
  } else {
    echo "Une erreur s'est produite lors de l'ajout de la formation.";
  }
}
?>