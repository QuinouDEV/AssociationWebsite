<?php
    session_start();

    $identifiant = $_POST['identifiant'];
    $motdepasse = $_POST['motdepasse'];


    $users = json_decode(file_get_contents('admin/users.json'), true);
    print_r($users[$identifiant]['password']);


    if (isset($users[$identifiant]) && password_verify($motdepasse, $users[$identifiant]['password'])) {
        $_SESSION['user'] = "admin";
        header("Location: admin/dashboard.php");
    } else {
        header("Location: login.php?err=1");
    }
?>