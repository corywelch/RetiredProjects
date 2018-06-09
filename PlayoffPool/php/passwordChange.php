<?php
session_start();

$oldPassword = '';
$userID = '';
$newPassword1 = '';
$newPassword2 = '';

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
     $userID = $_SESSION['userID'];
     $oldPassword = $_POST['oldPassword'];
     $newPassword1 = $_POST['newPassword1'];
     $newPassword2 = $_POST['newPassword2'];
     
     if($newPassword1 == $newPassword2){
         if($newPassword1 == null || $newPassword1 == ''){
             $isError = true;
             $error = "Invalid Entry";
             $errorDetails = "New Passwords Cannot be blank";
         }
         else{
             $SQL = "SELECT * FROM PlayoffPoolUser WHERE ID='$userID' AND Password='$oldPassword'";
             $dBConnect = mysqli_connect($dBHost, $dBUsername, $dBPassword, $dBName);
             if (mysqli_connect_errno()){
                 $isError = true;
                 $error = "Database Connection Error";
                 $errorDetails = mysqli_connect_errno();
                 mysqli_close($dBConnect);
             }
             else{
                 $result = mysqli_query($dBConnect, $SQL);
                 if($result){
                     $numRows = mysqli_num_rows($result);
                     if($numRows == 1){
                         $SQLupdate = "UPDATE PlayoffPoolUser SET Password='$newPassword1' WHERE ID='$userID'";
                         $passwordUpdate = mysqli_query($dBConnect, $SQLupdate);
                         mysqli_close($dBConnect);
                         header ("Location:../../PlayoffPool");
                     }
                     else{
                         $isError = true;
                         $error = 'Invalid Entry';
                         $errorDetails = 'Current Password was Entered Wrong';
                         mysqli_close($dBConnect);
                     }
                 }
                 else{
                     $isError = true;
                     $error = 'Connection Error';
                     $errorDetails = mysqli_error($dBConnect);
                     mysqli_close($dBConnect);
                 }
             }
         }
     }
     else{
          $isError = true;
          $error = "Invalid Entry";
          $errorDetails = "New Passwords Don't Match";
     }
}
else {
     $isError = true;     
     $error = "Saving Error";
     $errorDetails = "Could not get entered values. Try Again";
}
if ($isError == true){
     $_SESSION['passwordError'] = true;
     $_SESSION['passwordErrorMessage'] = $error;
     $_SESSION['passwordErrorDetails'] = $errorDetails;
     header ("Location: ../Account");
}
else {
     $_SESSION['accountError'] = true;
     $_SESSION['error'] = "Unknown Error Occurred. Try Again";    
}

?>