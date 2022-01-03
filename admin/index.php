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

<!-- Fonction -->
<?php

  // fonction membres
  function getMembre() {
    include '../bdd/connect.php';
    $dbname = "formations";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }
    $nbUser=0;
    $sql = "SELECT COUNT(DISTINCT `user`) as 'nbMembre' FROM `reussite`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $nbUser = $row["nbMembre"];
      }
    }
    include '../bdd/deconnect.php';
    return $nbUser;
  }
  // fonction membres

  // fonction formations
  function getFormations() {
    include '../bdd/connect.php';
    $dbname = "formations";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }
    $nbForma=0;
    $sql = "SELECT DISTINCT COUNT(*) FROM `formations`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $nbForma = $row["COUNT(*)"];
      }
    }
    include '../bdd/deconnect.php';
    return $nbForma;
  }
  // fonction formations

  // fonction questions
  function getQuestions() {
    include '../bdd/connect.php';
    $dbname = "formations";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }
    $nbQuestions=0;
    $sql = "SELECT DISTINCT COUNT(*) FROM `question`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $nbQuestions = $row["COUNT(*)"];
      }
    }
    include '../bdd/deconnect.php';
    return $nbQuestions;
  }
  // fonction questions

  // fonction admin
  function getAdmin() {
    include '../bdd/connect.php';
    $dbname = "formations";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }
    $nbAdmin=0;
    $sql = "SELECT DISTINCT COUNT(*) FROM `admin`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $nbAdmin = $row["COUNT(*)"];
      }
    }
    include '../bdd/deconnect.php';
    return $nbAdmin;
  }
  // fonction admin

?>
<!-- Fonction -->

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen, THIERRY Benjamin">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Formtions - ADMIN</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">

      <?php include 'header.php';  ?>

				<!-- HEADER -->

        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/icare_logo_ligne_couleur_protec.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER MOBILE-->



        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/icare_logo_ligne_couleur_protec.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="/Formation/SiteWEB/admin/">
                                <i class="fas fa-tachometer-alt"></i>Menu principal</a>
                        </li>
                        <li>
                            <a href="formations.php">
                                <i class="fas fa-book"></i> Formations</a>
                        </li>
                        <li>
                            <a href="questions.php">
                                <i class="fas fa-question-circle"></i> Questions</a>
                        </li>
                        <li>
                            <a href="users.php">
                                <i class="fas fa-users"></i>Utilisateurs</a>
                        </li>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <li>
                            <a href="chart.html">
                                <i class="fas fa-chart-bar"></i>Charts</a>
                        </li>
                        <li>
                            <a href="table.html">
                                <i class="fas fa-table"></i>Tables</a>
                        </li>
                        <li>
                            <a href="form.html">
                                <i class="far fa-check-square"></i>Forms</a>
                        </li>
                        <li>
                            <a href="calendar.html">
                                <i class="fas fa-calendar-alt"></i>Calendar</a>
                        </li>
                        <li>
                            <a href="map.html">
                                <i class="fas fa-map-marker-alt"></i>Maps</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="login.html">Login</a>
                                </li>
                                <li>
                                    <a href="register.html">Register</a>
                                </li>
                                <li>
                                    <a href="forget-pass.html">Forget Password</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>UI Elements</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="button.html">Button</a>
                                </li>
                                <li>
                                    <a href="badge.html">Badges</a>
                                </li>
                                <li>
                                    <a href="tab.html">Tabs</a>
                                </li>
                                <li>
                                    <a href="card.html">Cards</a>
                                </li>
                                <li>
                                    <a href="alert.html">Alerts</a>
                                </li>
                                <li>
                                    <a href="progress-bar.html">Progress Bars</a>
                                </li>
                                <li>
                                    <a href="modal.html">Modals</a>
                                </li>
                                <li>
                                    <a href="switch.html">Switchs</a>
                                </li>
                                <li>
                                    <a href="grid.html">Grids</a>
                                </li>
                                <li>
                                    <a href="fontawesome.html">Fontawesome Icon</a>
                                </li>
                                <li>
                                    <a href="typo.html">Typography</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

