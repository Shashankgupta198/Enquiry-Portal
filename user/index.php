<?php
session_start();
if (!isset($_SESSION["uname"])) {
    header("location:../login.php");
    die();
}
?>
<?php include_once("header.php"); ?>
<h1> Welcome To User Section </h1>
<h1><a href="changepassword.php">Change Password</a></h1>
<?php
if(isset($_SESSION["lastlogin"])){
    echo "<h1>User Last Visit : " . $_SESSION["lastlogin"];
}else{
    echo "<h1>Welcome First Time User!!!</h1>";
}
?>
<?php include_once("footer.php"); ?>