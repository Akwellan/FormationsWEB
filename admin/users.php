<?php include '../connexion/session.php';  ?>

<!-- SEUL ADMIN -->
<?php
		include '../bdd/connect.php';
		$dbname = "formations";
		$countAdm = 0;
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT COUNT(*) FROM `admin` WHERE `user` = '".$_SESSION["user"]."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
					$countAdm = $row["COUNT(*)"];
			}
		}
		if($countAdm == 0){
				header("location:/Formation/SiteWEB/");
		}
		include '../bdd/deconnect.php';
?>
<!-- SEUL ADMIN -->

<?php
	$userDelete = "";
	$userDelete = $_GET["delete"];
	if($userDelete != "") {
		deleteFormation($userDelete);
	}
?>

<!-- Fonction -->

<?php



function deleteFormation($name) {

    include '../bdd/connect.php';
    $dbname = "formations";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die('Connection failed: ' . $conn->connect_error);
		}

		$sql = "DELETE FROM `reussite` WHERE `reussite`.`user` = '".$name."'";

		if ($conn->query($sql) === TRUE) {
		} else {
			echo 'Error: ' . $sql . '<br>' . $conn->error;
		}

		include '../bdd/deconnect.php';
		header("location:/Formation/SiteWEB/admin/users.php");
}

  // fonction membres
  function getNBMembre() {
    include '../bdd/connect.php';
    $dbname = "formations";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }
    $nbUser=0;
    $sql = "SELECT DISTINCT COUNT(*) FROM `reussite`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $nbUser = $row["COUNT(*)"];
      }
    }
    include '../bdd/deconnect.php';
    return $nbUser;
  }
  // fonction membres

  // fonction formations
  function getNBFormations() {
    include '../bdd/connect.php';
    $dbname = "formations";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }
    $nbForma=0;
    $sql = "SELECT DISTINCT COUNT(*) FROM `formations`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $nbForma = $row["COUNT(*)"];
      }
    }
    include '../bdd/deconnect.php';
    return $nbForma;
  }
  // fonction formations

  // fonction questions
  function getNBQuestions() {
    include '../bdd/connect.php';
    $dbname = "formations";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }
    $nbQuestions=0;
    $sql = "SELECT DISTINCT COUNT(*) FROM `question`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $nbQuestions = $row["COUNT(*)"];
      }
    }
    include '../bdd/deconnect.php';
    return $nbQuestions;
  }
  // fonction questions

  // fonction admin
  function getNBAdmin() {
    include '../bdd/connect.php';
    $dbname = "formations";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }
    $nbAdmin=0;
    $sql = "SELECT DISTINCT COUNT(*) FROM `admin`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $nbAdmin = $row["COUNT(*)"];
      }
    }
    include '../bdd/deconnect.php';
    return $nbAdmin;
  }
  // fonction admin


	// Focntion pour recup le max de form user
	function getMaxForms($groupeAD_User) {
			include '../bdd/connect.php';
			$dbname = "formations";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);

			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			$maxForm = 0;
			// $sql = "SELECT COUNT(*) FROM `formations` WHERE INSTR('".$_SESSION["groupe"]."',`groupe`)<>0;";
			$sql = "SELECT COUNT(*) FROM `formations` WHERE INSTR('".$groupeAD_User."',`groupe`)<>0;";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
						$maxForm = $row["COUNT(*)"];
				}
			}

			include '../bdd/deconnect.php';
			return $maxForm;
	}
	// Focntion pour recup le max de form user

  // Fonction Remplissage ligne
  function setColTable($user,$formRea,$qcmRea,$qcmReu,$Reussite) {
    echo "<tr class=\"tr-shadow center\">
      <td>
          <label class=\"au-checkbox\">
              <input type=\"checkbox\">
              <span class=\"au-checkmark\"></span>
          </label>
      </td>
      <td>".$user."</td>
      <td>
          <span class=\"block-email\">".$user."@groupeicare.com</span>
      </td>
      <td class=\"desc\">".$formRea."</td>
      <td>".$formRea."</td>
      <td>
          <span class=\"status--process\">".$qcmReu."</span>
      </td>


			";
			if($Reussite>70){
				echo "<td><span class=\"role member\">".$Reussite."</span></td>";
			}else {
				echo "<td><span class=\"role admin\">".$Reussite."</span></td>";
			}

      echo "
				<td>
          <div class=\"table-data-feature\">
              <button onclick=\"demDelete('".$user."')\" class=\"item\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Supprimer\">
                  <i class=\"zmdi zmdi-delete\"></i>
              </button>
              <a href=\"info-user.php?user=".$user."\" class=\"item\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Voir plus\">
                  <i class=\"zmdi zmdi-more\"></i>
              </a>
          </div>
      </td>
    </tr><tr class=\"spacer\"></tr>";
  }
  // Fonction Remplissage ligne

  // Formation REALISER
  function getFormationsRea($user) {
      include '../bdd/connect.php';
      $dbname = "formations";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $sql = "SELECT COUNT(*) FROM `reussite` WHERE `user`= '".$user."'";
      $result = $conn->query($sql);
      $count = 0;
      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $count = $row["COUNT(*)"];
        }
      }
      include '../bdd/deconnect.php';
      return $count;
  }
    // Formation REALISER

  // QCM REALISER
  function getQcmRea($user) {
    include '../bdd/connect.php';
    $dbname = "formations";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT COUNT(*) FROM `reussite` WHERE `user`= '".$user."'";
    $result = $conn->query($sql);
    $count = 0;
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $count = $row["COUNT(*)"];
      }
    }
    include '../bdd/deconnect.php';
    return $count;
  }
  // QCM REALISER

  // QCM Reussi
  function getQcmReu($user) {
        include '../bdd/connect.php';
        $dbname = "formations";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT COUNT(*) FROM `reussite` WHERE (`user`='".$user."' && `point`>70);";
        $result = $conn->query($sql);
        $count = 0;
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            $count = $row["COUNT(*)"];
          }
        }
        include '../bdd/deconnect.php';
        return $count;
    }
    // QCM Reussi

  // Calcul SCORE
  function getCalcScore($user) {
      include '../bdd/connect.php';
      $dbname = "formations";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $sql = "SELECT SUM(`point`) AS scoreTot FROM `reussite` WHERE `user` = '".$user."'";
      $result = $conn->query($sql);
      $scoreTot = 0;
      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $scoreTot = $row["scoreTot"];
        }
      }
      include '../bdd/deconnect.php';
      $max = getQcmRea($user);
      if($max != 0){
        $scoreTot = $scoreTot/$max;
      }

      return $scoreTot;
    }
  // Calcul SCORE