<!-- HEADER -->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                  <h1 class="title-1">Menu principal</h1>
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $_SESSION["user"]?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $_SESSION["user"]?></a>
                                                    </h5>
                                                    <span class="email"><?php echo $_SESSION["mail"]?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Profil</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Statistique</a>
                                                </div>
                                            </div>

                                            <div class="account-dropdown__footer">
																								<a href="#">
																										<i class="zmdi zmdi-account"></i>Retour au formation</a>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="#">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Quelques chiffres</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo getMembre(); ?></h2>
                                                <span>Membres</span>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-graduation-cap"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo getFormations(); ?></h2>
                                                <span>Formations</span>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-question"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo getQuestions(); ?></h2>
                                                <span>Questions</span>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-unlock"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo getAdmin(); ?></h2>
                                                <span>Administrateurs</span>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <h2 class="title-1 m-b-25 center">Liste des Utilisateurs</h2>
                                <div class="au-card au-card--bg-1 au-card-top-countries m-b-40">
                                  <div class="au-card-inner">
                                      <div class="table-responsive">
                                          <table class="table table-top-countries">
                                              <tbody>
                                                  <!-- Recuperer LIGNE -->
                                                  <?php

                                                    include '../bdd/connect.php';
                                                    $dbname = "formations";
                                                    // Create connection
                                                    $conn = new mysqli($servername, $username, $password, $dbname);
                                                    // Check connection
                                                    if ($conn->connect_error) {
                                                      die('Connection failed: ' . $conn->connect_error);
                                                    }
                                                    $score="";
                                                    $sql = "SELECT DISTINCT `user` FROM `reussite` ORDER BY RAND() LIMIT 7";
                                                    $result = $conn->query($sql);
                                                    if ($result->num_rows > 0) {
                                                      while($row = $result->fetch_assoc()) {
                                                        echo "<tr>
                                                                <td class=\"center\">".$row["user"]."</td>
                                                            </tr>";
                                                      }
                                                    }else {
                                                    }
                                                    include '../bdd/deconnect.php';

                                                  ?>
                                                  <!-- Recuperer LIGNE -->
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <h2 class="title-1 m-b-25 center">Liste des Formations</h2>
                                <div class="au-card au-card--bg-2 au-card-top-countries m-b-40 ">
                                  <div class="au-card-inner">
                                      <div class="table-responsive">
                                          <table class="table table-top-countries">
                                              <tbody>
                                                  <!-- Recuperer LIGNE -->
                                                  <?php

                                                    include '../bdd/connect.php';
                                                    $dbname = "formations";
                                                    // Create connection
                                                    $conn = new mysqli($servername, $username, $password, $dbname);
                                                    // Check connection
                                                    if ($conn->connect_error) {
                                                      die('Connection failed: ' . $conn->connect_error);
                                                    }
                                                    $score="";
                                                    $sql = "SELECT `nom`,`groupe` FROM `formations` ORDER BY RAND() LIMIT 7";
                                                    $result = $conn->query($sql);
                                                    if ($result->num_rows > 0) {
                                                      while($row = $result->fetch_assoc()) {
                                                        echo "<tr>
                                                                <td style=\"text-align:center;\">".$row["nom"]."</td>
                                                            </tr>";
                                                      }
                                                    }else {
                                                    }
                                                    include '../bdd/deconnect.php';

                                                  ?>
                                                  <!-- Recuperer LIGNE -->
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <h2 class="title-1 m-b-25">Liste des Questions</h2>
                                <div class="au-card au-card--bg-3 au-card-top-countries m-b-40">
                                  <div class="au-card-inner">
                                      <div class="table-responsive">
                                          <table class="table table-top-countries">
                                              <tbody>
                                                  <!-- Recuperer LIGNE -->
                                                  <?php

                                                    include '../bdd/connect.php';
                                                    $dbname = "formations";
                                                    // Create connection
                                                    $conn = new mysqli($servername, $username, $password, $dbname);
                                                    // Check connection
                                                    if ($conn->connect_error) {
                                                      die('Connection failed: ' . $conn->connect_error);
                                                    }
                                                    $score="";
                                                    $sql = "SELECT `nom` FROM `question` ORDER BY RAND() LIMIT 7";
                                                    $result = $conn->query($sql);
                                                    if ($result->num_rows > 0) {
                                                      while($row = $result->fetch_assoc()) {
                                                        echo "<tr>
                                                                <td style=\"text-align:center;\">".$row["nom"]."</td>
                                                            </tr>";
                                                      }
                                                    }else {
                                                    }
                                                    include '../bdd/deconnect.php';

                                                  ?>
                                                  <!-- Recuperer LIGNE -->
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <h2 class="title-1 m-b-25">Liste des Admins</h2>
                                <div class="au-card au-card--bg-4 au-card-top-countries m-b-40">
                                  <div class="au-card-inner">
                                      <div class="table-responsive">
                                          <table class="table table-top-countries">
                                              <tbody>
                                                  <!-- Recuperer LIGNE -->
                                                  <?php

                                                    include '../bdd/connect.php';
                                                    $dbname = "formations";
                                                    // Create connection
                                                    $conn = new mysqli($servername, $username, $password, $dbname);
                                                    // Check connection
                                                    if ($conn->connect_error) {
                                                      die('Connection failed: ' . $conn->connect_error);
                                                    }
                                                    $score="";
                                                    $sql = "SELECT `user` FROM `admin` ORDER BY RAND() LIMIT 7";
                                                    $result = $conn->query($sql);
                                                    if ($result->num_rows > 0) {
                                                      while($row = $result->fetch_assoc()) {
                                                        echo "<tr>
                                                                <td style=\"text-align:center;\">".$row["user"]."</td>
                                                            </tr>";
                                                      }
                                                    }else {
                                                    }
                                                    include '../bdd/deconnect.php';

                                                  ?>
                                                  <!-- Recuperer LIGNE -->
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                        </br>
                        </br>
                        </br>
                        </br>

                        <?php include 'footer.php';  ?>

                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
