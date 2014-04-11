<?php //Playoff Pool Main Page
session_start();
include 'php/variables.php';
require 'php/simple_html_dom.php';
$page = "Main";

?>
<html>
<head>
    <title>NHL Playoff Pool - <? echo $page?><? if ($_SESSION['isLoggedin'] == true){echo " - ".$_SESSION['firstName']."'s Page";}?></title>
    <link type="text/css" rel="stylesheet" href="css/main.css">
    <link type="text/css" rel="stylesheet" href="css/standings.css">
    <script src="js/hideVisible.js"></script>
</head>
<body>
    <div class="header">
	    <div class="title">
		    <h1>NHL Playoff Pool - <? echo $page?><? if ($_SESSION['isLoggedin'] == true){echo " - ".$_SESSION['firstName']."'s Page";}?></h1>
	    </div>
	    <div class="nav">
			<span class="navItem">
				<a href="../PlayoffPool">Home</a>
            </span>
		    <span class="navItem">
				<a href="Pool">Pool</a>
			</span>
            <span class="navItem">
                <a href="Players">Players</a>
            </span>
		    <span class="navAccount">
			    <? if($_SESSION['isLoggedin'] == true):?>
                                  <div class="loginUser">
		                        <a onclick="visibleToggle('accountNav','subNav')">Logged in as - <?echo $_SESSION['fullName']?></a>
                                        <div class="subNav hidden" id="accountNav">
                                             <table><tr><td><a href="Account">Account</a></td></tr>
                                             <tr><td><a href="php/logout.php">Logout</a></tr></td></table>
                                        </div>
                                  </div>
			    <? else:?>
                                  <div class="loginUser">
			                <a href="Login">Login</a>
                                  </div>
			    <?endif?>
		    </span>
	    </div>
    </div>
    <div class="content">
	    <div class="StandingsRegularSeason">
              <?
              $standingsHtml = file_get_html('http://www.tsn.ca/nhl/standings/');
              $standingsEast = $standingsHtml->find("table",0);
              $standingsWest = $standingsHtml->find("table",1);
              //produces <table> <thead>/<tbody> <tr> <td>/<th> only class names are on body cells "bg1" and "bg2"
              ?>
            <div class="easternStand">
                <table>
                    <tr>
                        <? for($r = 0; $r < 231; $r++){
                            if( $r == 1 || $r == 45 || $r == 89){
                                echo '</tr><tr>';
                            }
                            else{
                                if($r == 2 || $r == 46 || $r == 90 || $r == 118){
                                    for($x = 0; $x < 14; $x++) {
                                        echo $standingsHtml->find("table th",$x);
                                    }
                                    echo "<tr>";
                                    if ($r == 118){
                                        $r++;
                                    }
                                }
                            }
                            echo $standingsHtml->find("table td",$r);
                            $r++;
                            if($r == 2 || $r == 16 || $r == 30 || $r == 46 || $r == 60 || $r == 74 || $r ==90 || $r == 104 || $r == 118 || $r ==119 || $r == 133 || $r == 147 || $r ==161 || $r == 175 || $r == 189 || $r == 203 || $r == 217){
                                echo '</tr><tr>';
                            }
                            $r--;
                        }
                        ?>
                    </tr>
                </table>
            </div>
            <div class="westernStand">
                <table>
                    <tr>
                        <? for($r = 231; $r < 434; $r++){
                            if($r == 232 || $r == 276 || $r == 320){
                                echo '</tr><tr>';
                            }
                            else{
                                if($r == 233 || $r == 277 || $r == 321 || $r == 349){
                                    for($x = 0; $x < 14; $x++) {
                                        echo $standingsHtml->find("table th",$x);
                                    }
                                    echo "<tr>";
                                    if ($r == 349){
                                        $r++;
                                    }
                                }
                            }
                            echo $standingsHtml->find("table td",$r);
                            $r++;
                            if($r == 233 || $r == 247 || $r == 261 || $r == 277 || $r == 291 || $r == 305 || $r == 321 || $r == 335 || $r == 349 || $r ==350 || $r == 364 || $r == 378 || $r ==392 || $r == 406 || $r == 420){
                                echo '</tr><tr>';
                            }
                            $r--;
                        }
                        ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="footer">
         <p class="version"><? echo $appVersion?>
         <p class="copyright"><? echo $copyright?>
    </div>

</body>
</html>