<?php include '../connexion/session.php';  ?>
<!DOCTYPE HTML>
<?php $nb_formations = $_GET["formations"]; ?>
<html>
	<head>
		<title>Formations</title>
		<meta charset="utf-8" />
		<link rel="icon" type="image/x-icon" href="../images/favicon.ico">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<link rel="stylesheet" href="../assets/css/video.css" />
	</head>

	</style>
	<body class="no-sidebar is-preload">
		<div id="page-wrapper">

			<!-- Header -->

				<?php include '../construct/header.php';  ?>

			<!-- Main -->
				<div id="main" class="wrapper style2">
					<div class="title">Formations</div>
					<div class="container">

						<!-- Content -->
							<div id="content">
								<article class="box post">

									<?php //Connect to BDD
										include '../bdd/connect.php';
										$dbname = "formations";

										// Create connection
										$conn = new mysqli($servername, $username, $password, $dbname);
										// Check connection
										if ($conn->connect_error) {
										  die("Connection failed: " . $conn->connect_error);
										}

										$sql = "SELECT `id`,`nom`,`fichier`,`description`,`groupe`,`video` FROM `formations` WHERE `id` = ".$nb_formations;
										$result = $conn->query($sql);

										if ($result->num_rows > 0) {
										  // output data of each row
										  while($row = $result->fetch_assoc()) {

												echo "<header class='style1'><h2>".$row["nom"]."</h2></header>";

										    echo "<div class='div-diapo'>
																<video class='video' autoplay='true' muted='false' controls id='idvideo'>
																<source type='video/mp4' src='../video/".$row["video"]."' class='diapo'></source>
																Votre navigateur ne supporte pas la balise HTML5 video.
																</video>
																<script type='text/javascript'>
															    document.getElementById('idvideo').addEventListener('ended',myHandler,false);
															    function myHandler(e) {
																			let text = 'Votre formations est fini ! Voulez vous lancer le QCM ?';
																			if (window.confirm(text)) {
																				document.location.href='../pages/questionnaire.php?qcm=".$row["id"]."';
																			}
															    }
															</script>
															</div>";
												echo "<br>";
												echo "<p style='text-align: center'>".$row["description"]."</p>";
										  }
										} else {
										  echo "<p><h3 style='text-align: center'>Cette formation n'est pas disponible</h3></p>";
										}

										include '../bdd/deconnect.php';
									?>

								</article>
							</div>

					</div>
				</div>



			<!-- Footer -->
				<?php include '../construct/footer.php';  ?>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
