<?php
  chdir("Formateurs");
  $i = 2;
  $chaine = "";
  $DeptMaj = strtoupper($_POST['depart']);

  if(file_exists($DeptMaj)){
    $TotalFichiers = scandir($DeptMaj);
    chdir($DeptMaj);
    while(isset($TotalFichiers[$i])){
      $FichierJSON = file_get_contents($TotalFichiers[$i]);
      $FichierDECODE = json_decode($FichierJSON,true);
      $chaine = $chaine.$FichierDECODE["antenne"].";". $FichierDECODE["nom"].";". $FichierDECODE["prenom"].";". $FichierDECODE["mel"].";". $FichierDECODE["role"].";". $FichierDECODE["tel"].";".$FichierDECODE["dept"]."|"; 
      if($FichierDECODE["nom"] == "NULL"){
        $chaine="";
        $chaine = "SPE:NULL";
      }
      if($FichierDECODE["nom"] == "EC"){
        $chaine="";
        $chaine = "SPE:EC;".$FichierDECODE["antenne"].";".$FichierDECODE["mel"].";".$FichierDECODE["dept"];
      }
      $i++;
      }
    echo $chaine;
  }else{
    echo 'no';
  }
?>
