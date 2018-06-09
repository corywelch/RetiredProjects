<?php
session_start();

$username = '';
$firstName = '';
$lastName = '';
$userID = '';
$email = '';

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
     
     $username = $_POST['accountUsername'];
     $firstName = $_POST['accountFirstName'];
     $lastName = $_POST['accountLastName'];
     $userID = $_SESSION['userID'];
     $email = $_POST['accountEmail'];

     $dBConnect = mysqli_connect($dBHost, $dBUsername, $dBPassword, $dBName);
     if (mysqli_connect_errno()){
         $isError = true;
         $error = "Database Connection Error";
         $errorDetails = mysqli_connect_errno();
         mysqli_close($dBConnect); 
     }
     else {
         $SQLusername = "SELECT * FROM PlayoffPoolUser WHERE Username='$username'";
         $resultUsername = mysqli_query($dBConnect, $SQLusername);
         if($resultUsername){
              $numUsername = mysqli_num_rows($resultUsername);
              $usernameAccountDetails = mysqli_fetch_array($resultUsername);
              if($numUsername > 0 && $usernameAccountDetails['ID'] != $userID){
                   $isError = true;
                   $error = 'Invalid Entry';
                   $errorDetails = 'Username Already Exists For UserID: '.$usernameAccountDetails['ID'];                 
              }
         }
         else {
              $isError = true;
              $error = 'Connection Error';
              $errorDetails = mysqli_error($dBConnect);
         }
         
         $SQLemail = "SELECT * FROM PlayoffPoolUser WHERE Email='$email'";
         $resultEmail = mysqli_query($dBConnect, $SQLemail);
         if($resultEmail){
              $numEmail = mysqli_num_rows($resultEmail);
              $emailAccountDetails = mysqli_fetch_array($resultEmail);
              if($numEmail > 0 && $emailAccountDetails['ID'] != $userID){
                   if($isError == true){
                   $errorDetails = $errorDetails.'<br/>';
                   }
                   $isError = true;
                   $error = 'Invalid Entry';
                   $errorDetails = $errorDetails.'Email Already Exists For UserID: '.$userID;                
              }
         }
         else {
              $isError = true;
              $error = 'Connection Error';
              $errorDetails = mysqli_error($dBConnect);
         }
         if ($isError == false){
              $SQL = "UPDATE PlayoffPoolUser SET Username='$username', FirstName='$firstName', LastName='$lastName', Email='$email' WHERE ID='$userID'";
              $accountUpdate = mysqli_query($dBConnect, $SQL);
              mysqli_close($dBConnect);
              $_SESSION['username'] = $username;
              $_SESSION['firstName'] = $firstName;
              $_SESSION['lastName'] = $lastName;
              $_SESSION['userEmail'] = $email;
              header ("Location: ../../PlayoffPool");
         }
         mysqli_close($dBConnect);
     } 
}
else {
     $isError = true;     
     $error = "Saving Error";
     $errorDetails = "Could not get entered values. Try Again";
}
if ($isError == true){
     $_SESSION['accountError'] = true;
     $_SESSION['accountErrorMessage'] = $error;
     $_SESSION['accountErrorDetails'] = $errorDetails;
     header ("Location: ../Account");
}
else {
     $_SESSION['accountError'] = true;
     $_SESSION['error'] = "Unknown Error Occurred. Try Again";    
}

?>