<?php include_once("header.php"); ?>
<h1> Welcome To Admin Section </h1>
<h1><a href="changepassword.php">Change Password</a></h1>
<?php
if(isset($_SESSION["lastlogin"])){
    echo "<h1>Admin Last Visit : " . $_SESSION["lastlogin"];
}else{
    echo "<h1>Welcome First Time Admin!!!</h1>";
}

?>
<?php include_once("footer.php"); ?>