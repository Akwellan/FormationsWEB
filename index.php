<?php include 'connexion/session.php';  ?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Formation Informatique</title>
		<link rel="icon" type="image/x-icon" href="images/favicon.ico">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="homepage is-preload">
		<div id="page-wrapper">

			<!-- Header -->
			<?php
					include 'bdd/connect.php';
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

					include 'bdd/deconnect.php';
			?>
			<section id="header" class="wrapper">

				<!-- Logo -->
					<div id="logo">
						<h1><a href="#">Formations Informatiques - ICARE</a></h1>
						<p>Vous pouvez retrouver ici toutes les formations informatiques</p>
					</div>
					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li class="current"><a href="/Formation/SiteWEB/"><i class="fas fa-home"></i> Accueil</a></li>
								<li><a href="/Formation/SiteWEB/pages/formations.php"><i class="fas fa-chalkboard-teacher"></i> Formations</a></li>
								<li><a href="/Formation/SiteWEB/pages/QCM.php"><i class="fas fa-question"></i> Questionnaire</a></li>
								<li>
									<a href="#"><i class="fas fa-users"></i> <?php echo $_SESSION["user"] ?></a>
									<ul>
										<li><a href="/Formation/SiteWEB/pages/profile.php"><i class="far fa-id-card"></i> Profil</a></li>

										<?php if($countAdm!=0){echo "<li><a href=\"/Formation/SiteWEB/pages/admin.php\"><i class=\"fas fa-users-cog\"></i> Administration</a></li>";} ?>
										<li><a href="/Formation/SiteWEB/pages/stats.php"><i class="fas fa-star-half-alt"></i> Statistique</a></li>
										<li><a href="/Formation/SiteWEB/connexion/deconnexion.php"><i class="fas fa-times-circle"></i> Déconnexion</a></li>
									</ul>
							</li>
							</ul>
						</nav>
			</section>

			<!-- Intro -->
				<section id="intro" class="wrapper style1">
					<div class="title">Neque porro quisquam</div>
					<div class="container">
						<p class="style2">Lorem Ipsum</p>
						<p class="style3">Proin pretium augue eget varius sodales. Sed et lobortis diam, vitae mattis augue. Duis sodales mauris non mi posuere vehicula vitae vel magna. Praesent tortor arcu, pellentesque eu cursus venenatis, blandit id velit. Pellentesque sagittis, mauris ac viverra pellentesque, est felis aliquam lorem, a porttitor justo libero eget lacus. Donec consectetur mi nisi, sed venenatis nisi tincidunt sed. Mauris imperdiet, urna at pellentesque tincidunt, mi arcu accumsan quam, sit amet molestie enim libero in odio. Integer consequat venenatis leo, pellentesque sagittis eros consequat dapibus. Fusce convallis quam in libero cursus, quis semper sem facilisis. Sed rhoncus leo a sem auctor, id feugiat justo dignissim. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Cras porttitor pharetra auctor. Nam semper aliquet massa, vel tempor lectus sagittis sed.</p>
						<ul class="actions">
							<li><a href="pages/formations.php" class="button style3 large">Commencer</a></li>
						</ul>
					</div>
				</section>

			<!-- Footer -->
			<?php include 'construct/footer.php';  ?>

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
