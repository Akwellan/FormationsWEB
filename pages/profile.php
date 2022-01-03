<?php include '../connexion/session.php';  ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Formations</title>
		<link rel="icon" type="image/x-icon" href="../images/favicon.ico">
		<meta charset="utf-8" />
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
										<h2>Formations disponible</h2>
										<p>Vous retrouvez ici, tous les formations disponible sous forme de VIDEO.</p>
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

								</article>
							</div>

					</div>
				</div>



			<!-- Footer -->
				<?php include '../construct/footer.php';  ?>

		</div>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.dropotron.min.js"></script>
			<script src="../assets/js/browser.min.js"></script>
			<script src="../assets/js/breakpoints.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>

	</body>
</html>
