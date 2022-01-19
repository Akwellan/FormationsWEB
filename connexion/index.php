<?php


    function after ($ours, $inthat)
    {
        if (!is_bool(strpos($inthat, $ours)))
        return substr($inthat, strpos($inthat,$ours)+strlen($ours));
    };

  $erreur="";
  function auth($username, $password, $domain = 'icare-lims', $endpoint = 'ldap://icare-lims.local', $dc = 'dc=icare-lims,dc=local') {
  	$ldap = @ldap_connect($endpoint);
  	if(!$ldap) return false;

  	ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
  	ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

  	$bind = @ldap_bind($ldap, "$domain\\$username", $password);
  	if(!$bind) return false;

  	$result = @ldap_search($ldap, $dc, "(sAMAccountName=$username)");
  	if(!$result) return false;

  	@ldap_sort($ldap, $result, 'sn');
  	$info = @ldap_get_entries($ldap, $result);
  	if(!$info) return false;
  	if(!isset($info['count']) || $info['count'] !== 1) return false;

  	$data = [];

    $allGroupe = "";

    foreach($info[0]["memberof"] AS $groupe)
    {
      $allGroupe = $allGroupe.substr($groupe, 0, -44);
    }

  	foreach($info[0] as $key => $value) {
  		if(is_numeric($key)) continue;
  		if($key === 'count') continue;

  		$data[$key] = (array)$value;
  		unset($data[$key]['count']);
  	}

  	return [
  		'mail' => $data['mail'][0],
      'memberof' => $allGroupe,
  		'displayname' => $data['displayname'][0]
  	];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Connexion formations</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/x-icon" href="../images/favicon.ico">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>
				<?php if(empty($_POST['username']) || empty($_POST['password'])) { ?>
				<form method="POST" action="" class="login100-form validate-form">

					<div class="wrap-input100 validate-input" data-validate = "Nom d'utilisateur Session Windows">
						<input class="input100" type="text" name="username" placeholder="Nom d'utilisateur">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Mot de passe Session Windows">
						<input class="input100" type="password" name="password" placeholder="Mot de passe">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">Connexion</button>
					</div>
					<br><br><br>
				</form>
			<?php } else {
				$info = auth($_POST['username'], $_POST['password']);

				if(!$info) {
					 echo '<div class="alert alert-danger text-center">Mauvais login ou mot de passe!<br>
					 <div class="container-login100-form-btn">
 						<button onclick="window.location.href = \'/Formation/SiteWEB/connexion/\'" class="login100-form-btn">Retour à la page de connexion</button>
 					</div></div>';
				}
				else {
					session_start();
					echo '<div class="alert alert-success text-center">Login success</div><h1 class="text-center"><a href="mailto:' . $info['mail'] . '">' . $info['displayname'] . '</a></h1>';
					sleep(1);
					$_SESSION["user"]=$_POST['username'];
					$_SESSION["mail"]=$info['mail'];
					$_SESSION["groupe"]=$info['memberof'].",DC=ALL";;
					$_SESSION["autoriser"]="oui";
          $afterLink = after('?', $_SERVER['REQUEST_URI']);
					header("location:/Formation/SiteWEB/".$afterLink);
				}
			}
			?>
			</div>
		</div>
	</div>




<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
