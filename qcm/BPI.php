<!DOCTYPE HTML>
<?php $nb_qcm = $_GET["qcm"]; ?>
<html>
	<head>
		<title>Formations</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<link rel="stylesheet" href="../assets/css/qcm.css" />
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

									<?php include 'qcm.php';  ?>
									
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
			<script src="../assets/js/qcm.js"></script>

	</body>
</html>
