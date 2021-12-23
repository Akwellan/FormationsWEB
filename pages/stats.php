<?php include '../connexion/session.php';  ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Formations</title>
		<link rel="icon" type="image/x-icon" href="../images/favicon.ico">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<link rel="stylesheet" href="../assets/css/tablo.css" />
	</head>
	<body class="no-sidebar is-preload">
		<div id="page-wrapper">

			<!-- Header -->

				<?php include '../construct/header.php';  ?>

			<!-- Main -->
				<div id="main" class="wrapper style2">
					<div class="title">Statistique formation</div>
					<div class="container">

						<!-- Content -->
							<div id="content">
								<article class="box post">
									<header class="style1">
										<h2>Statistique</h2>
										<p>Vous retrouvez ici, toutes les formations que vous avez réalisé.</p>
										<br>
									</header>


												<!-- COUNT FORMATIONS -->
												<?php
													include '../bdd/connect.php';
													$dbname = "formations";

													// Create connection
													$conn = new mysqli($servername, $username, $password, $dbname);
													// Check connection
													if ($conn->connect_error) {
													  die("Connection failed: " . $conn->connect_error);
													}
													$sql = "SELECT COUNT(*) FROM `formations` WHERE INSTR('".$_SESSION["groupe"]."',`groupe`)<>0;";
													$result = $conn->query($sql);

													if ($result->num_rows > 0) {
													  // output data of each row
													  while($row = $result->fetch_assoc()) {
																echo "<h3>Vous avez actuelement : ".$row["COUNT(*)"]." formations à faire.</h3><br>";
														}
													}

													include '../bdd/deconnect.php';
												?>
												<!-- COUNT FORMATIONS -->

												<!-- COUNT FORMATIONS FAITE-->
												<?php
													include '../bdd/connect.php';
													$dbname = "formations";

													// Create connection
													$conn = new mysqli($servername, $username, $password, $dbname);
													// Check connection
													if ($conn->connect_error) {
													  die("Connection failed: " . $conn->connect_error);
													}
													$sql = "SELECT COUNT(*) FROM `reussite` WHERE `user`= '".$_SESSION["user"]."'";
													$result = $conn->query($sql);

													if ($result->num_rows > 0) {
													  // output data of each row
													  while($row = $result->fetch_assoc()) {
															$countFormationfaite = $row["COUNT(*)"];
														}
													}

													include '../bdd/deconnect.php';
												?>
												<!-- COUNT FORMATIONS FAITE -->

												<!-- Recuperer LIGNE -->
												<?php

													if($countFormationfaite != 0) {
														if($countFormationfaite != 1) {echo "<h3>Vous avez fait actuelement : ".$countFormationfaite." formations.</h3><br>";}
														else {echo "<h3>Vous avez fait actuelement : ".$countFormationfaite." formation.</h3><br>";}


														echo "<table class=\"table-fill\">
																	<thead>
																		<tr>
																			<th class=\"text-left\">Nom</th>
																			<th class=\"text-left\">Date</th>
																			<th class=\"text-left\">Score</th>
																			<th class=\"text-left\">A refaire</th>
																		</tr>
																	</thead>
																	<tbody class=\"table-hover\">
																		<tr>";

																		include '../bdd/connect.php';
																		$dbname = "formations";
																		// Create connection
																		$conn = new mysqli($servername, $username, $password, $dbname);
																		// Check connection
																		if ($conn->connect_error) {
																			die('Connection failed: ' . $conn->connect_error);
																		}
																		$score="";
																		$sql = "SELECT * FROM reussite INNER JOIN formations ON reussite.id_formations = formations.id WHERE `user` = '".$_SESSION["user"]."'";
																		$result = $conn->query($sql);
																		if ($result->num_rows > 0) {
																			while($row = $result->fetch_assoc()) {
																				echo "<tr><td class=\"text-left\">".$row["nom"]."</td>";
																				echo "<td class=\"text-left\">".$row["date"]."</td>";
																				echo "<td class=\"text-left\">".$row["point"]."</td>";
																				if($row["point"]>70){
																					echo "<td class=\"text-left reussi\">Non</td></tr>";
																				}else {
																					echo "<td class=\"text-left nonReussi\">Oui</td></tr>";
																				}
																			}
																		}else {
																		}
																		include '../bdd/deconnect.php';
																	} else {
																		echo "<h3>Aucune formation n'a été faite !<br>";
																		echo "<a style=\"color:black;\" href=\"/Formation/SiteWEB/pages/formations.php\">Cliquer ici pour commencer !</a></h3>";
																	}

																	echo "</tr>
															</tbody>
														</table>";
												?>
												<!-- Recuperer LIGNE -->
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
