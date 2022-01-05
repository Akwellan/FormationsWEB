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
	</head>

	</style>
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
										$sql = "SELECT `id`,`nom`,`description`,`groupe`,`video` FROM `formations` WHERE `id` = ".$nb_qcm;
										$result = $conn->query($sql);
										if ($result->num_rows > 0) {
										  // output data of each row
										  while($row = $result->fetch_assoc()) {
												echo "<header class=\"style1\"><h2>Questionnaire : ".$row["nom"]."</h2>";
												echo "<p>Bonne chance pour votre QCM !</p></header>";
												echo "<p>UNE OU PLUSIEURS RÉPONSE SONT ATTENDU !</p>";
										  }
										}

										include '../bdd/deconnect.php';
									?>
									<!-- AFFICHE READ -->

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
												echo "<script type=\"text/javascript\">numQues = ".$row["COUNT(*)"].";</script>";
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
												$repVraiSTR = "";
												$repVrai=explode('|',$row["reponse_vrai"]);
												for ($x=0;$x<sizeof($repVrai)-1;$x++) {
													$repVraiSTR .= $row["id"].$repVrai[$x]."|";
												}
												echo "<script type=\"text/javascript\">answers[".$i."] = \"".$repVraiSTR."\";</script>";
												$i++;
											}
										}
										include '../bdd/deconnect.php';
									?>
									<!-- SELECT REPONSE -->

									<form class="quiz" name="quiz" method="post">

										<?php	echo "<script type=\"text/javascript\">var user = \"".$_SESSION['user']."\";var nb_ques = ".$nb_qcm.";</script>";?>



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
											$nbques = 0;
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
														$reponse = $questions[$x];
														// $reponse = str_replace("\\","&#92;",$reponse);

														$numeroQuestion = $row["id"].$x;

														echo "<div class=\"form-group\">
																	  <input type=\"checkbox\" name=\"q".$i."\" value=\"".$numeroQuestion."\" id=\"".$numeroQuestion."\">
																	  <label class=\"rep\" for=\"".$numeroQuestion."\">".$reponse."</label>
																	</div>";
													}
													echo "<br>";
													$i++;
												}
												$nb_Question = $i-1;
												echo "<script>var numQues = ".$nb_Question.";</script>";
												echo "<input type=\"button\" name=\"Valider\" value=\"Valider et envoyer les réponses\" onClick=\"main(this.form);\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<input type=\"reset\" value=\"Redémarrer le QCM\">&nbsp;&nbsp;&nbsp;<p><br>
												";
											} else {
												echo "Aucune question n'est disponible sur ce questionnaire !<br>Veuillez contacter un administarteur.";
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
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>

	</body>
</html>
