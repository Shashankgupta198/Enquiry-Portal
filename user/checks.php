<?php
if(!isset($_SESSION["uname"])){
    header("location:../login.php");
    die();
}