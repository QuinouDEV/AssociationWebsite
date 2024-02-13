<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../img/logo.png" type="image/png">
  <title>IFJR - Gestion Formateurs</title>
  <!-- font awesome icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous">
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


  $directory = '../Formateurs';

  function listerFormateurs($directory)
  {
    $formateurs = array();


    if ($handle = opendir($directory)) {

      while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
          $path = $directory . '/' . $file;


          if (is_dir($path)) {

            $formateurs = array_merge($formateurs, listerFormateurs($path));
          } else {

            if (pathinfo($path, PATHINFO_EXTENSION) === 'json') {

              $json = file_get_contents($path);

              $formateur = json_decode($json, true);


              if (isset($formateur['nom'])) {

                $formateurs[] = $formateur;
              }
            }
          }
        }
      }

      closedir($handle);
    }

    return $formateurs;
  }


  $formateurs = listerFormateurs($directory);

  ?>

  <?php include 'panel.php'; ?>

  <?php

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $antenne = $_POST['antenne'];
    $mel = $_POST['mel'];
    $role = $_POST['role'];
    $tel = $_POST['tel'];
    $sousDossier = $_POST['sousDossier'];


    $formateur = array(
      'antenne' => $antenne,
      'nom' => $nom,
      'prenom' => $prenom,
      'mel' => $mel,
      'role' => $role,
      'tel' => $tel,
      'dept' => $sousDossier
    );


    $json = json_encode($formateur, JSON_PRETTY_PRINT);


    $cheminFichier = $directory . '/' . $sousDossier . '/' . $nom . '_' . $prenom . '.json';




    file_put_contents($cheminFichier, $json);
  }

  if (isset($_GET['SuppressionSubmit'])) {
    $sousdossier = $_GET['delete_region'];
    $name = $_GET['delete_name'];



    $filePath = $directory . '/' . $sousdossier . '/' . $name . '.json';


    if (file_exists($filePath)) {

      unlink($filePath);


      $formateurs = listerFormateurs($directory);
    }
  }


  if (isset($_GET['edit_formateur'])) {

    $editAntenne = $_GET['edit_antenne'];
    $editMel = $_GET['edit_mel'];
    $editRole = $_GET['edit_role'];
    $editTel = $_GET['edit_tel'];
    $sousdossier = $_GET['edit_region'];
    $name = $_GET['edit_name'];
    $filePath = $directory . '/' . $sousdossier . '/' . $name . '.json';


    $formateursData = json_decode(file_get_contents($filePath), true);


    $formateursData['antenne'] = $editAntenne;
    $formateursData['mel'] = $editMel;
    $formateursData['role'] = $editRole;
    $formateursData['tel'] = $editTel;


    file_put_contents($filePath, json_encode($formateursData, JSON_PRETTY_PRINT));
  }


  ?>


  <div class="dashboard-main">
    <div class="container">
      <div class="row py-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
          <div class="dashboard-title-text">
            <h2>Liste des formateurs</h2>
            <p class="text-grey">C'est ici que vous allez pouvoir faire la gestion de tous les formateurs du SiteWeb.
            </p>
          </div>
          <button type="button" class="fs-18 text-grey-blue">
            <i class="fas fa-ellipsis-vertical"></i>
          </button>
        </div>
      </div>
      <div class="overview-section p-4">
        <div class="row">
          <div class="col-12">

          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <div class="form-group">
            <input type="text" name="searchInput" id="searchInput" class="form-control" placeholder="Rechercher...">
            <button type="button" class="btn btn-primary" onclick="searchTable()">Rechercher</button>
            </div>
          </form>


            <div class="d-flex justify-content-end mb-2">
              <div class="text-end mb-3">
                <button class="btn btn-primary" data-bs-toggle="modal"
                  data-bs-target="#ajouterUnUtilisateurModal">Ajouter un formateur</button>
              </div>
            </div>




            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Formateurs</th>
                  <th scope="col">Antenne</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody id="user-list-body">
                <?php
                foreach ($formateurs as $formateur) {
                  echo '<tr>';
                  echo '<td>' . $formateur['nom'] . '</td>';
                  echo '<td>' . $formateur['antenne'] . '</td>';
                  echo '<td>';
                  echo '<button class="btn btn-danger btn-sm delete-formateur-btn" data-bs-toggle="modal" data-bs-target="#supprimerFormateurModal" data-name="' . $formateur['nom'] . '_' . $formateur['prenom'] . '" data-id="' . $formateur["dept"] . '" title="Supprimer"><i class="fas fa-trash"></i></button>';
                  echo '<button class="btn btn-primary btn-sm edit-formateur-btn" data-bs-toggle="modal" data-bs-target="#editerFormateurModal" data-name="' . $formateur['nom'] . '_' . $formateur['prenom'] . '" data-id="' . $formateur["dept"] . '" data-nom="' . $formateur["nom"] . '" data-prenom="' . $formateur["prenom"] . '" data-mail="' . $formateur["mel"] . '" data-role="' . $formateur["role"] . '" data-tel="' . $formateur["tel"] . '" data-antenne="' . $formateur["antenne"] . '" title="Supprimer"><i class="fas fa-edit"></i></button>';
                  echo '</td>';
                  echo '</tr>';
                }
                ?>
              </tbody>
            </table>
            

            <div class="pagination">
          <button class="page-link" onclick="previousPage()">&laquo; Précédent</button>
          <span id="currentPage"></span>
          <button class="page-link" onclick="nextPage()">Suivant &raquo;</button>
        </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="supprimerFormateurModal" tabindex="-1" aria-labelledby="supprimerFormateurModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="supprimerFormateurModalLabel">Supprimer un formateur</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="deleteForm" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <p>Êtes-vous sûr de vouloir supprimer ce formateur ?</p>
            <input type="text" class="form-control" id="delete_name" name="delete_name" readonly required>
            <input type="text" class="form-control" id="delete_region" name="delete_region" readonly required>
        </div>
        <div class="text-end">
          <button type="submit" class="btn btn-danger" name="SuppressionSubmit">Supprimer</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="editerFormateurModal" tabindex="-1" aria-labelledby="editerFormateurModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editerFormateurModalLabel">Modifier un formateur</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editerFormateurForm" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
              <label for="edit_nom" class="form-label">Nom</label>
              <input type="text" class="form-control" id="edit_nom" name="edit_nom" readonly required>
            </div>
            <div class="mb-3">
              <label for="edit_prenom" class="form-label">Prénom</label>
              <input type="text" class="form-control" id="edit_prenom" name="edit_prenom" readonly required>
            </div>
            <div class="mb-3">
              <label for="edit_antenne" class="form-label">Antenne</label>
              <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="edit_antenne"
                name="edit_antenne" required>>
                <option selected>Ouvrir le Menu</option>
                <option value="Sud-Ouest">Sud-Ouest</option>
                <option value="Nord-Ouest">Nord-Ouest</option>
                <option value="Nord-Est">Nord-Est</option>
                <option value="La Réunion">La Réunion</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="edit_mel" class="form-label">Adresse e-mail</label>
              <input type="email" class="form-control" id="edit_mel" name="edit_mel" required>
            </div>
            <div class="mb-3">
              <label for="edit_role" class="form-label">Rôle</label>
              <input type="text" class="form-control" id="edit_role" name="edit_role" required>
            </div>
            <div class="mb-3">
              <label for="edit_tel" class="form-label">Téléphone</label>
              <input type="text" class="form-control" id="edit_tel" name="edit_tel" required>
            </div>
            <div class="mb-3">
              <input type="text" class="form-control" id="edit_name" name="edit_name" hidden readonly required>
              <input type="text" class="form-control" id="edit_region" name="edit_region" hidden readonly required>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="edit_formateur">Enregistrer</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="ajouterUnUtilisateurModal" tabindex="-1" aria-labelledby="ajouterUnUtilisateurModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ajouterUnUtilisateurModalLabel">Ajouter un formateur</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="ajouterFormateurForm" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <div class="mb-3">
              <label for="nom" class="form-label">Nom</label>
              <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
              <label for="prenom" class="form-label">Prénom</label>
              <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="mb-3">
              <label for="antenne" class="form-label">Antenne</label>
              <label for="edit_antenne" class="form-label">Antenne</label>
              <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="antenne"
                name="antenne" required>>
                <option selected>Ouvrir le Menu</option>
                <option value="Sud-Ouest">Sud-Ouest</option>
                <option value="Nord-Ouest">Nord-Ouest</option>
                <option value="Nord-Est">Nord-Est</option>
                <option value="La Réunion">La Réunion</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="mel" class="form-label">Adresse e-mail</label>
              <input type="email" class="form-control" id="mel" name="mel" required>
            </div>
            <div class="mb-3">
              <label for="role" class="form-label">Rôle</label>
              <input type="text" class="form-control" id="role" name="role" required>
            </div>
            <div class="mb-3">
              <label for="tel" class="form-label">Téléphone</label>
              <input type="text" class="form-control" id="tel" name="tel" required>
            </div>
            <div class="mb-3">
              <label for="sousDossier" class="form-label">Région</label>
              <select class="form-select" id="sousDossier" name="sousDossier" required>
                <?php


                $sousDossiers = array_filter(glob($directory . '/*'), 'is_dir');
                foreach ($sousDossiers as $sousDossier) {
                  $nomSousDossier = basename($sousDossier);
                  echo '<option value="' . $nomSousDossier . '">' . $nomSousDossier . '</option>';
                }
                ?>
              </select>
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Ajouter</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
          </form>
        </div>
      </div>
    </div>



  </div>

  <script>

    var deleteUserForm = document.getElementById('deleteForm');
    var deleteUsernameInput = document.getElementById('delete_name');
    var deptInput = document.getElementById('delete_region');

    var deleteUserButtons = document.getElementsByClassName('delete-formateur-btn');
    Array.from(deleteUserButtons).forEach(function (button) {
      button.addEventListener('click', function () {
        var username = button.getAttribute('data-name');
        var dept = button.getAttribute('data-id');
        deleteUsernameInput.value = username;
        deptInput.value = dept;
      });
    });


    var editUsernameInput = document.getElementById('edit_name');
    var editdeptInput = document.getElementById('edit_region');
    var editTelInput = document.getElementById('edit_tel');
    var editNomInput = document.getElementById('edit_nom');
    var editPrenomInput = document.getElementById('edit_prenom');
    var editMelInput = document.getElementById('edit_mel');
    var editAntenneInput = document.getElementById('edit_antenne');
    var editRoleInput = document.getElementById('edit_role');



    var editUserButtons = document.getElementsByClassName('edit-formateur-btn');
    Array.from(editUserButtons).forEach(function (button) {
      button.addEventListener('click', function () {
        var username = button.getAttribute('data-name');
        var dept = button.getAttribute('data-id');
        var prenom = button.getAttribute('data-prenom');
        var nom = button.getAttribute('data-nom');
        var mel = button.getAttribute('data-mail');
        var antenne = button.getAttribute('data-antenne');
        var role = button.getAttribute('data-role');
        var tel = button.getAttribute('data-tel');


        editUsernameInput.value = username;
        editdeptInput.value = dept;

        editPrenomInput.value = prenom;
        editNomInput.value = nom;
        editMelInput.value = mel;
        editAntenneInput.value = antenne;
        editRoleInput.value = role;
        editTelInput.value = tel;
      });
    });

    function search() {
      var searchText = document.getElementById('searchInput').value.toLowerCase();
      var searchAntenne = document.getElementById('searchAntenne').value.toLowerCase();

      var rows = document.getElementById('user-list-body').getElementsByTagName('tr');

      for (var i = 0; i < rows.length; i++) {
        var name = rows[i].getElementsByTagName('td')[0].innerText.toLowerCase();
        var antenne = rows[i].getElementsByTagName('td')[1].innerText.toLowerCase();


        if (name.includes(searchText) && antenne.includes(searchAntenne)) {
          rows[i].style.display = '';
        } else {
          rows[i].style.display = 'none';
        }
      }
    }

    document.getElementById('searchInput').addEventListener('input', search);
    document.getElementById('searchAntenne').addEventListener('input', search);

    function searchTable() {

      var searchInput = document.getElementById('searchInput').value.toLowerCase();

    var rows = document.getElementById('user-list-body').getElementsByTagName('tr');
    
   
    for (var i = 0; i < rows.length; i++) {
      var name = rows[i].getElementsByTagName('td')[0].innerText.toLowerCase(); 
      
      if (name.includes(searchInput)) {
        rows[i].style.display = ''; 
      } else {
        rows[i].style.display = 'none'; 
      }
    }
  }

  </script>

  <!-- bootstrap and fontawesome scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>
</body>

</html>