<html><head><title></title>
<script language="JavaScript">
<!--

var numQues = 8;
var numChoi = 3;
var id_Question = 40;

var answers = new Array(8);
answers[0] = "400|401";
answers[1] = "SRVDATACOMMUN|";
answers[2] = "L'usage d'une clef USB personnelle est interdite|Vous ne devez en aucun cas communiquer vos identifiants/mot de passe|";
answers[3] = "Connectez un appareil ICARE à un réseau public |Désactiver l'antivirus, ou le stopper|";
answers[4] = "Dix caractères / Une majuscule / Un chiffre / Une minuscule / Un caractère spécial|";
answers[5] = "Teams|";
answers[6] = "Un accès OFFICE 365 (World/Excel/Power Point) via le WEB |Un accès OFFICE 365 (World/Excel/Power Point) en local|Un accès à Outlook|";
answers[7] = "\\SRVDATA\\users\\prenom.nom|";

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
</head>

<body>

<form name="quiz">
<b>1) Identifiant -&gt; Comment est composé l'identifiant informatique : </b>
<div class="form-group">
  <input type="checkbox" name="q1" value="400" id="400">
  <label class="rep" for="400"> prenom.nom</label>
</div>
<div class="form-group">
  <input type="checkbox" name="q1" value="401" id="401">
  <label class="rep" for="401"> nom.prenom</label>
</div>
<div class="form-group">
  <input type="checkbox" name="q1" value="402" id="402">
  <label class="rep" for="402"> prenomnom</label>
</div><br>
<b>2) Dossier COMMUN -&gt; Quel est le dossier ou tous les collaborateurs ICARE ont accès ?</b>
<div class="form-group">
  <input type="checkbox" name="q2" value="\\SRVDATA\\Partage" id="\\SRVDATA\\Partage">
  <label class="rep" for="\\SRVDATA\\Partage"> \SRVDATA\Partage</label>
</div>
<div class="form-group">
  <input type="checkbox" name="q2" value="\\SRVDATA\\ALLUser" id="\\SRVDATA\\ALLUser">
  <label class="rep" for="\\SRVDATA\\ALLUser"> \SRVDATA\ALLUser</label>
</div>
<div class="form-group">
  <input type="checkbox" name="q2" value="SRVDATACOMMUN" id="SRVDATACOMMUN">
  <label class="rep" for="SRVDATACOMMUN"> SRVDATACOMMUN</label>
</div><br><b>3) Interdiction -&gt; Quel réponse est bonne ?</b>
<div class="form-group">
  <input type="checkbox" name="q3" value="L'usage d'une clef USB personnelle est interdite" id="L'usage d'une clef USB personnelle est interdite">
  <label class="rep" for="L'usage d'une clef USB personnelle est interdite"> L'usage d'une clef USB personnelle est interdite</label>
</div>
<div class="form-group">
  <input type="checkbox" name="q3" value="L'usage d'un support externe personnelle est autorisé" id="L'usage d'un support externe personnelle est autorisé">
  <label class="rep" for="L'usage d'un support externe personnelle est autorisé"> L'usage d'un support externe personnelle est autorisé</label>
</div>
<div class="form-group">
  <input type="checkbox" name="q3" value="Vous ne devez en aucun cas communiquer vos identifiants/mot de passe" id="Vous ne devez en aucun cas communiquer vos identifiants/mot de passe">
  <label class="rep" for="Vous ne devez en aucun cas communiquer vos identifiants/mot de passe"> Vous ne devez en aucun cas communiquer vos identifiants/mot de passe</label>
</div>
<br>
<b>4) Sécurité -&gt; Vous ne devez pas ... ?</b>
<div class="form-group"><input type="checkbox" name="q4" value="Connectez un appareil ICARE à un réseau public " id="Connectez un appareil ICARE à un réseau public "><label class="rep" for="Connectez un appareil ICARE à un réseau public "> Connectez un appareil ICARE à un réseau public </label></div><div class="form-group"><input type="checkbox" name="q4" value="Désactiver l'antivirus, ou le stopper" id="Désactiver l'antivirus, ou le stopper"><label class="rep" for="Désactiver l'antivirus, ou le stopper"> Désactiver l'antivirus, ou le stopper</label></div><div class="form-group"><input type="checkbox" name="q4" value="Faire les mise à jour des équipements informatiques" id="Faire les mise à jour des équipements informatiques"><label class="rep" for="Faire les mise à jour des équipements informatiques"> Faire les mise à jour des équipements informatiques</label></div>
<br>
<b>5) Mot de passe -&gt; Quel complexité doit avoir un mot de passe au sein d'ICARE ?</b>
<div class="form-group">
  <input type="checkbox" name="q5" value="Dix caractères // Une majuscule // Un chiffre // Une minuscule" id="Dix caractères // Une majuscule // Un chiffre // Une minuscule">
  <label class="rep" for="Dix caractères // Une majuscule // Un chiffre // Une minuscule"> Dix caractères / Une majuscule / Un chiffre / Une minuscule</label>
