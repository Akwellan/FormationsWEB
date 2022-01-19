<?php
    session_start();
    function after ($ours, $inthat)
    {
        if (!is_bool(strpos($inthat, $ours)))
        return substr($inthat, strpos($inthat,$ours)+strlen($ours));
    }

   if($_SESSION["autoriser"]!="oui"){
      $afterLink = after('/Formation/SiteWEB/', $_SERVER['REQUEST_URI']);
      echo $afterLink;
      header("location:/Formation/SiteWEB/connexion/?".$afterLink);
      exit();
   }
?>
