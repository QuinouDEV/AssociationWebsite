<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/logo.png" type="image/png">
    <title>IFJR - Gestion Admin</title>
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
  
      include 'panel.php'; 

          
      $usersFile = 'users.json';
      $usersData = file_get_contents($usersFile);
      $users = json_decode($usersData, true);

      if (isset($_POST['add_user'])) {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if (isset($users[$username])) {
          echo '<script>alert("L\'utilisateur existe déjà.");</script>';
        } else {

          $users[$username] = [
            'password' => $password
          ];

          $usersData = json_encode($users, JSON_PRETTY_PRINT);
          file_put_contents($usersFile, $usersData);
        }
      }

      if (isset($_POST['edit_user'])) {
        $editUsername = $_POST['edit_username'];
        $editPassword = password_hash($_POST['edit_password'], PASSWORD_DEFAULT);

        if (isset($users[$editUsername])) {
          $users[$editUsername]['password'] = $editPassword;

          $usersData = json_encode($users, JSON_PRETTY_PRINT);
          file_put_contents($usersFile, $usersData);
        }
      }

 
    if (isset($_GET['delete_user_submit'])) {
      $deleteUsername = $_GET['delete_user'];

      if (isset($users[$deleteUsername])) {
        unset($users[$deleteUsername]);

        $usersData = json_encode($users, JSON_PRETTY_PRINT);
        file_put_contents($usersFile, $usersData);
      }
    }
  ?>

    <div class="dashboard-main">
        <div class="container">
            <div class="row py-3">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <div class="dashboard-title-text">
                        <h2>Utilisateurs</h2>
                        <p class="text-grey">C'est ici que vous allez pouvoir faire la gestion de tous les comptes
                            administrateurs du SiteWeb.</p>
                    </div>
                    <button type="button" class="fs-18 text-grey-blue">
                        <i class="fas fa-ellipsis-vertical"></i>
                    </button>
                </div>
            </div>
            <div class="overview-section p-4">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-end mb-2">
                            <div class="text-end mb-3">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#ajouterUnUtilisateurModal">Ajouter un utilisateur</button>
                            </div>
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nom d'utilisateur</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="user-list-body">
                                <?php
                                  foreach ($users as $username => $userData) {
                                    echo '<tr>';
                                    echo '<td>' . $username . '</td>';
                                    echo '<td>';
                                    echo '<button class="btn btn-link edit-user" data-bs-toggle="modal" data-bs-target="#modifierUtilisateurModal" data-username="' . $username . '"><i class="fas fa-edit"></i></button>';
                                    echo '<button class="btn btn-link delete-user" data-bs-toggle="modal" data-bs-target="#supprimerUtilisateurModal" data-username="' . $username . '"><i class="fas fa-trash"></i></button>';
                                    echo '</td>';
                                    echo '</tr>';
                                  }
                                  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Module d'ajouts -->
    <div class="modal fade" id="ajouterUnUtilisateurModal" tabindex="-1" aria-labelledby="ajouterUnUtilisateurModal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ajouterUnUtilisateurModal">Ajouter un utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="mb-3">
                            <label for="username" class="form-label">Nom d'utilisateur</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary" name="add_user">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Module d'edition -->
    <div class="modal fade" id="modifierUtilisateurModal" tabindex="-1" aria-labelledby="modifierUtilisateurModal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modifierUtilisateurModal">Modifier un utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="mb-3">
                            <label for="edit_username" class="form-label">Nom d'utilisateur</label>
                            <input type="text" class="form-control" id="edit_username" name="edit_username" readonly
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="edit_password" name="edit_password"
                                required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary" name="edit_user">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Module de supression -->
    <div class="modal fade" id="supprimerUtilisateurModal" tabindex="-1" aria-labelledby="supprimerUtilisateurModal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="supprimerUtilisateurModal">Supprimer un utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="deleteUserForm" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="mb-3">
                            <label for="delete_username" class="form-label">Nom d'utilisateur</label>
                            <input type="text" class="form-control" id="delete_username" name="delete_user" readonly
                                required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-danger" name="delete_user_submit">Supprimer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript code -->
    <script>
    var editUserForm = document.getElementById('editUserForm');
    var editUsernameInput = document.getElementById('edit_username');
    var editPasswordInput = document.getElementById('edit_password');

    var editUserButtons = document.getElementsByClassName('edit-user');
    Array.from(editUserButtons).forEach(function(button) {
        button.addEventListener('click', function() {
            var username = button.getAttribute('data-username');
            editUsernameInput.value = username;
            editPasswordInput.value = '';
        });
    });

    var deleteUserForm = document.getElementById('deleteUserForm');
    var deleteUsernameInput = document.getElementById('delete_username');

    var deleteUserButtons = document.getElementsByClassName('delete-user');
    Array.from(deleteUserButtons).forEach(function(button) {
        button.addEventListener('click', function() {
            var username = button.getAttribute('data-username');
            deleteUsernameInput.value = username;
        });
    });
    </script>

    <!-- bootstrap and fontawesome scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
</body>

</html>