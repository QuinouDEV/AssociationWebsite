<?php
    session_start();
    if (isset($_POST["deco"])) {
        unset($_SESSION['user']);
        session_destroy();
        header("Location: login.php");
        exit(); // quitter
    }
?>