<?php
// Lecture du fichier JSON
$jsonData = file_get_contents('admin/main_page.json');

// Conversion du JSON en tableau associatif
$data = json_decode($jsonData, true);

// Récupération des questions et réponses
$questions = $data['questions'];
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="img/logo.png" type="image/png">
    <title>IFJR - Accueil</title>
  <meta charset="utf-8">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="accueil.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Montserrat';
    }
    </style>
  
  <link rel="stylesheet" href="nav/nav.css">
  <link rel="stylesheet" href="footer/footer.css">
  
  <script src="https://kit.fontawesome.com/20aade7625.js" crossorigin="anonymous"></script>
  
</head>
<body>
  <?php include('nav/nav.php'); ?>

  <header class="banner">
    <h1>JUSTICE RESTAURATIVE</h1>
  </header>

 <div class="info-container">
    <h2>INFORMATIONS ESSENTIELLES</h2>

    <div class="faq-container">
      <?php foreach ($questions as $index => $question) { ?>
        <div class="faq-item">
          <h3><i class="fa-solid fa-plus"></i> <?php echo $question['question']; ?></h3>
          <div class="faq-answer">
            <p><?php echo $question['answer']; ?></p>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>

  <?php include('footer/footer.php'); ?>

  <script src="accueil.js"></script>

</body>
</html>
