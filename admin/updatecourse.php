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
            $coursename = mysqli_escape_string($con, $coursename);
            $courseid = mysqli_escape_string($con, $courseid);
            //$query = "update courses ";
            //$query .= " set coursename='{$coursename}',coursefee={$coursefee} ";
            //$query .= " where courseid='{$courseid}'";
            $table_name = "courseinfo";
            $column_values = array();
            $column_values["coursename"] = $coursename;
            $column_values["coursefee"] = $coursefee;
            $where_values = array();
            $where_values["courseid"] = $courseid;
            $query = generateUpdateQuery($table_name, $column_values, $where_values);
            $result = mysqli_query($con,$query);
            if($result){
                $message = "Course Information is Updated in System";
                $iserror = false;
            }else{
                $message = "Updation Failure Due To : " . mysqli_error($con);
                
            }
            require("../api/CloseConnection.php");
            //$message .= " ( {$query} )";
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
header("location:viewcourse.php");
?>
