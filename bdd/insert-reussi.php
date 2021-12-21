<?php include '../connexion/session.php';  ?>

<?php
  $dbname = $_GET["db"];
  $score = $_GET["score"];
  $name = $_GET["name"];
  $numQCM = $_GET["numQCM"];
  $countQCM = 0;
 ?>

<!-- SELECT COUNT(*)FROM `reussite` WHERE `user`='benjamin.thierry' AND `id_formations`=1; -->

<!-- SELECT COUNT -->
<?php
  include '../bdd/connect.php';
  $dbname = "formations";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT COUNT(*)FROM `reussite` WHERE `user`='".$name."' AND `id_formations`=".$numQCM;
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $countQCM = $row["COUNT(*)"];
    }
  }
  include '../bdd/deconnect.php';
?>
<!-- SELECT COUNT -->



<?php

  if($countQCM == 0){
    echo "<script>alert(\"$countQCM == 0\")</script>";
    insert($name,$score,$numQCM,$dbname);
  } else {
    $scoreMaintenant = $score;
    $scoreAvant = getScore($name,$numQCM,$dbname);
    if($scoreMaintenant > $scoreAvant) {
      update($name,$score,$numQCM,$dbname);
    }else {
      returnHome($numQCM);
    }
  }

 ?>

<!-- Fonction PHP -->
<?php

  // Fonction d'insert dans la BDD
  function insert($name,$score,$numQCM,$dbname) {
    include '../bdd/connect.php';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }

    $sql = "INSERT INTO `reussite` (`id`, `user`, `point`, `id_formations`) VALUES (NULL,'".$name."', '".$score."', '".$numQCM."')";

    if ($conn->query($sql) === TRUE) {
    } else {
      echo 'Error: ' . $sql . '<br>' . $conn->error;
    }

    include '../bdd/deconnect.php';
    returnHome($numQCM);
  }
  // Fonction d'insert dans la BDD

  // Fonction d'update dans la BDD
  function update($name,$score,$numQCM,$dbname) {
    include '../bdd/connect.php';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }

    $sql = "UPDATE `reussite` SET `point` = '".$score."' WHERE `reussite`.`user`='".$name."' AND `reussite`.`id_formations`=".$numQCM;

    if ($conn->query($sql) === TRUE) {

    } else {
      echo 'Error: ' . $sql . '<br>' . $conn->error;
    }

    include '../bdd/deconnect.php';
    returnHome($numQCM);
  }
  // Fonction d'update dans la BDD


  // Fonction permettant de savoir si l'utilisateur à déja fait le questionnaire
  function getScore($name,$numQCM,$dbname) {
    include '../bdd/connect.php';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }

    $sql = "SELECT `point` FROM `reussite` WHERE `user`='".$name."' AND `id_formations`=".$numQCM;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $score = $row["point"];
      }
    }

    include '../bdd/deconnect.php';
    return $score;
  }
  // Fonction permettant de savoir si l'utilisateur à déja fait le questionnaire

  // Fonction de return to Home
  function returnHome($numQCM) {
    sleep(1);
    header("location:/Formation/SiteWEB/pages/resultat.php?qcm=".$numQCM);
  }
  // Fonction de return to Home

?>
<!-- Fonction PHP -->
