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
	$quesDelete = "";
	$video = "";
	$quesDelete = $_GET["delete"];
	if($quesDelete != "") {
		$id = $_GET["id"];
			$id_forma = $_GET["id_forma"];
				$titre_forma = $_GET["titre_forma"];
		deleteFormation($quesDelete,$id,$id_forma,$titre_forma);
	}
?>


<?php $titre_forma = ""; $titre_forma = $_GET["titre"]; ?>
<?php $id_forma = ""; $id_forma = $_GET["id"];
	rempliModalAdd($id_forma,$titre_forma);
?>

<!-- Fonction -->

<?php
	function deleteFormation($name,$video,$id_forma,$titre_forma) {
		$path = "../video/";
		include '../bdd/connect.php';
		$dbname = "formations";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die('Connection failed: ' . $conn->connect_error);
		}

		$sql = "DELETE FROM `question` WHERE `question`.`id` = '".$video."'";

		if ($conn->query($sql) === TRUE) {
			unlink($path.$video);
		} else {
			echo 'Error: ' . $sql . '<br>' . $conn->error;
		}

		include '../bdd/deconnect.php';
		header("location:/Formation/SiteWEB/admin/info-question.php?titre=".$titre_forma."&id=".$id_forma);
	}
  // Fonction Remplissage ligne
  function setColTable($titre,$desc,$rep,$rep_vrai,$id,$id_forma,$titre_forma) {
		$titreRema = str_replace("'","\'",$titre);
    echo "<tr class=\"tr-shadow center\">
      <td>
          <label class=\"au-checkbox\">
              <input type=\"checkbox\">
              <span class=\"au-checkmark\"></span>
          </label>
      </td>
      <td>".$titre."</td>
      <td>".$desc."</td>
      <td>".$rep."</td>
      <td>".$rep_vrai."</td>
			<td>
				<div class=\"table-data-feature\">
						<button data-modal=\"modal".$id."\" class=\"item\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Modifier la question pour la formation ".$titre."\">
								<i class=\"zmdi zmdi-edit\"></i>
						</button>
						<button onclick=\"demDelete('".$titreRema."', '".$id."', '".$id_forma."', '".$titre_forma."')\" class=\"items\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Supprimer la question ".$titre."\">
								<i class=\"zmdi zmdi-delete\"></i>
						</button>
          </div>
      </td>

    </tr><tr class=\"spacer\"></tr>";
  }
  // Fonction Remplissage ligne

	// Fonction remplissage modal
	function rempliModal($titre,$desc,$rep1,$rep2,$rep3,$rep_valide1,$rep_valide2,$rep_valide3,$id,$id_forma,$titre_forma) {
		echo "<!-- MODAL Update formations -->
					<div id=\"modal".$id."\" class=\"modal\">
						<br>
						<div class=\"modal-content\">
							<div class=\"contact-form\">
								<a class=\"close\">&times;</a>
									<form action=\"update-questions-2.php?titre=".$titre_forma."&id=".$id."&id_forma=".$id_forma."\" method=\"post\" enctype=\"multipart/form-data\">
									<h2 style=\"text-align:center\">Modifier la question pour la formation : \"".$titre."\"</h2>
									<br>
									<div>
										<span>Titre de la question :</span>
										<input class=\"fname\" type=\"text\" name=\"titre\" value=\"".$titre."\" required=\"Le nom de la question est requis !\">

										<br>

										<span>Réponse 1 :</span>
										<input class=\"fname\" type=\"text\" name=\"rep1\" value=\"".$rep1."\" required=\"Réponse n°1 !\">

										<span>Réponse 2 :</span>
										<input class=\"fname\" type=\"text\" name=\"rep2\" value=\"".$rep2."\" required=\"Réponse n°2 !\">
										<span>Réponse 3 :</span>
										<input class=\"fname\" type=\"text\" name=\"rep3\" value=\"".$rep3."\" required=\"Réponse n°3 !\">

										<br>

										<div class=\"row form-group\">
											<div class=\"col col-md-3\">
													<label class=\" form-control-label\">Réponse valide :</label>
											</div>
											<div class=\"col col-md-9\">
													<div class=\"form-check\">
															<div class=\"checkbox\">
																	<label for=\"checkbox1\" class=\"form-check-label \">
																			<input type=\"checkbox\" id=\"checkbox1\" name=\"rep_valide1\" value=\"rep_valide1\" class=\"form-check-input\" ".$rep_valide1.">Réponse n°1
																	</label>
															</div>
															<div class=\"checkbox\">
																	<label for=\"checkbox2\" class=\"form-check-label \">
																			<input type=\"checkbox\" id=\"checkbox2\" name=\"rep_valide2\" value=\"rep_valide2\" class=\"form-check-input\" ".$rep_valide2."> Réponse n°2
																	</label>
															</div>
															<div class=\"checkbox\">
																	<label for=\"checkbox3\" class=\"form-check-label \">
																			<input type=\"checkbox\" id=\"checkbox3\" name=\"rep_valide3\" value=\"rep_valide3\" class=\"form-check-input\" ".$rep_valide3."> Réponse n°3
																	</label>
															</div>
													</div>
											</div>
									</div>

									<div>
								<span>Question posé :</span>
								<textarea rows=\"6\" name=\"desc\" required=\"Il est obligatoire de demandé une question !\">".$desc."</textarea>
							</div>
						</div>
						<button type=\"submit\" href=\"/\"><i class=\"zmdi zmdi-plus\"></i> Modifier la question</button>
					</form>
				</div>
			</div>
		</div>
		<!-- MODAL Update formations -->";
	}
	// Fonction remplissage modal

	// Fonction remplissage modal
	function rempliModalAdd($id,$nom) {
		echo "
					<div id=\"modalAjout\" class=\"modal\">
						<br>
						<div class=\"modal-content\">
							<div class=\"contact-form\">
								<a class=\"close\">&times;</a>
									<form action=\"upload-questions-2.php?titre=".$nom."&id=".$id."\" method=\"post\" enctype=\"multipart/form-data\">
									<h2 style=\"text-align:center\">Ajouter une question pour la formation : \"".$nom."\"</h2>
									<br>
									<div>
										<span>Titre de la question :</span>
										<input class=\"fname\" type=\"text\" name=\"titre\" placeholder=\"Indiquer un titre pour la question\" required=\"Le nom de la question est requis !\">

										<br>

										<span>Réponse 1 :</span>
										<input class=\"fname\" type=\"text\" name=\"rep1\" placeholder=\"Réponse 1\" required=\"Réponse n°1 !\">
										<span>Réponse 2 :</span>
										<input class=\"fname\" type=\"text\" name=\"rep2\" placeholder=\"Réponse 2\" required=\"Réponse n°2 !\">
										<span>Réponse 3 :</span>
										<input class=\"fname\" type=\"text\" name=\"rep3\" placeholder=\"Réponse 3\" required=\"Réponse n°3 !\">

										<br>

										<div class=\"row form-group\">
											<div class=\"col col-md-3\">
													<label class=\" form-control-label\">Réponse valide :</label>
											</div>
											<div class=\"col col-md-9\">
													<div class=\"form-check\">
															<div class=\"checkbox\">
																	<label for=\"checkbox1\" class=\"form-check-label \">
																			<input type=\"checkbox\" id=\"checkbox1\" name=\"rep_valide1\" value=\"rep_valide1\" class=\"form-check-input\">Réponse n°1
																	</label>
															</div>
															<div class=\"checkbox\">
																	<label for=\"checkbox2\" class=\"form-check-label \">
																			<input type=\"checkbox\" id=\"checkbox2\" name=\"rep_valide2\" value=\"rep_valide2\" class=\"form-check-input\"> Réponse n°2
																	</label>
															</div>
															<div class=\"checkbox\">
																	<label for=\"checkbox3\" class=\"form-check-label \">
																			<input type=\"checkbox\" id=\"checkbox3\" name=\"rep_valide3\" value=\"rep_valide3\" class=\"form-check-input\"> Réponse n°3
																	</label>
															</div>
													</div>
											</div>
									</div>

									<div>
								<span>Question posé :</span>
								<textarea rows=\"6\" name=\"desc\" required=\"Il est obligatoire de demandé une question !\"></textarea>
							</div>
						</div>
						<button type=\"submit\" href=\"/\"><i class=\"zmdi zmdi-plus\"></i> Ajouter la question</button>
					</form>
				</div>
			</div>
		</div>
		";
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
    <title>Information Questions - ADMIN</title>

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
                        <li>
                            <a href="formations.php">
                                <i class="fas fa-book"></i> Formations</a>
                        </li>
                        <li class="active has-sub">
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
                                  <h1 class="title-1">Questions de la formation - <?php echo $titre_forma ?></h1>
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
															<div class="table-data__tool">
																	<div class="table-data__tool-left"></div>
																	<div class="table-data__tool-right">
																			      <button class="button" data-modal="modalAjout"><i class="zmdi zmdi-plus"></i> Ajouter une question</button>
																	</div>
															</div>
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
                                                <th>Titre</th>
                                                <th>Description</th>
                                                <th>Réponse</th>
                                                <th>Réponse vrai</th>
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
                                              $sql = "SELECT * FROM `question` WHERE `id_formations` = $id_forma;";
                                              $result = $conn->query($sql);
                                              if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {

																									$rep_bdd = $row["reponse"];
																							    $reponse = explode("|", $rep_bdd);

																									$rep_valide_bdd = $row["reponse_vrai"];
																									$lastChar = substr($rep_valide_bdd, -1);
																									if($lastChar=="|"){
																										$rep_valide_bdd = substr($rep_valide_bdd, 0, -1);
																									}

																							    $reponse_valide = explode("|", $rep_valide_bdd);

																									$reponse_valide_max = sizeof($reponse_valide);

																									$key = "";$key1 = "";$key2 = "";
																									$reponse_valide_checked1 = "";$reponse_valide_checked2 = "";$reponse_valide_checked3 = "";

																									switch ($reponse_valide_max) {
																										case 1:
																											$key = array_search($reponse_valide[0], $reponse)+1;
																											break;
																										case 2:
																											$key = array_search($reponse_valide[0], $reponse)+1;
																											$key1 = array_search($reponse_valide[1], $reponse)+1;
																											break;
																										case 3:
																											$key = array_search($reponse_valide[0], $reponse)+1;
																											$key1 = array_search($reponse_valide[1], $reponse)+1;
																											$key2 = array_search($reponse_valide[2], $reponse)+1;
																											break;
																									}

																									if($key == 1) {
																										$reponse_valide_checked1 = "checked";
																									} else if($key == 2) {
																										$reponse_valide_checked2 = "checked";
																									} else if($key == 3) {
																										$reponse_valide_checked3 = "checked";
																									}

																									if($key1 == 1) {
																										$reponse_valide_checked1 = "checked";
																									} else if($key1 == 2) {
																										$reponse_valide_checked2 = "checked";
																									} else if($key1 == 3) {
																										$reponse_valide_checked3 = "checked";
																									}

																									if($key2 == 1) {
																										$reponse_valide_checked1 = "checked";
																									} else if($key2 == 2) {
																										$reponse_valide_checked2 = "checked";
																									} else if($key2 == 3) {
																										$reponse_valide_checked3 = "checked";
																									}

																									rempliModal($row["nom"],$row["description"],$reponse[0],$reponse[1],$reponse[2],$reponse_valide_checked1,$reponse_valide_checked2,$reponse_valide_checked3,$row["id"],$id_forma,$titre_forma);

                                                  setColTable($row["nom"],$row["description"],$row["reponse"],$row["reponse_vrai"],$row["id"],$id_forma,$titre_forma);
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
															<button onclick="Retour()" type="button" class="btn btn-primary btn-lg btn-block">Retour au menu des questions</button>
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
				var modalBtns = [...document.querySelectorAll(".item")];
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
    <script src="vendor/slick/slick.min.js"></script>
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
    <script src="js/question.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
