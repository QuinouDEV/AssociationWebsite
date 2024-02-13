<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="icon" href="img/logo.png" type="image/png">
    <title>IFJR - Connexion</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="img/icon.png" />
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
             background: rgb(152,178,44);
 background-image: linear-gradient(to bottom, #e1b428, #cfb424, #bdb424, #aab327, #98b22c);
            background-size: cover;
            background-position: center;
        }

        #connexion {
            max-width: 400px;
            width: 90%;
            margin: 0 auto;
            padding: 2em;
            background-color: #f2f2f2;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: slideIn 0.5s ease;
        }

        #connexion input[type="text"],
        #connexion input[type="password"] {
            width: 100%;
            padding: 1em;
            margin: 1em 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 4px;
        }

        #connexion button[type="submit"] {
            width: 100%;
            background-color: #98B22C;
            color: white;
            padding: 1.2em;
            margin: 1em 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #connexion button[type="submit"]:hover {
            background-color: #2a6808;
        }

        #connexion input[type="text"]:focus,
        #connexion input[type="password"]:focus {
            border: 2px solid #4CAF50;
            transition: border-color 0.3s;
        }

        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: translateY(2em);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        img{
            width: 30%;
        }
    </style>
</head>
<body>
    <div id="connexion">
        <div class="d-flex justify-content-center">
            <a href="index.php" ><img class="rounded mx-auto d-block" src="img/logo.png" alt="Logo"></a>
        </div>
        
        <?php
        if (isset($_GET['err']) && $_GET['err'] == 1) {
            echo '<div class="alert alert-danger" role="alert">Identifiant ou mot de passe incorrect.</div>';
        }
        ?>
        
        <form action="verificationConnexion.php" method="POST">
            <div class="mb-3">
                <label for="identifiant" class="form-label">Identifiant:</label>
                <input type="text" name="identifiant" id="identifiant" class="form-control" value="admin" required>
            </div>

            <div class="mb-3">
                <label for="motdepasse" class="form-label">Mot de passe:</label>
                <input type="password" name="motdepasse" id="motdepasse" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
