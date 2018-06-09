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
        <div class="poolList">
            <p>List Of All Pools Here. Not Yet Needed. Future Task</p>
        </div>
        <div class="currentPool">
            <div class="poolStandings">
                <table>
                    <tr>
                        <th colspan="7">Standings</th>
                    </tr>
                    <tr>
                        <th id="posHead">Pos</th>
                        <th id="creatorHead">Creator</th>
                        <th id="pointsHead">Points</th>
                        <th id="remainHead">Players Remaining</th>
                        <th id="goalsHead" style="display:none">Goals</th>
                        <th id="assistsHead" style="display:none">Assists</th>
                        <th id="teamsReHead" style="display:none">Teams Remaining</th>
                    </tr>
                </table>
            </div>
            <div class="poolTeam"></div>
        </div>
    </div>
    <div class="footer">
         <p class="version"><? echo $appVersion?>
         <p class="copyright"><? echo $copyright?>
    </div>

</body>
</html>