<?php
session_start();
$username = "";
$password = "";

$isError = false;
$error = "";
$errorDetails = "";

$dBHost = "localhost";
$dBUsername = "corywelc_user";
$dBPassword = "corywelch";
$dBName = "corywelc_generalUse";

$_SESSION['accountError'] = false;
$_SESSION['accountErrorMessage'] = '';
$_SESSION['accountErrorDetails'] = '';
$_SESSION['passwordError'] = false;
$_SESSION['passwordErrorMessage'] = '';
$_SESSION['passwordErrorDetails'] = '';
$_SESSION['loginError'] = false;
$_SESSION['error'] = '';
$_SESSION['errorDetails'] = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     
     $username = $_POST['username'];
     $password = $_POST['password'];

     $username = htmlspecialchars($username);
     $password = htmlspecialchars($password);

     $_SESSION['loginUsername'] = $username;

     $dBConnect = mysqli_connect($dBHost, $dBUsername, $dBPassword, $dBName);


     if (mysqli_connect_errno()){
         $isError = true;
         $error = "Database Connection Error";
         $errorDetails = mysqli_connect_errno();
         $_SESSION['isLoggedin'] = false;
         mysqli_close($dBConnect); 
     }
     else { 
         $SQL = "SELECT * FROM PlayoffPoolUser WHERE Username='$username' AND Password='$password'";
         $SQL2 = "SELECT * FROM PlayoffPoolUser WHERE Email='$username' AND Password='$password'";
         $result = mysqli_query($dBConnect, $SQL);
         $result2 = mysqli_query($dBConnect, $SQL2);
         if ($result || $result2){
              $numUsers = mysqli_num_rows($result);
              $numUsers2 = mysqli_num_rows($result2);
              if ($numUsers == 1 || $numUsers2 == 1) {
                   $_SESSION['isLoggedin'] = true;
                   if ($numUsers == 1){
                        $row = mysqli_fetch_array($result);
                   }
                   else {
                        $row = mysqli_fetch_array($result2);
                   }
                   $_SESSION['username'] = $row['Username'];
                   $_SESSION['firstName'] = $row['FirstName'];
                   $_SESSION['lastName'] = $row['LastName'];
                   $_SESSION['fullName'] = $row['FirstName']." ".$row['LastName'];
                   $_SESSION['userEmail'] = $row['Email'];
                   $_SESSION['userID'] = $row['ID'];
                   $_SESSION['userRole'] = $row['userROLE'];
                   mysqli_close($dBConnect);
              }
              else {
                   $isError = true;
                   $error = "Login Error";
                   $errorDetails = "Username and Password Combination doesn't exist.";
                   $_SESSION['isLoggedin'] = false;
                   mysqli_close($dBConnect);
             }
         }
         else {
             $isError = true;
             $error = "Database Connection Error";
             $errorDetails = mysqli_error($dBConnect);
             $_SESSION['isLoggedin'] = false;
             mysqli_close($dBConnect);              
         }
     }  
}
else {
     $isError = true;     
     $error = "Login Error";
     $errorDetails = "Could not get entered results. Try Again";
     $_SESSION['isLoggedin'] = false; 
}
if ($_SESSION['isLoggedin'] == true) {
     $_SESSION['loginError'] = false;
     header ("Location: ../../PlayoffPool");
}
else if ($isError == true){
     $_SESSION['loginError'] = true;
     $_SESSION['error'] = $error;
     $_SESSION['errorDetails'] = $errorDetails;
     header ("Location: ../Login");
     }
else {
     $_SESSION['loginError'] = true;
     $_SESSION['error'] = "Unknown Error Occurred. Try Again";
    header ("Location: ../Login");
}
?>