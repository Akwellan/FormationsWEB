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
	$video = "";
	$userDelete = $_GET["delete"];
	if($userDelete != "") {
		$video = $_GET["video"];
		$id = $_GET["id"];
		deleteFormation($userDelete,$video,$id);
	}
?>

<!-- Fonction -->
<?php
		function deleteFormation($name,$video,$id) {
				deleteQuestionID($id);
				deleteReussiteID($id);
				deleteForma($name,$video);
		}

		function deleteForma($name,$video) {
			$path = "../video/";
	    include '../bdd/connect.php';
	    $dbname = "formations";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die('Connection failed: ' . $conn->connect_error);
			}

			$sql = "DELETE FROM `formations` WHERE `formations`.`nom` = '".$name."'";

			if ($conn->query($sql) === TRUE) {
				unlink($path.$video);
			} else {
				echo 'Error: ' . $sql . '<br>' . $conn->error;
			}

			include '../bdd/deconnect.php';
			//header("location:/Formation/SiteWEB/admin/formations.php");
		}
		function deleteQuestionID($id) {

			$path = "../video/";
	    include '../bdd/connect.php';
	    $dbname = "formations";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die('Connection failed: ' . $conn->connect_error);
			}

			$sql = "DELETE FROM `question` WHERE `question`.`id_formations` = $id;";

			if ($conn->query($sql) === TRUE) {
			} else {
				echo 'Error: ' . $sql . '<br>' . $conn->error;
			}

			include '../bdd/deconnect.php';
			//header("location:/Formation/SiteWEB/admin/questions.php");
		}

		function deleteReussiteID($id) {

			$path = "../video/";
	    include '../bdd/connect.php';
	    $dbname = "formations";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die('Connection failed: ' . $conn->connect_error);
			}

			$sql = "DELETE FROM `reussite` WHERE `reussite`.`id_formations` = $id;";

			if ($conn->query($sql) === TRUE) {
			} else {
				echo 'Error: ' . $sql . '<br>' . $conn->error;
			}

			include '../bdd/deconnect.php';
			//header("location:/Formation/SiteWEB/admin/questions.php");
		}


  // Fonction Remplissage ligne
  function setColTable($id,$user,$desc,$groupe,$video) {
    echo "<tr class=\"tr-shadow center\">
      <td>
          <label class=\"au-checkbox\">
              <input type=\"checkbox\">
              <span class=\"au-checkmark\"></span>
          </label>
      </td>
      <td>".$user."</td>
      <td>".$desc."</td>
      <td><span class=\"role user\">".$groupe."</span></td>
      <td>
          <span class=\"block-email\">".$video."</span>
      </td>

      <td>
          <div class=\"table-data-feature\">
							<button class=\"button\" data-modal=\"modal".$id."\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Modifier la formation ".$user."\">Modifier</button>
							&nbsp;&nbsp;&nbsp;&nbsp;
              <button onclick=\"demDelete('".$user."', '".$video."', '".$id."')\" class=\"item\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Supprimer la formations ".$user."\">
                  <i class=\"zmdi zmdi-delete\"></i>
              </button>
          </div>
      </td>
    </tr><tr class=\"spacer\"></tr>";
  }
  // Fonction Remplissage ligne

	// Fonction remplissage modal
	function rempliModal($id,$nom,$Groupe,$video,$desc) {
		echo "<!-- MODAL Update formations -->
          <div id=\"modal".$id."\" class=\"modal\">
            <br>
            <div class=\"modal-content\">
              <div class=\"contact-form\">
                <a class=\"close\">&times;</a>
                  <form action=\"update.php?id=".$id."\" method=\"post\" enctype=\"multipart/form-data\">
                  <h2 style=\"text-align:center\">Modifier une formations</h2>
                  <br>
                  <div>
                    <span>Nom de la formation :</span>
                    <input class=\"fname\" type=\"text\" name=\"nom\" value=\"".$nom."\" required=\"Le nom de la formation est requis !\">
                    <span>Groupe de la formation :</span>
                    <input type=\"text\" name=\"groupe\" value=\"".$Groupe."\" required=\"Le groupe de la formation est requis !\">
                    <span>Video de la formation : (Pas besoin de rechoisir la m??me video)</span>
                    <input type=\"file\" name=\"photo\" id=\"fileUpload\" value=\"".$video."\" accept=\"video/*\">
                    <div>
                      <span>Description de la formation :</span>
                      <textarea rows=\"6\" name=\"desc\" required=\"Une description pour la formation est requis !\">".$desc."</textarea>
                    </div>
                  </div>
                  <button type=\"submit\" href=\"/\"><i class=\"zmdi zmdi-plus\"></i> Ajouter formation</button>
                </form>
              </div>
            </div>
          </div>
          <!-- MODAL Update formations -->";
	}
	// Fonction remplissage modal

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
		<link href="css/popup.css" rel="stylesheet">

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
                        <li class="active has-sub">
                            <a href="formations.php">
                                <i class="fas fa-book"></i> Formations</a>
                        </li>
                        <li>
                            <a href="questions.php">
                                <i class="fas fa-question-circle"></i> Questions</a>
                        </li>
                        <li>
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
                                  <h1 class="title-1">Listes des formations</h1>
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
                                                        <a href="#"><?php echo $_SESSION["user"] ?></a>
                                                    </h5>
                                                    <span class="email"><?php echo $_SESSION["mail"] ?></span>
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
															<div class="table-data__tool">
																	<div class="table-data__tool-left"></div>
																	<div class="table-data__tool-right">
																			      <button class="button" data-modal="modalFormation"><i class="zmdi zmdi-plus"></i> Ajouter une formation</button>
																	</div>
															</div>

															<!-- MODAL Ajout formations -->
															<div id="modalFormation" class="modal">
																<br>
																<div class="modal-content">
																	<div class="contact-form">
																		<a class="close">&times;</a>
																		  <form action="upload.php" method="post" enctype="multipart/form-data">
																			<h2 style="text-align:center">Ajouter une formations</h2>
																			<br>
																			<div>
																				<span>Nom de la formation :</span>
																				<input class="fname" type="text" name="nom" placeholder="Nom" required="Le nom de la formation est requis !">
																				<span>Groupe de la formation :</span>
																				<input type="text" name="groupe" placeholder="Groupe ALL par defaut" value="ALL" required="Le groupe de la formation est requis !">
																				<span>Video de la formation :</span>
																				<input type="file" name="photo" id="fileUpload" placeholder="Video" accept="video/*" required="La video de la formation est requis !">
																				<div>
																					<span>Description de la formation :</span>
																					<textarea rows="6" name="desc" placeholder="Description de la formation" required="Une description pour la formation est requis !"></textarea>
																				</div>
																			</div>
																			<button type="submit" href="/"><i class="zmdi zmdi-plus"></i> Ajouter formation</button>
																		</form>
																	</div>
																</div>
															</div>
															<!-- MODAL Ajout formations -->


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
                                                <th>Nom</th>
                                                <th>Description</th>
                                                <th>Groupe</th>
                                                <th>Video</th>
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
                                              $sql = "SELECT * FROM `formations`";
                                              $result = $conn->query($sql);
                                              if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
																									rempliModal($row["id"],$row["nom"],$row["groupe"],$row["video"],$row["description"]);
                                                  setColTable($row["id"],$row["nom"],$row["description"],$row["groupe"],$row["video"]);
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
															<div class="table-data__tool">
																	<div class="table-data__tool-left"></div>
																	<div class="table-data__tool-right">
																      <button class="button" data-modal="modalFormation"><i class="zmdi zmdi-plus"></i> Ajouter une formation</button>
																	</div>
															</div>
                              </br>
                              <?php include 'footer.php';  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

		<script>
	      var modalBtns = [...document.querySelectorAll(".button")];
	      modalBtns.forEach(function(btn){
	        btn.onclick = function() {
	          var modal = btn.getAttribute('data-modal');
	          document.getElementById(modal).style.display = "block";
	        }
	      });

	      var closeBtns = [...document.querySelectorAll(".close")];
	      closeBtns.forEach(function(btn){
	        btn.onclick = function() {
	          var modal = btn.closest('.modal');
	          modal.style.display = "none";
	        }
	      });
	      window.onclick = function(event) {
	        if (event.target.className === "modal") {
	          event.target.style.display = "none";
	        }
	      }
		</script>

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
    <script src="js/formations.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
