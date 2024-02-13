<?php

  session_start();
  if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header("Location: ../login.php");
    exit();
  }

  $id = $_POST['id'];
  $region = $_POST['region'];
  $nom = $_POST['nom'];
  $description = $_POST['description'];
  $duree = $_POST['duree'];
  $evenements = $_POST['evenements'];
  $nomFormateur = $_POST['nomFormateur'];
  $emailFormateur = $_POST['emailFormateur'];
  $telephoneFormateur = $_POST['telephoneFormateur'];
  $prixFormation = $_POST['prixFormation'];
  $publicCible = $_POST['publicCible'];
  $destinataires = $_POST['destinataires'];
  $programme = $_POST['programme'];
  $objectifs = $_POST['objectifs'];

  $path = "formations/$region/$id.json";

  if (file_exists($path)) {

    $jsonString = file_get_contents($path);
    $data = json_decode($jsonString, true);


    $data['nom'] = $nom;
    $data['description'] = $description;
    $data['duree'] = $duree;
    $data['evenements'] = $evenements;
    $data['nomFormateur'] = $nomFormateur;
    $data['emailFormateur'] = $emailFormateur;
    $data['telephoneFormateur'] = $telephoneFormateur;
    $data['prixFormation'] = $prixFormation;
    $data['publicCible'] = $publicCible;
    $data['destinataires'] = $destinataires;
    $data['programme'] = $programme;
    $data['objectifs'] = $objectifs;


    $updatedJsonString = json_encode($data, JSON_PRETTY_PRINT);


    file_put_contents($path, $updatedJsonString);


    header('Location: forma.php');
    exit();

    
  } else {
    echo "Le fichier JSON n'existe pas.";
  }
?>