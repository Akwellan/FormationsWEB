<?php include '../connexion/session.php';  ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Formations</title>
		<meta charset="utf-8" />
		<link rel="icon" type="image/x-icon" href="../images/favicon.ico">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
	</head>
	<body class="no-sidebar is-preload">
		<div id="page-wrapper">

			<!-- Header -->

				<?php include '../construct/header.php';  ?>

			<!-- Main -->
				<div id="main" class="wrapper style2">
					<div class="title">Questionnaire</div>
					<div class="container">

						<!-- Content -->
							<div id="content">
								<article class="box post">
									<header class="style1">
										<h2>Questionnaire disponible</h2>
										<p>Vous retrouvez ici, tous les questionnaires disponible sous forme de QCM.</p>
									</header>

									<!-- Recuperer SCORE USER -->
									<?php
									function getScore($nb_qcm,$user) {
										include '../bdd/connect.php';
										$dbname = "formations";
										// Create connection
										$conn = new mysqli($servername, $username, $password, $dbname);
										// Check connection
										if ($conn->connect_error) {
											die('Connection failed: ' . $conn->connect_error);
										}
										$score="";
										$sql = "SELECT `point` FROM `reussite` WHERE `user`='".$user."' AND `id_formations`=".$nb_qcm;
										$result = $conn->query($sql);
										if ($result->num_rows > 0) {
											while($row = $result->fetch_assoc()) {
												$score = $row["point"];
											}
										}
										include '../bdd/deconnect.php';
										if($score != ""){
											return $score;
										}
									}

									?>
									<!-- Recuperer SCORE USER -->
									
									<?php
										include '../bdd/connect.php';
										$dbname = "formations";

										// Create connection
										$conn = new mysqli($servername, $username, $password, $dbname);
										// Check connection
										if ($conn->connect_error) {
										  die("Connection failed: " . $conn->connect_error);
										}

										$sql = "SELECT `id`,`nom`,`description`,`groupe` FROM `formations`";
										$result = $conn->query($sql);

										if ($result->num_rows > 0) {
										  // output data of each row
										  while($row = $result->fetch_assoc()) {
												$score = getScore($row["id"],$_SESSION["user"]);
												if($score > 70) {
										    	echo "<p><h3><a href='formations-video.php?formations=".$row["id"]."'>⇒ ".$row["nom"]." :</a><span style=\"color:green;\"> Questionnaire reussi à $score%</span></h3>".$row["description"]."</p>";
												} elseif ($score < 70 && $score != "") {
											    echo "<p><h3><a href='formations-video.php?formations=".$row["id"]."'>⇒ ".$row["nom"]." :</a><span style=\"color:red;\"> Questionnaire échoué à $score%</span></h3>".$row["description"]."</p>";
												} else {
											    echo "<p><h3><a href='formations-video.php?formations=".$row["id"]."'>⇒ ".$row["nom"]." :</a></h3>".$row["description"]."</p>";
												}
										  }
										} else {
										  echo "<p><h3 style='text-align: center'>Aucune formations disponibles</h3></p>";
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
