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
            $coursename = mysqli_escape_string($con, $coursename);
            $courseid = mysqli_escape_string($con, $courseid);
            //$query = "update courses ";
            //$query .= " set coursename='{$coursename}',coursefee={$coursefee} ";
            //$query .= " where courseid='{$courseid}'";
            $table_name = "instituteinfo";
            $column_values = array();
            $column_values["collegename"] = $collegename;
            $where_values = array();
            $where_values["collegeid"] = $collegeid;
            $query = generateUpdateQuery($table_name, $column_values, $where_values);
            $result = mysqli_query($con,$query);
            if($result){
                $message = "College Information is Updated in System";
                $iserror = false;
            }else{
                $message = "Updation Failure Due To : " . mysqli_error($con);
                
            }
            require("../api/CloseConnection.php");
            //$message .= " ( {$query} )";
    }
}else{
    $message = "Insufficient Data Provided";
}    
if($iserror){
    $_SESSION["error"] = "yes";
}
$_SESSION["message"] = $message;
header("location:viewinstitute.php");
?>
