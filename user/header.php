<?php session_start();
require_once("checks.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand" href="index.php">Grapess Enquiry</a>

                <!-- Links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Homepage</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Enquiry Operations
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="addenquiry.php">Add Enquiry</a>
                            <a class="dropdown-item" href="viewenquiry.php">View Enquiry</a>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="according.php">According</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="signout.php">Sign Out</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container">