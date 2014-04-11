<?php //Login
session_start();
include '../php/variables.php';
require '../php/simple_html_dom.php';
$page = "Login";
?>
<html>
<head>
    <title>NHL Playoff Pool - <? echo $page?></title>
    <link type="text/css" rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div class="header">
	    <div class="title">
		    <h1>NHL Playoff Pool - <? echo $page?></h1>
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
			    <a href="../Account">Login</a>
		    </span>
	    </div>
    </div>
    <div class="content">
         <div class="loginForm">
              <form name="loginform" action="../php/loginAuth.php" method="post">
              <table class="loginTable">
                   <tr>
                        <th colspan=2><p>Please Login</p></th>
                   </tr>
                   <? if($_SESSION['loginError'] == true):?>
                        <tr>
                             <td colspan=2><p class="loginError"><? echo $_SESSION['errorDetails'] ?></p></td>
                        </tr>
                   <?endif?>
                   <tr>
                        <td><p>Username: </p></td>
                        <td><input type="text" class="username" name="username" value="<? echo $_SESSION['loginUsername']?>"/></td>
                   </tr>
                   <tr>
                        <td><p>Password: </p></td>
                        <td><input type="password" class="password" name="password"/></td>
                   </tr>
                   <tr>
                        <th colspan=2><input type="submit" value="Login"/></th>
                   </tr>
              </table>
              </form>  
         </div>
    </div>
    <div class="footer">
         <p class="version"><? echo $appVersion?>
         <p class="copyright"><? echo $copyright?>
    </div>
</body>
</html>