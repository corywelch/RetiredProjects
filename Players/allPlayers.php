<?php
session_start();
include '../php/variables.php';
require '../php/simple_html_dom.php';
$page = "AllPlayers";
?>
<html>
    <head>
        <title><?echo $page;?></title>
    </head>
    <body>
    <?
    //Start letter (A) = 65
    //Last Letter (Z) = 90
    for($i = 65; $i <=90; $i++){
        $letter = chr($i);
        $url = "http://www.tsn.ca/nhl/teams/players/?letter=".$letter;
        $link = file_get_html($url);
        $table = $link->find('table',0);
        echo $table;
    }

    ?>

    </body>
</html>