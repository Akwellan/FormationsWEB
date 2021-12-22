<?php include '../connexion/session.php';  ?>
<!DOCTYPE HTML>
<?php $nb_qcm = $_GET["qcm"]; ?>
<html>
	<head>
		<title>Formations</title>
		<meta charset="utf-8" />
		<link rel="icon" type="image/x-icon" href="../images/favicon.ico">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<link rel="stylesheet" href="../assets/css/checkbox.css" />
		<link rel="stylesheet" href="../assets/css/resultat.css" />
	</head>

	</style>
	<body class="no-sidebar is-preload">
		<div id="page-wrapper">

			<!-- Header -->
			<?php include '../construct/header.php';  ?>

			<!-- Main -->
				<div id="main" class="wrapper style2">
					<div class="title">Resultat</div>
					<div class="container">

						<!-- Content -->
							<div id="content">
								<article class="box post">

									<!-- AFFICHE READ -->
									<?php
										include '../bdd/connect.php';
										$dbname = "formations";
										// Create connection
										$conn = new mysqli($servername, $username, $password, $dbname);

										// Check connection
										if ($conn->connect_error) {
										  die("Connection failed: " . $conn->connect_error);
										}
										$sql = "SELECT `id`,`nom`,`description`,`groupe`,`video` FROM `formations` WHERE `id`=".$nb_qcm;
										$result = $conn->query($sql);
										if ($result->num_rows > 0) {
										  // output data of each row
										  while($row = $result->fetch_assoc()) {
												$nomQuestion = $row["nom"];
												echo "<header class='style1'><h2>Résultat du questionnaire : ".$row["nom"]."</h2>";
												echo "<p>Pour l'utilisateur : ".$_SESSION["user"]."</p></header>";
										  }
										}
										include '../bdd/deconnect.php';
									?>
									<!-- AFFICHE READ -->



									<div class="resultat">

										<!-- Recuperer SCORE USER -->
										<?php
											include '../bdd/connect.php';
											$dbname = "formations";
									    // Create connection
									    $conn = new mysqli($servername, $username, $password, $dbname);
									    // Check connection
									    if ($conn->connect_error) {
									      die('Connection failed: ' . $conn->connect_error);
									    }
									    $sql = "SELECT `point` FROM `reussite` WHERE `user`='".$_SESSION["user"]."' AND `id_formations`=".$nb_qcm;
									    $result = $conn->query($sql);
									    if ($result->num_rows > 0) {
									      while($row = $result->fetch_assoc()) {
									        $score = $row["point"];
									      }
									    }
									    include '../bdd/deconnect.php';
										?>
										<!-- Recuperer SCORE USER -->

										<?php
											if($score > 70) {
												echo "<h2>Félicitation, vous avez réussi avec succés le QCM ".$nomQuestion."</h2>";
												echo "<p>Vous avez reussi à obtenir la note de ".$score."%</p>";
											} else {
												echo "<h2>Malheureusement, vous avez échouée au QCM ".$nomQuestion."</h2>";
												echo "<p>Vous avez obtenu la note de ".$score."%</p>";
												echo "<a href=\"/Formation/SiteWEB/pages/questionnaire.php?qcm=".$nb_qcm."\"><button>Réessayer le QCM</button></a>";
											}
										 ?>
									</div>
									<div class="buttonRetourHome">
										<a href="/Formation/SiteWEB/pages/formations.php"><button>Retourner aux Formations</button></a>
										<a href="/Formation/SiteWEB/"><button>Retourner à l'accueil</button></a>
									</div>
								</article>
							</div>
					</div>
				</div>
				<p class="aste">
					*Il vous faut obtenir plus de 70% pour avoir reussit le questionnaire.<br>
					*La note inscrite ici est la meilleur note obtenu de tous les essais.
				</p>


			<!-- Footer -->
			<?php include '../construct/footer.php';  ?>

		</div>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.dropotron.min.js"></script>
			<script src="../assets/js/browser.min.js"></script>
			<script src="../assets/js/breakpoints.min.js"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>

	</body>
</html>
