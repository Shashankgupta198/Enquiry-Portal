<?php
session_start();
$message = "";
$iserror = true;
if(isset($_POST["collegeid"]) && isset($_POST["collegename"])){
    $collegeid = trim($_POST["collegeid"]);
    $collegename = trim($_POST["collegename"]);
    $_SESSION["collegeid"] = $collegeid;
    $_SESSION["collegename"] = $collegename;
    if(empty($collegeid) || empty($collegename)){
        $message = "Please Fill All Boxes";
    }else{
            require("../api/OpenConnection.php");
            require("../api/utility.php");
            $table_name = "instituteinfo";
            $column_values = array();
            //$column_values["courseid"] = addslashes($courseid);
            //$column_values["coursename"] = addslashes($coursename);
            $column_values["collegeid"] = mysqli_escape_string($con, $collegeid);
            $column_values["collegename"] = mysqli_escape_string($con, $collegename);
            $query = generateInsertQuery($table_name, $column_values);
            //$message = $query;
            $result = mysqli_query($con,$query);
            if($result){
                $message = "College Information is Saved in System";
                $iserror = false;
            }else{
                $message = "Insertion Failure Due To : " . mysqli_error($con);
                if(strpos($message,"PRIMARY")){
                    $message = "College ID is Already Taken By Some Other College";
                }
            }
            require("../api/CloseConnection.php");
    }
}else{
    $message = "Insufficient Data Provided";
}    
if($iserror){
    $_SESSION["error"] = "yes";
}
$_SESSION["message"] = $message;
header("location:addinstitute.php");
?>
