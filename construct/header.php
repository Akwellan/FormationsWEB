<section id="header" class="wrapper">
	
	<!-- Logo -->
		<div id="logo">
			<h1><a href="#">Formations Informatiques - ICARE</a></h1>
			<p>Vous pouvez retrouver ici toutes les formations informatiques</p>
		</div>
		<!-- Nav -->
			<nav id="nav">
				<ul>
					<li class="current"><a href="https://192.168.17.175/Formation/SiteWEB/"><i class="fas fa-home"></i> Accueil</a></li>
					<li><a href="https://192.168.17.175/Formation/SiteWEB/pages/formations.php"><i class="fas fa-chalkboard-teacher"></i> Formations</a></li>
					<li><a href="https://192.168.17.175/Formation/SiteWEB/pages/QCM.php"><i class="fas fa-question"></i> Questionnaire</a></li>
					<li>
						<a href="#"><i class="fas fa-users"></i> <?php echo $_SESSION["user"] ?></a>
						<ul>
							<li><a href="#"><i class="far fa-id-card"></i> Profil</a></li>
							<li><a href="#"><i class="fas fa-star-half-alt"></i> Statistique</a></li>
							<li><a href="/Formation/SiteWEB/connexion/deconnexion.php"><i class="fas fa-times-circle"></i> Déconnexion</a></li>
						</ul>
				</li>
				</ul>
			</nav>
</section>
