<!DOCTYPE html>
<html lang="fr">
<head>
     <link rel="icon" href="img/logo.png" type="image/png">
    <title>IFJR - Formations</title>
 <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <link rel="stylesheet" href="nav/nav.css"/>
      <link rel="stylesheet" href="footer/footer.css"/>
    <link rel="stylesheet" href="liste.css"/>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Montserrat';
    }
    </style>
    
</head>
<body>
    <?php include('nav/nav.php'); ?>
  <div class="container">
    <h1>Liste des Formations</h1>


     <?php
        $regions = [
          'Ain', 'Aisne', 'Allier', 'AlpesdeHauteProvence', 'HautesAlpes', 'AlpesMaritimes', 'Ardeche', 'Ardennes',
          'Ariege', 'Aube', 'Aude', 'Aveyron', 'BouchesduRhone', 'Calvados', 'Cantal', 'Charente', 'CharenteMaritime',
          'Cher', 'Correze', 'CorseduSud', 'HauteCorse', 'CotedOr', 'CotesdArmor', 'Creuse', 'Dordogne', 'Doubs',
          'Drome', 'Eure', 'EureetLoir', 'Finistere', 'Gard', 'HauteGaronne', 'Gers', 'Gironde', 'Herault',
          'IlleetVilaine', 'Indre', 'IndreetLoire', 'Isere', 'Jura', 'Landes', 'LoiretCher', 'Loire',
          'HauteLoire', 'LoireAtlantique', 'Loiret', 'Lot', 'LotetGaronne', 'Lozere', 'MaineetLoire', 'Manche',
          'Marne', 'HauteMarne', 'Mayenne', 'MeurtheetMoselle', 'Meuse', 'Morbihan', 'Moselle', 'Nievre', 'Nord',
          'Oise', 'Orne', 'PasdeCalais', 'PuydeDome', 'PyreneesAtlantiques', 'HautesPyrenees', 'PyreneesOrientales',
          'BasRhin', 'HautRhin', 'Rhone', 'HauteSaone', 'SaoneetLoire', 'Sarthe', 'Savoie', 'HauteSavoie',
          'Paris', 'SeineMaritime', 'SeineetMarne', 'Yvelines', 'DeuxSevres', 'Somme', 'Tarn', 'TarnetGaronne',
          'Var', 'Vaucluse', 'Vendee', 'Vienne', 'HauteVienne', 'Vosges', 'Yonne', 'TerritoiredeBelfort',
          'Essonne', 'HautsdeSeine', 'SeineSaintDenis', 'ValdeMarne', 'ValdOise',
          'Guadeloupe', 'Martinique', 'Guyane', 'LaReunion', 'Mayotte'
       ];
$basePath = 'admin/formations/';

foreach ($regions as $region) {
  $regionPath = $basePath . $region . '/';

  if (is_dir($regionPath)) {
    $files = array_diff(scandir($regionPath), ['.', '..']);
    $formations = [];

    foreach ($files as $file) {
      $path = $regionPath . $file;

      if (is_file($path)) {
        $formation = json_decode(file_get_contents($path), true);

        if ($formation) {
          $formations[] = $formation;
        }
      }
    }

  
    $totalFormations = count($formations);
    $halfCount = ceil($totalFormations / 2);
    $leftColumnFormations = array_slice($formations, 0, $halfCount);
    $rightColumnFormations = array_slice($formations, $halfCount);

   
    echo '<div class="row">';
    echo '<div class="col-md-6">';
    foreach ($leftColumnFormations as $formation) {
      echo '<a href="formation-detail.php?region=' . $region . '&id=' . $formation['id'] . '" class="card mb-4 formation-link">';

      echo '<div class="card-body">';
      echo '<h5 class="card-title">' . $formation['nom'] . '</h5>';
      echo '</div>';
      echo '</a>';
    }
    echo '</div>';

    echo '<div class="col-md-6">';
    foreach ($rightColumnFormations as $formation) {
      echo '<a href="formation-detail.php?region=' . $region . '&id=' . $formation['id'] . '" class="card mb-4 formation-link">';

      echo '<div class="card-body">';
      echo '<h5 class="card-title">' . $formation['nom'] . '</h5>';
      echo '</div>';
      echo '</a>';
    }
    echo '</div>';
    echo '</div>';
  }
}
?>




  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-lKpxoORCH6DyYuLazlCehRiQXkibgFh+5y5lQnE8C0zARmojUXgF6HmJZ5qdOtdh" crossorigin="anonymous"></script>
          <?php include('footer/footer.php'); ?>
</body>
</html>
