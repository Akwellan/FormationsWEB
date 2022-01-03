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
					<div class="title">Administrations</div>
					<div class="container">

						<!-- Content -->
							<div id="content">
								<article class="box post">
									<header class="style1">
										<h2>Administrations</h2>
										<p>Vous retrouvez ici, tous les formations disponible sous forme de VIDEO.</p>
									</header>

									<?php include '../admin/index3.php';  ?>

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
