<?php $titre_formation = ""; $titre_formation = $_GET["titre"]; ?>
<?php $id_formation = ""; $id_formation = $_GET["id"]; ?>

<?php
 // Fonction d'insert dans la BDD
  function insert($id,$nom,$desc,$rep,$rep_vrai) {
    include '../bdd/connect.php';

    // Create connection
    $conn = new mysqli($servername, $username, $password, "formations");
    // Check connection
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
      return false;
    }

    // $sql = "INSERT INTO `formations` (`id`, `nom`, `description`, `groupe`, `video`) VALUES (NULL, '".$nom."', '".$desc."', '".$groupe."', '".$video."');";
    $sql = "INSERT INTO `question` (`id`, `nom`, `description`, `reponse`, `reponse_vrai`, `id_formations`) VALUES (NULL, '".$nom."', '".$desc."', '".$rep."', '".$rep_vrai."', '".$id."');";

    if ($conn->query($sql) === TRUE) {
    } else {
      echo 'Error: ' . $sql . '<br>' . $conn->error;
      return false;
    }

    include '../bdd/deconnect.php';
    return true;
  }
  // Fonction d'insert dans la BDD
?>


<?php

  // Vérifier si le formulaire a été soumis
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
        $id = $_GET["id"];

        $titre = $_POST["titre"];
        $desc = $_POST["desc"];

        $rep1 = $_POST["rep1"];
        $rep2 = $_POST["rep2"];
        $rep3 = $_POST["rep3"];

        $rep_valide1 = @$_POST["rep_valide1"];
        $rep_valide2 = @$_POST["rep_valide2"];
        $rep_valide3 = @$_POST["rep_valide3"];

        $rep = "$rep1|$rep2|$rep3";
        $rep_valide = "";
        if($rep_valide1!=""){$rep_valide.=$rep1."|";}
        if($rep_valide2!=""){$rep_valide.=$rep2."|";}
        if($rep_valide3!=""){$rep_valide.=$rep3."|";}

        $titre = str_replace("'","\'",$titre);
        $desc = str_replace("'","\'",$desc);
        $rep = str_replace("'","\'",$rep);
        $rep_valide = str_replace("'","\'",$rep_valide);

        if(insert($id,$titre,$desc,$rep,$rep_valide)){
          header("location:/Formation/SiteWEB/admin/info-question.php?titre=".$titre_formation."&id=".$id_formation);
        } else {
          echo "Erreur rencontré lors de l'ajout de la question veuillez contacter un administrateur !";
        }

  }
?>
