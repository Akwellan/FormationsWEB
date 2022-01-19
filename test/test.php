<?php

    function after ($ours, $inthat)
    {
        if (!is_bool(strpos($inthat, $ours)))
        return substr($inthat, strpos($inthat,$ours)+strlen($ours));
    };

    $afterLink = after('?', 'https://192.168.17.175/Formation/SiteWEB/connexion/?pages/QCM.php');

    echo $afterLink;

?>
