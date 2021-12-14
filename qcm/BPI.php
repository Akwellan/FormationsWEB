<!DOCTYPE HTML>
<?php $nb_qcm = $_GET["qcm"]; ?>
<html>
	<head>
		<title>Formations</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
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

									<script language="JavaScript">
									<!--

									var numQues = 0;
									var numChoi = 4;

									var answers = new Array();
									answers[0] = "Praesent , hendrerit, ";
									answers[1] = "Praesent , ";
									answers[2] = "Curabitur , Praesent , ";

									numQues = count(answers());

									function getScore(form) {
									  var score = 0;
									  var currElt;
									  var currSelection;
									  var bon = false;

									  for (i=0; i<numQues; i++) {
									    currElt = i*numChoi;
									    bon=false;
									    for (j=0; j<numChoi; j++) {
									      currSelection = form.elements[currElt + j];
									      if ((currSelection.checked)&&(answers[i].indexOf(currSelection.value) != -1)) {
									        bon=true;}
									      if ((currSelection.checked)&&(answers[i].indexOf(currSelection.value) == -1)) {
									        bon=false;
									        break;
									        }
									      if (!(currSelection.checked)&&(answers[i].indexOf(currSelection.value) != -1)) {
									        bon=false;
									        break;
									        }
									    }
									    if (bon==true) {score++}
									  }

									  score = Math.round(score/numQues*100);
									  form.percentage.value = score + "%";

									  var correctAnswers = "";
									  for (i=1; i<=numQues; i++) {
									    correctAnswers += i + ". " + answers[i-1] + "\r\n";
									  }
									  form.solutions.value = correctAnswers;

									}

									// -->
									</script>

									<script>
										answers[3] = "fdhgd , sfgdf , ";
										answers[4] = "fdhgd , sfgdf , ";
										alert(count(answers));
									</script>

									<form name="quiz">
									<b>1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</b><br>
									<input type="checkbox" name="q1" value="Praesent ">Praesent <br>
									<input type="checkbox" name="q1" value="hendrerit">hendrerit<br>
									<input type="checkbox" name="q1" value="accumsan ">accumsan <br>
									<input type="checkbox" name="q1" value="Curabitur ">Curabitur <br>
									<p>

									<b>2. Pellentesque dignissim vehicula mauris, eget ornare nunc lobortis ac. </b><br>
									<input type="checkbox" name="q2" value="orci">orci<br>
									<input type="checkbox" name="q2" value="sed ">sed <br>
									<input type="checkbox" name="q2" value="Praesent ">Praesent <br>
									<input type="checkbox" name="q2" value="pharetra">pharetra<br>
									<p>

									<b>3. Duis venenatis libero vestibulum cursus pharetra. Nam quis nunc orci.</b><br>
									<input type="checkbox" name="q3" value="Curabitur ">Curabitur <br>
									<input type="checkbox" name="q3" value="congue ">congue <br>
									<input type="checkbox" name="q3" value="ullamcorper ">ullamcorper <br>
									<input type="checkbox" name="q3" value="Praesent ">Praesent <br>
									<p>

									<input type="button" value="Score" onClick="getScore(this.form)">
									<input type="reset" value="RAZ"><p>
									Score = <input type=text size=15 name="percentage"><br>
									Réponses correctes :<br>
									<textarea name="solutions" wrap="virtual" rows="4" cols="40"></textarea>
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
