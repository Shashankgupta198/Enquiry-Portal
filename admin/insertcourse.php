<?php
session_start();
$message = "";
$iserror = true;
if(isset($_POST["courseid"]) && isset($_POST["coursename"]) 
        && isset($_POST["coursefee"])){
    $courseid = trim($_POST["courseid"]);
    $coursename = trim($_POST["coursename"]);
    $coursefee = trim($_POST["coursefee"]);
    $_SESSION["courseid"] = $courseid;
    $_SESSION["coursename"] = $coursename;
    $_SESSION["coursefee"] = $coursefee;
    if(empty($courseid) || empty($coursename) || ( !is_numeric($coursefee) && empty($coursefee))){
        $message = "Please Fill All Boxes";
    }else if(is_numeric ($coursefee)){
        if($coursefee>0){
            require("../api/OpenConnection.php");
            require("../api/utility.php");
            $table_name = "courseinfo";
            $column_values = array();
            $column_values["courseid"] = mysqli_escape_string($con, $courseid);
            $column_values["coursename"] = mysqli_escape_string($con, $coursename);
            $column_values["coursefee"] = (int)$coursefee;
            $query = generateInsertQuery($table_name, $column_values);
            //$message = $query;
            $result = mysqli_query($con,$query);
            if($result){
                $message = "Course Information is Saved in System";
                $iserror = false;
            }else{
                $message = "Insertion Failure Due To : " . mysqli_error($con);
                if(strpos($message,"PRIMARY")){
                    $message = "Course ID is Already Taken By Some Other Course";
                }
            }
            require("../api/CloseConnection.php");
        }else{
            $message = "Course Fee must be a positive number";
        }
    }else{
        $message = "Course Fee must be a number";
    }
}else{
    $message = "Insufficient Data Provided";
}    
if($iserror){
    $_SESSION["error"] = "yes";
}
$_SESSION["message"] = $message;
header("location:addcourse.php");
?>
