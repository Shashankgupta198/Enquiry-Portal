<?php
session_start();
$message = "";
$iserror = true;
if(isset($_POST["streamid"]) && isset($_POST["streamname"])){
    $streamid = trim($_POST["streamid"]);
    $streamname = trim($_POST["streamname"]);
    $_SESSION["streamid"] = $streamid;
    $_SESSION["streamname"] = $streamname;
    if(empty($streamid) || empty($streamname)){
        $message = "Please Fill All Boxes";
    }else{
            require("../api/OpenConnection.php");
            require("../api/utility.php");
            $streamname = mysqli_escape_string($con, $streamname);
            $streamid = mysqli_escape_string($con, $streamid);
            //$query = "update courses ";
            //$query .= " set coursename='{$coursename}',coursefee={$coursefee} ";
            //$query .= " where courseid='{$courseid}'";
            $table_name = "streaminfo";
            $column_values = array();
            $column_values["streamname"] = $streamname;
            $where_values = array();
            $where_values["streamid"] = $streamid;
            $query = generateUpdateQuery($table_name, $column_values, $where_values);
            $result = mysqli_query($con,$query);
            if($result){
                $message = "Stream Information is Updated in System";
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
header("location:viewstream.php");
?>
