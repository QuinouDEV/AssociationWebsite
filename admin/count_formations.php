<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header("Location: ../login.php");
    exit();
  }


function countFiles($dir)
{
    $count = 0;

    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') {
            continue;
        }

        $path = $dir . '/' . $file;

        if (is_file($path)) {
            $count++;
        } elseif (is_dir($path)) {
            $count += countFiles($path);
        }
    }

    return $count;
}


$previousData = [];
if (file_exists('formations.json')) {
    $jsonData = file_get_contents('formations.json');
    $previousData = json_decode($jsonData, true);
}


$folderPath = 'formations'; 

$count = countFiles($folderPath);


$newData = [
    'formationsCount' => $count,
    'timestamp' => time()
];


$previousData[] = $newData;

$jsonData = json_encode($previousData); 


echo $count;
?>