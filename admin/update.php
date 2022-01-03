<?php
 // Fonction d'insert dans la BDD
  function updateAll($id,$nom,$desc,$groupe,$video) {
    include '../bdd/connect.php';

    // Create connection
    $conn = new mysqli($servername, $username, $password, "formations");
    // Check connection
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }

    // $sql = "INSERT INTO `formations` (`id`, `nom`, `description`, `groupe`, `video`) VALUES (NULL, '".$nom."', '".$desc."', '".$groupe."', '".$video."');";
    $sql = "UPDATE `formations` SET `nom` = '".$nom."', `description` = '".$desc."', `groupe` = '".$groupe."', `video` = '".$video."' WHERE `formations`.`id` = ".$id.";";

    if ($conn->query($sql) === TRUE) {
    } else {
      echo 'Error: ' . $sql . '<br>' . $conn->error;
    }

    include '../bdd/deconnect.php';
  }
  // Fonction d'insert dans la BDD


   // Fonction d'insert dans la BDD
    function update($id,$nom,$desc,$groupe) {
      include '../bdd/connect.php';

      // Create connection
      $conn = new mysqli($servername, $username, $password, "formations");
      // Check connection
      if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
      }

      // $sql = "INSERT INTO `formations` (`id`, `nom`, `description`, `groupe`, `video`) VALUES (NULL, '".$nom."', '".$desc."', '".$groupe."', '".$video."');";
      $sql = "UPDATE `formations` SET `nom` = '".$nom."', `description` = '".$desc."', `groupe` = '".$groupe."' WHERE `formations`.`id` = ".$id.";";

      if ($conn->query($sql) === TRUE) {
      } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
      }

      include '../bdd/deconnect.php';
    }
    // Fonction d'insert dans la BDD
?>


<?php
  $path = "../video/";
  $id = $_GET["id"];
  $name = $_POST["nom"];
  $desc = $_POST["desc"];
  $groupe = $_POST["groupe"];
  $video = "";
  // Vérifier si le formulaire a été soumis
  if($_SERVER["REQUEST_METHOD"] == "POST"){
      // Vérifie si le fichier a été uploadé sans erreur.
      if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
          // $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
          $filename = $_FILES["photo"]["name"];
          $video = $filename;
          $filetype = $_FILES["photo"]["type"];
          $filesize = $_FILES["photo"]["size"];

          echo "Name : ".$filename;

          // Vérifie l'extension du fichier
          $ext = pathinfo($filename, PATHINFO_EXTENSION);
          // if(!array_key_exists($ext, $allowed)) die("Erreur : Veuillez sélectionner un format de fichier valide.");

          // Vérifie la taille du fichier - 5Mo maximum
          $maxsize = 100 * 1024 * 1024;
          if($filesize > $maxsize) die("Error: La taille du fichier est supérieure à la limite autorisée.");

          // Vérifie le type MIME du fichier
          // if(in_array($filetype)){
              // Vérifie si le fichier existe avant de le télécharger.
              if(file_exists($path . $_FILES["photo"]["name"])){
                  echo $_FILES["photo"]["name"] . " existe déjà.";
              } else{
                  move_uploaded_file($_FILES["photo"]["tmp_name"], $path . $_FILES["photo"]["name"]);
                  echo "Votre fichier a été téléchargé avec succès.";
                  $name = str_replace("'","\'",$name);
                  $desc = str_replace("'","\'",$desc);
                  $groupe = str_replace("'","\'",$groupe);
                  $video = str_replace("'","\'",$video);
                  updateAll($id,$name,$desc,$groupe,$video);
                  header("location:/Formation/SiteWEB/admin/formations.php");
              }
          // } else{
          //     echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.";
          // }
      } else if($_FILES["photo"]["error"] == 4){
            // Vérifie si le fichier existe avant de le télécharger.

            $name = str_replace("'","\'",$name);
            $desc = str_replace("'","\'",$desc);
            $groupe = str_replace("'","\'",$groupe);
            update($id,$name,$desc,$groupe);
            header("location:/Formation/SiteWEB/admin/formations.php");

      } else {
          echo "Error: " . $_FILES["photo"]["error"];
      }
    }
?>
