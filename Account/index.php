<?php //Account
session_start();
include '../php/variables.php';
require '../php/simple_html_dom.php';
$page = "Account";
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
                                             <table><tr><td><a href="" style="text-decoration:line-through;">Account</a></td></tr>
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
         <p><? echo $_SESSION['fullName']?>'s Account Information</p>
         <? if($_SESSION['accountError'] == true):?>
              <p class="accountError"><? echo $_SESSION['accountErrorMessage'].'<br/>'.$_SESSION['accountErrorDetails'] ?></p>
         <?endif?>
         <form name="accountform" action="../php/accountUpdate.php" method="post">
         <table class="accountTable">
              <tr>
                   <td>Username: </td>
                   <td><input type="text" class="accountUsername" name="accountUsername" value="<? echo $_SESSION['username']; ?>"></td>
              </tr>
              <tr>
                   <td>First Name: </td>
                   <td><input type="text" class="accountFirstName" name="accountFirstName" value="<? echo $_SESSION['firstName']; ?>"></td>
              </tr>
              <tr>
                   <td>Last Name: </td>
                   <td><input type="text" class="accountLastName" name="accountLastName" value="<? echo $_SESSION['lastName']; ?>"></td>
              </tr>
              <tr>
                   <td>ID: </td>
                   <td><input type="text" class="accountID" name="accountID" value="<? echo $_SESSION['userID']; ?>" disabled></td>
              </tr>
              <tr>
                   <td>Email: </td>
                   <td><input type="text" class="accountEmail" name="accountEmail" value="<? echo $_SESSION['userEmail']; ?>"></td>
              </tr>
              <tr>
                   <th colspan=2><input type="submit" value="Update Account"/></th>
              </tr>
         </table>
      </form>
         <p>Change Password</p>
         <? if($_SESSION['passwordError'] == true):?>
              <p class="accountPasswordError"><? echo $_SESSION['passwordErrorMessage']. '<br/>' .$_SESSION['passwordErrorDetails'] ?></p>
         <?endif?>
         <form name="changePasswordForm" action="../php/passwordChange.php" method="post">
         <table class="accountTable">
              <tr>
                   <td>Current Password: </td>
                   <td><input type="password" class="oldPassword" name="oldPassword"></td>
              </tr>
              <tr>
                   <td>New Password: </td>
                   <td><input type="password" class="newPassword1" name="newPassword1"></td>
              </tr>
              <tr>
                   <td>Confirm: </td>
                   <td><input type="password" class="newPassword2" name="newPassword2"></td>
              </tr>
              <tr>
                   <th colspan=2><input type="submit" value="Change Password"/></th>
              </tr>
         </table>
         </form>
    </div>
    <div class="footer">
         <p class="version"><? echo $appVersion?>
         <p class="copyright"><? echo $copyright?>
    </div>

</body>
</html>