</div>
<div class="form-group">
  <input type="checkbox" name="q5" value="Dix caractères // Une majuscule // Un chiffre // Une minuscule // Un caractère spécial" id="Dix caractères // Une majuscule // Un chiffre // Une minuscule // Un caractère spécial">
  <label class="rep" for="Dix caractères // Une majuscule // Un chiffre // Une minuscule // Un caractère spécial"> Dix caractères / Une majuscule / Un chiffre / Une minuscule / Un caractère spécial</label>
</div>
<div class="form-group">
  <input type="checkbox" name="q5" value="Dix caractères // Une majuscule OU Un chiffre OU Une minuscule" id="Dix caractères // Une majuscule OU Un chiffre OU Une minuscule">
    <label class="rep" for="Dix caractères // Une majuscule OU Un chiffre OU Une minuscule"> Dix caractères / Une majuscule OU Un chiffre OU Une minuscule</label>
  </div>
  <br>
  <b>6) Communication -&gt; Quel est l'outil utilisé pour communiquer chez ICARE ?</b>
  <div class="form-group"><input type="checkbox" name="q6" value="Messenger" id="Messenger"><label class="rep" for="Messenger"> Messenger</label></div><div class="form-group"><input type="checkbox" name="q6" value="Teams" id="Teams"><label class="rep" for="Teams"> Teams</label></div><div class="form-group"><input type="checkbox" name="q6" value="Nextcloud" id="Nextcloud"><label class="rep" for="Nextcloud"> Nextcloud</label></div><br><b>7) Outil de bureautique -&gt; Quels sont les outils minima utilisé avec un compte Office  ICARE ?</b><div class="form-group"><input type="checkbox" name="q7" value="Un accès OFFICE 365 (World/Excel/Power Point) via le WEB " id="Un accès OFFICE 365 (World/Excel/Power Point) via le WEB "><label class="rep" for="Un accès OFFICE 365 (World/Excel/Power Point) via le WEB "> Un accès OFFICE 365 (World/Excel/Power Point) via le WEB </label></div><div class="form-group"><input type="checkbox" name="q7" value="Un accès OFFICE 365 (World/Excel/Power Point) en local" id="Un accès OFFICE 365 (World/Excel/Power Point) en local"><label class="rep" for="Un accès OFFICE 365 (World/Excel/Power Point) en local"> Un accès OFFICE 365 (World/Excel/Power Point) en local</label></div><div class="form-group"><input type="checkbox" name="q7" value="Un accès à Outlook" id="Un accès à Outlook"><label class="rep" for="Un accès à Outlook"> Un accès à Outlook</label></div>
  <br>
  <b>8) Réseau  -&gt; Sur le réseau ICARE vous avez accès à votre dossier personnel pour sauvegarder tout votre travail mais ou ce trouve celui-ci ?</b>
  <div class="form-group">
    <input type="checkbox" name="q8" value="\\SRVDATA\\users\\prenom.nom" id="\\SRVDATA\\users\\prenom.nom">
    <label class="rep" for="\\SRVDATA\\users\\prenom.nom"> \SRVDATA\users\prenom.nom</label>
  </div>
  <div class="form-group">
    <input type="checkbox" name="q8" value="\\SRVDATA\\prenom.nom" id="\\SRVDATA\\prenom.nom">
    <label class="rep" for="\\SRVDATA\\prenom.nom"> \SRVDATA\prenom.nom</label>
  </div>
  <div class="form-group">
    <input type="checkbox" name="q8" value="\\SRVDATA\\users\\nom.prenom" id="\\SRVDATA\\users\\nom.prenom">
    <label class="rep" for="\\SRVDATA\\users\\nom.prenom"> \SRVDATA\users\nom.prenom</label>
  </div>
  <br>

<input type="button" value="Score" onClick="getScore(this.form)">
<input type="reset" value="RAZ"><p>
Score = <input type=text size=15 name="percentage"><br>
Réponses correctes :<br>
<textarea name="solutions" wrap="virtual" rows="4" cols="40"></textarea>
</form>

</body></html>
