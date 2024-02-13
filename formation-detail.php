<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="img/logo.png" type="image/png">
    <title>IFJR - Formations</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="accueil.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="nav/nav.css">
    <link rel="stylesheet" href="footer/footer.css">
    <link rel="stylesheet" href="formation-detail.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Montserrat';
    }
    </style>
    
    
 <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/20aade7625.js" crossorigin="anonymous"></script>
</head>
<body>
  <?php include('nav/nav.php'); ?>
  <div class="container">
    <div class="row">
      <div class="col-md-6" id="details">
  <?php
  // Récupérer l'ID de la formation depuis l'URL
  $formationId = $_GET['id'];
  $region = $_GET['region'];

  // Construire le chemin du fichier JSON de la formation
  $formationFilePath = 'admin/formations/' . $region . '/' . $formationId . '.json';

  // Vérifier si le fichier JSON existe
  if (file_exists($formationFilePath)) {
    // Charger les données de la formation depuis le fichier JSON
    $formationData = json_decode(file_get_contents($formationFilePath), true);

    // Vérifier si les données sont valides
    if ($formationData) {
      echo '<h2>' . $formationData['nom'] . '</h2>';
      echo '<p class="info-title">Description:</p>';
      echo '<p class="info-content">' . $formationData['description'] . '</p>';
      echo '<p class="info-title">Durée:</p>';
      echo '<p class="info-content">' . $formationData['duree'] . '</p>';
      echo '<p class="info-title">Nom du formateur:</p>';
      echo '<p class="info-content">' . $formationData['nomFormateur'] . '</p>';
      echo '<p class="info-title">Email du formateur:</p>';
      echo '<p class="info-content">' . $formationData['emailFormateur'] . '</p>';
      echo '<p class="info-title">Téléphone du formateur:</p>';
      echo '<p class="info-content">' . $formationData['telephoneFormateur'] . '</p>';
      echo '<p class="info-title">Prix de la formation:</p>';
      echo '<p class="info-content">' . $formationData['prixFormation'] . '</p>';
      echo '<p class="info-title">Public cible:</p>';
      echo '<p class="info-content">' . $formationData['publicCible'] . '</p>';
      echo '<p class="info-title">Destinataires:</p>';
      echo '<p class="info-content">' . $formationData['destinataires'] . '</p>';
      echo '<p class="info-title">Programme:</p>';
      echo '<p class="info-content">' . $formationData['programme'] . '</p>';
      echo '<p class="info-title">Objectifs:</p>';
      echo '<p class="info-content">' . $formationData['objectifs'] . '</p>';
      echo '<p class="info-title">Région:</p>';
      echo '<p class="info-content">' . $formationData['region'] . '</p>';
    } else {
      echo 'Erreur : données de formation non valides.';
    }
  } else {
    echo 'Erreur : formation introuvable.';
  }
  ?>
</div>

<div class="col-md-6" id="inscription">
  <h3>Formulaire d'inscription</h3>
  <form method="post">
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="email" name="email" placeholder="Email" required>
    <!-- Ajoutez d'autres champs du formulaire -->

    <button type="submit">S'inscrire</button>
    <button href="#">Consulter les prochaines dates et villes </button>
  </form>
</div>

    </div>
  </div>

  <?php include('footer/footer.php'); ?>
</body>
</html>
