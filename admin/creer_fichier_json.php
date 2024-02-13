<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
  header("Location: ../login.php");
  exit();
}


$directory = '../../Formateurs'; 

$jsonData = file_get_contents('php://input');
$formateur = json_decode($jsonData, true);

if (isset($formateur['nom']) && isset($formateur['prenom'])) {
  $sousDossier = $_GET['sousDossier'];

  $sousDossierPath = $directory . '/' . $sousDossier;

  if (!is_dir($sousDossierPath)) {
    http_response_code(500);
    echo json_encode(array('message' => 'Le sous-dossier spécifié n\'existe pas.'));
    exit;
  }

  $fileName = $formateur['nom'] . '_' . $formateur['prenom'] . '.json';
  $filePath = $sousDossierPath . '/' . $fileName;
  $jsonData = json_encode($formateur, JSON_PRETTY_PRINT);

  if (file_put_contents($filePath, $jsonData)) {
    http_response_code(200);
    echo json_encode(array('message' => 'Le fichier JSON a été créé avec succès.'));
  } else {
    http_response_code(500);
    echo json_encode(array('message' => 'Une erreur s\'est produite lors de la création du fichier JSON.'));
  }
} else {
  http_response_code(400);
  echo json_encode(array('message' => 'Les données du formateur sont incomplètes.'));
}
?>