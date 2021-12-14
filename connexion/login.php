<?php
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

	foreach($info[0] as $key => $value) {
		if(is_numeric($key)) continue;
		if($key === 'count') continue;

		$data[$key] = (array)$value;
		unset($data[$key]['count']);
	}

	return [
		'mail' => $data['mail'][0],
		'displayname' => $data['displayname'][0]
	];
}
?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
	<title>AD</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/latest/css/bootstrap.css">
	<style>
		form {max-width: 300px;margin:auto}
		input {margin-bottom:10px}
         .erreur{
            color:#CC0000;
            margin-bottom:10px;
         }
	</style>
</head>
<body>
	<div class="container">
		<h1 class="text-center">Active Directory</h1>
		<?php if(empty($_POST['username']) || empty($_POST['password'])) { ?>
		<form method="POST" action="">
			<input type="text" name="username" placeholder="Nom d'utilisateur Session Windows" class="form-control" required>
			<input type="password" name="password" placeholder="Mot de passe Session Windows" class="form-control" required>
			<input type="submit" class="btn btn-default btn-block" value="Login">
		</form>
		<?php } else {
			$info = auth($_POST['username'], $_POST['password']);

			if(!$info) {
				 echo '<div class="alert alert-danger text-center">Mauvais login ou mot de passe!<br><br>
				 <a href="./login.php">Retour à la page de connexion !</a></div>';
			}
			else {
				session_start();
				echo '<div class="alert alert-success text-center">Login success</div><h1 class="text-center"><a href="mailto:' . $info['mail'] . '">' . $info['displayname'] . '</a></h1>';
				$_SESSION["prenomNom"]=$info['displayname'];
				$_SESSION["autoriser"]="oui";
         		header("location:session.php");
			} 
		}
		?>
	</div>
</body>
</html>