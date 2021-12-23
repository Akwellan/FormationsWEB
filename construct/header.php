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

		include '../bdd/deconnect.php';
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
