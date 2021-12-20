<?php
   session_start();
   if($_SESSION["autoriser"]!="oui"){
      header("location:/Formation/SiteWEB/connexion/");
      exit();
   }
?>