?>
<!-- Fonction -->

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen, THIERRY Benjamin">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Formtions - ADMIN</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">

      <?php include 'header.php';  ?>

				<!-- HEADER -->

        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/icare_logo_ligne_couleur_protec.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER MOBILE-->



        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/icare_logo_ligne_couleur_protec.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a class="js-arrow" href="/Formation/SiteWEB/admin/">
                                <i class="fas fa-tachometer-alt"></i>Menu principal</a>
                        </li>
                        <li>
                            <a href="formations.php">
                                <i class="fas fa-book"></i> Formations</a>
                        </li>
                        <li>
                            <a href="questions.php">
                                <i class="fas fa-question-circle"></i> Questions</a>
                        </li>
                        <li class="active has-sub">
                            <a href="users.php">
                                <i class="fas fa-users"></i>Utilisateurs</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

      <!-- HEADER -->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                  <h1 class="title-1">Liste des utilisateurs</h1>
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $_SESSION["user"]?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $_SESSION["user"]?></a>
                                                    </h5>
                                                    <span class="email"><?php echo $_SESSION["mail"]?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Profil</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Statistique</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
																								<a href="/Formation/SiteWEB/">
																										<i class="zmdi zmdi-account"></i>Retour au formation</a>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="/Formation/SiteWEB/connexion/deconnexion.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr class="center">
                                                <th>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </th>
                                                <th>Utilisateur</th>
                                                <th>Email</th>
                                                <th>Formations réaliser</th>
                                                <th>QCM réaliser</th>
                                                <th>QCM réussi</th>
                                                <th>% de reussite</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                              include '../bdd/connect.php';
                                              $dbname = "formations";
                                              // Create connection
                                              $conn = new mysqli($servername, $username, $password, $dbname);
                                              // Check connection
                                              if ($conn->connect_error) {
                                                die('Connection failed: ' . $conn->connect_error);
                                              }
                                              $nbUser=0;
                                              $sql = "SELECT DISTINCT `user` FROM `reussite`";
                                              $result = $conn->query($sql);
                                              if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                  $max_formation = 9;
                                                  setColTable($row["user"],getFormationsRea($row["user"])." / ".$max_formation,getQcmRea($row["user"])." / ".$max_formation,getQcmReu($row["user"])." / ".$max_formation,getCalcScore($row["user"])."%");
                                                }
                                              }
                                              include '../bdd/deconnect.php';
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                              </br>
                              </br>
                              </br>
                              </br>
                              <?php include 'footer.php';  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="js/utilisateur.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
