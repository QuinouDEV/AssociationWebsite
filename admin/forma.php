<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/logo.png" type="image/png">
    <title>IFJR - Gestion Formations</title>
    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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
    <?php 
    session_start();
    if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
      header("Location: ../login.php");
      exit();
    }

    include 'panel.php'; 
  ?>

    <div class="dashboard-main">
        <div class="container">
            <div class="row py-3">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <div class="dashboard-title-text">
                        <h2>Espace de gestion des formations</h2>
                        <p class="text-grey">Gérer vos formations dans cet espace.</p>
                    </div>
                    <button type="button" class="fs-18 text-grey-blue">
                        <i class="fas fa-ellipsis-vertical"></i>
                    </button>
                </div>
            </div>

            <div class="overview-section p-4">

                <div class="row">
                    <div class="col-12">
                        <form action="" method="GET">
                            <div class="form-group">
                                <input type="text" name="searchInput" id="searchInput" class="form-control"
                                    placeholder="Rechercher un nom...">
                            </div>
                        </form>
                        <br>
                        <br>

                        <div class="text-end mb-3">
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#ajouterFormationModal">Ajouter une formation</button>
                        </div>


                        <table class="table" id="formationTable">
                            <thead>
                                <tr class="title-row">
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Département</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
        function getFormationsByRegion($region)
        {
          $formations = [];
          $directory = "formations/$region/";

          if (is_dir($directory)) {
            $files = array_diff(scandir($directory), ['.', '..']);

            foreach ($files as $file) {
              $path = $directory . $file;

              if (is_file($path)) {
                $formation = json_decode(file_get_contents($path), true);

                if ($formation) {
                  $formations[] = $formation;
                }
              }
            }
          }

          return $formations;
        }

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
       
       
        $allFormations = [];

        foreach ($regions as $region) {
          $formations = getFormationsByRegion($region);
          $allFormations = array_merge($allFormations, $formations);
        }

                $searchInput = isset($_GET['searchInput']) ? $_GET['searchInput'] : '';
                $filteredFormations = array_filter($allFormations, function ($formation) use ($searchInput) {
                    return stripos($formation['nom'], $searchInput) !== false;
                });        


        foreach ($allFormations as $formation) {
          echo '<tr>';
          echo '<td>' . $formation['id'] . '</td>';
          echo '<td>' . $formation['nom'] . '</td>';
          echo '<td>' . $formation['description'] . '</td>';
          echo '<td>'. $formation['region'] . '</td>';
          echo '<td>';
          echo '<button class="btn" data-bs-toggle="modal" data-bs-target="#modifierFormationModal" onclick="modifierFormation(' . htmlspecialchars(json_encode($formation)) . ')"><i class="fas fa-edit"></i></button>';
          echo '<button class="btn" onclick="supprimerFormation(' . $formation['id'] . ', \'' . $formation['region'] . '\')"><i class="fas fa-trash"></i></button>';
          echo '<a href="#" o</a>';
          echo '</td>';
          echo '</tr>';
        }
        ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal Modifier une formation -->
                    <div class="modal fade" id="modifierFormationModal" tabindex="-1"
                        aria-labelledby="modifierFormationModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="modifier_formation.php" method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modifierFormationModalLabel">Modifier une formation
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nom" class="form-label">Nom</label>
                                            <input type="text" class="form-control" id="nom" name="nom" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3"
                                                required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="duree" class="form-label">Durée</label>
                                            <input type="text" class="form-control" id="duree" name="duree" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="evenements" class="form-label">Événements</label>
                                            <textarea class="form-control" id="evenements" name="evenements" rows="3"
                                                required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nomFormateur" class="form-label">Nom du formateur</label>
                                            <input type="text" class="form-control" id="nomFormateur"
                                                name="nomFormateur" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="emailFormateur" class="form-label">Adresse e-mail du
                                                formateur</label>
                                            <input type="email" class="form-control" id="emailFormateur"
                                                name="emailFormateur" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="telephoneFormateur" class="form-label">Numéro de téléphone du
                                                formateur</label>
                                            <input type="tel" class="form-control" id="telephoneFormateur"
                                                name="telephoneFormateur" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="prixFormation" class="form-label">Prix de la formation</label>
                                            <input type="text" class="form-control" id="prixFormation"
                                                name="prixFormation" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="publicCible" class="form-label">Public cible</label>
                                            <input type="text" class="form-control" id="publicCible" name="publicCible"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="destinataires" class="form-label">Destinataires</label>
                                            <input type="text" class="form-control" id="destinataires"
                                                name="destinataires" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="programme" class="form-label">Programme</label>
                                            <textarea class="form-control" id="programme" name="programme" rows="3"
                                                required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="objectifs" class="form-label">Objectifs</label>
                                            <textarea class="form-control" id="objectifs" name="objectifs" rows="3"
                                                required></textarea>
                                        </div>
                                        <input type="hidden" name="id" id="formationId" value="">
                                        <input type="hidden" name="region" id="formationRegion" value="">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-primary">Modifier</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>



                    <!-- Modal Ajouter une formation -->
                    <div class="modal fade" id="ajouterFormationModal" tabindex="-1"
                        aria-labelledby="ajouterFormationModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ajouterFormationModalLabel">Ajouter une formation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Fermer"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="ajouter_formation.php" method="POST">
                                        <div class="mb-3">
                                            <label for="titre" class="form-label">Titre :</label>
                                            <input type="text" class="form-control" id="titre" name="titre" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description :</label>
                                            <textarea class="form-control" id="description" name="description" rows="3"
                                                required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="duree" class="form-label">Durée :</label>
                                            <input type="text" class="form-control" id="duree" name="duree" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="evenements" class="form-label">Événements :</label>
                                            <textarea class="form-control" id="evenements" name="evenements" rows="3"
                                                required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nomFormateur" class="form-label">Nom du formateur :</label>
                                            <input type="text" class="form-control" id="nomFormateur"
                                                name="nomFormateur" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="emailFormateur" class="form-label">Adresse e-mail du formateur
                                                :</label>
                                            <input type="email" class="form-control" id="emailFormateur"
                                                name="emailFormateur" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="telephoneFormateur" class="form-label">Numéro de téléphone du
                                                formateur :</label>
                                            <input type="tel" class="form-control" id="telephoneFormateur"
                                                name="telephoneFormateur" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="prixFormation" class="form-label">Prix de la formation :</label>
                                            <input type="text" class="form-control" id="prixFormation"
                                                name="prixFormation" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="publicCible" class="form-label">Public cible :</label>
                                            <input type="text" class="form-control" id="publicCible" name="publicCible"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="destinataires" class="form-label">Destinataires :</label>
                                            <input type="text" class="form-control" id="destinataires"
                                                name="destinataires" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="programme" class="form-label">Programme :</label>
                                            <textarea class="form-control" id="programme" name="programme" rows="3"
                                                required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="objectifs" class="form-label">Objectifs :</label>
                                            <textarea class="form-control" id="objectifs" name="objectifs" rows="3"
                                                required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="region" class="form-label">Région :</label>
                                            <select class="form-select" id="region" name="region" required>
                                                <?php
                $folderPath = "formations/";
                $folders = array_diff(scandir($folderPath), ['.', '..']);

                foreach ($folders as $folder) {
                  echo '<option value="' . $folder . '">' . $folder . '</option>';
                }
                ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                function supprimerFormation(id, region) {

                    var formattedId = String(id).padStart(3, '0');
                    console.log("Supprimer la formation avec l'ID :", formattedId);


                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "supprimer_formation.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {

                            console.log(xhr.responseText);


                            location.reload();
                        }
                    };
                    xhr.send("id=" + formattedId + "&region=" + region);
                }

                function modifierFormation(formation) {

                    var nomInput = document.getElementById("nom");
                    var descriptionInput = document.getElementById("description");
                    var formationIdInput = document.getElementById("formationId");
                    var objectifsInput = document.getElementById("objectifs");
                    var formationRegionInput = document.getElementById("formationRegion");

                    var programmeIdInput = document.getElementById("programme");
                    var destinatairesInput = document.getElementById("destinataires");
                    var prixFormationInput = document.getElementById("prixFormation");
                    var telephoneFormateurInput = document.getElementById("telephoneFormateur");
                    var emailFormateurInput = document.getElementById("emailFormateur");
                    var nomFormateurInput = document.getElementById("nomFormateur");
                    var evenementsInput = document.getElementById("evenements");
                    var dureeInput = document.getElementById("nomFormateur");


                    nomInput.value = formation.nom;
                    descriptionInput.value = formation.description;
                    formationIdInput.value = formation.id;
                    formationRegionInput.value = formation.region;
                    objectifsInput.value = formation.objectifs;

                    dureeInput.value = formation.duree;
                    evenementsInput.value = formation.evenements;
                    nomFormateurInput.value = formation.nomFormateur;
                    emailFormateurInput.value = formation.emailFormateur;
                    telephoneFormateurInput.value = formation.telephoneFormateur;
                    prixFormationInput.value = formation.prixFormation;
                    programmeIdInput.value = formation.programme;
                    destinatairesInput.value = formation.destinataires;

                }

                function filterTable() {
                    var input = document.getElementById("searchInput").value.toLowerCase();
                    var table = document.getElementById("formationTable");
                    var rows = table.getElementsByTagName("tr");

                    for (var i = 0; i < rows.length; i++) {
                        var cells = rows[i].getElementsByTagName("td");
                        var match = false;


                        var isTitleRow = rows[i].classList.contains("title-row");

                        for (var j = 0; j < cells.length; j++) {
                            var cellText = cells[j].innerText.toLowerCase();

                            if (cellText.indexOf(input) > -1) {
                                match = true;
                                break;
                            }
                        }

                        if (match || isTitleRow) {
                            rows[i].style.display = "";
                        } else {
                            rows[i].style.display = "none";
                        }
                    }
                }



                document.getElementById("searchInput").addEventListener("keyup", filterTable);
                </script>
</body>

</html>