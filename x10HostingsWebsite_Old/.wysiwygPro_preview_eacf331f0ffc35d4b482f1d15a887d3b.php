<?php
if ($_GET['randomId'] != "MWDzsFoQkMdutmW5Vf1fGhtcG4Sojq_MIF1nlZcC9W6Z83DuD_aq4TaFU7Dun2Br") {
    echo "Access Denied";
    exit();
}

// display the HTML code:
echo stripslashes($_POST['wproPreviewHTML']);

?>  
