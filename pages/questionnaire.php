<!DOCTYPE HTML>
<?php $nb_qcm = $_GET["qcm"]; ?>
<html>
	<head>
		<title>Formations</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<link rel="stylesheet" href="../assets/css/checkbox.css" />
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

									<script src="../assets/js/qcm.js"></script>

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

										$sql = "SELECT COUNT(*) FROM `question` WHERE `id_formations`=".$nb_qcm;
										$result = $conn->query($sql);

										if ($result->num_rows > 0) {
											while($row = $result->fetch_assoc()) {
												echo "<script type='text/javascript'>numQues = ".$row["COUNT(*)"].";</script>";
											}
										}
										include '../bdd/deconnect.php';
									?>
									<!-- SELECT COUNT -->

									<!-- SELECT REPONSE -->
									<?php
										include '../bdd/connect.php';
										$dbname = "formations";

										// Create connection
										$conn = new mysqli($servername, $username, $password, $dbname);
										// Check connection
										if ($conn->connect_error) {
											die("Connection failed: " . $conn->connect_error);
										}

										$sql = "SELECT `id`,`nom`,`description`,`reponse`,`reponse_vrai`,`id_formations` FROM `question` WHERE `id_formations`=".$nb_qcm;
										$result = $conn->query($sql);

										if ($result->num_rows > 0) {
											$i = 0;
											while($row = $result->fetch_assoc()) {
												echo "<script type='text/javascript'>answers[".$i."] = '".$row["reponse_vrai"]."';</script>";
												$i++;
											}
										}
										include '../bdd/deconnect.php';
									?>
									<!-- SELECT REPONSE -->

									<form class="quiz" name="quiz">

										<!-- SELECT REPONSE -->
										<?php
											include '../bdd/connect.php';
											$dbname = "formations";

											// Create connection
											$conn = new mysqli($servername, $username, $password, $dbname);
											// Check connection
											if ($conn->connect_error) {
												die("Connection failed: " . $conn->connect_error);
											}

											$sql = "SELECT `id`,`nom`,`description`,`reponse`,`reponse_vrai`,`id_formations` FROM `question` WHERE `id_formations`=".$nb_qcm;
											$result = $conn->query($sql);

											$i = 1;
											$nbques = 1;
											if ($result->num_rows > 0) {
												// output data of each row
												while($row = $result->fetch_assoc()) {
													$numQuestion = $i;
													$titre=$row["nom"];
													$description=$row["description"];
													$question=$row["reponse"];
													$questions = array();
													$questions=explode('|',$question);
													echo "<b>".$numQuestion.") ".$titre." -> ".$description."</b>";
													$nbQuestions = sizeof($questions);
													for ($x=0;$x<$nbQuestions;$x++) {
														echo "<div class='form-group'><input type='checkbox' name='q".$i."' value='".$questions[$x]."' id='".$questions[$x]."'><label class='rep' for='".$questions[$x]."'> ".$questions[$x]."</label></div>";
														$nbques = "nbrep : ".$x;
													}
													$i++;
													echo "<br>";
												}
												$nbques++;
												echo "<script type='text/javascript'>var numChoi = ".$nbques.";</script>";
												echo "<input type='button' value='Valider' onClick='getScore(this.form)'>&nbsp;&nbsp;&nbsp;
										<input type='reset' value='Réinitialiser'><p><br>
										Score : <input type=text size=15 name='percentage'>";
									} else {
										echo " Aucune question n'est disponible sur ce questionnaire !<br>Veuillez contacter un administarteur.";
									}

											include '../bdd/deconnect.php';
										?>
										<!-- SELECT REPONSE -->


									</form>

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
