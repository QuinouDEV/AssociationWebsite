<?php
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $region = $_POST['region'];
        
        
        $filePath = "formations/$region/$id.json";
        print_r($filePath);

        if (file_exists($filePath)) {
            unlink($filePath);
            echo "La formation a été supprimée avec succès.";
        } else {
            echo "La formation n'a pas pu être trouvée.";
        }
    } else {
        echo "L'ID de la formation n'a pas été spécifié.";
    }
?>
