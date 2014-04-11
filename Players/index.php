<?php
session_start();
include '../php/variables.php';
require '../php/simple_html_dom.php';
$page = "Players";

?>
<html>
<head>
    <title>NHL Playoff Pool - <? echo $page?><? if ($_SESSION['isLoggedin'] == true){echo " - ".$_SESSION['firstName']."'s Page";}?></title>
    <link type="text/css" rel="stylesheet" href="../css/main.css">
    <script src="../js/hideVisible.js"></script>
</head>
<body>
    <div class="header">
	    <div class="title">
		    <h1>NHL Playoff Pool - <? echo $page?><? if ($_SESSION['isLoggedin'] == true){echo " - ".$_SESSION['firstName']."'s Page";}?></h1>
	    </div>
	    <div class="nav">
			<span class="navItem">
				<a href="../../PlayoffPool">Home</a>
			</span>
		    <span class="navItem">
				<a href="../Pool">Pool</a>
			</span>
            <span class="navItem">
                <a href="../Players">Players</a>
            </span>
		    <span class="navAccount">
			    <? if($_SESSION['isLoggedin'] == true):?>
                    <div class="loginUser">
		                <a onclick="visibleToggle('accountNav','subNav')">Logged in as - <?echo $_SESSION['fullName']?></a>
                        <div class="subNav hidden" id="accountNav">
                            <table><tr><td><a href="../Account">Account</a></td></tr>
                                <tr><td><a href="../php/logout.php">Logout</a></tr></td></table>
                        </div>
                    </div>
			    <? else:?>
                    <div class="loginUser">
			            <a href="../Login">Login</a>
                    </div>
			    <?endif?>
		    </span>
	    </div>
    </div>
    <div class="content">
        <div class="playerFilter">
            <form name="playerSearch" method="post" action="filter.php">
                <table>
                    <tr>
                        <td><p>Name</p></td>
                        <td><input name="playerName" type="text" value="<?echo $_SESSION['playerFilterName']?>"></td>
                        <td class="nameError"></td>
                    </tr>
                    <tr>
                        <td><p>Position</p></td>
                        <td><input name="playerPos" type="text" value="<?echo $_SESSION['playerFilterPos']?>"></td>
                        <td class="posError"></td>
                    </tr>
                    <tr>
                        <td><p>Conference</p></td>
                        <td><input name="playerConf" type="text" value="<?echo $_SESSION['playerFilterConf']?>"></td>
                        <td class="confError"></td>
                    </tr>
                    <tr>
                        <td><p>Division</p></td>
                        <td><input name="playerDiv" type="text" value="<?echo $_SESSION['playerFilterDiv']?>"></td>
                        <td class="divError"></td>
                    </tr>
                    <tr>
                        <td><p>Team</p></td>
                        <td><input name="playerTeam" type="text" value="<?echo $_SESSION['playerFilterTeam']?>"></td>
                        <td class="teamError"></td>
                    </tr>
                    <tr>
                        <td><p>In Playoffs</p></td>
                        <td><input name="playerInPlayoffs" type="checkbox" value="<?echo $_SESSION['playerFilterInPlayoffs']?>"></td>
                        <td</td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="playerList">
            <?
            $playerListHtml = file_get_html("http://www.tsn.ca/nhl/teams/players/?letter=A");
            echo $playerListHtml;
            $playerTable = $playerListHtml->find('table',0);
            echo $playerTable;
            ?>
        </div>
    </div>
    <div class="footer">
         <p class="version"><? echo $appVersion?>
         <p class="copyright"><? echo $copyright?>
    </div>

</body>
</html>