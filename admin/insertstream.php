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
            $table_name = "streaminfo";
            $column_values = array();
            //$column_values["courseid"] = addslashes($courseid);
            //$column_values["coursename"] = addslashes($coursename);
            $column_values["streamid"] = mysqli_escape_string($con, $streamid);
            $column_values["streamname"] = mysqli_escape_string($con, $streamname);
            $query = generateInsertQuery($table_name, $column_values);
            //$message = $query;
            $result = mysqli_query($con,$query);
            if($result){
                $message = "Stream Information is Saved in System";
                $iserror = false;
            }else{
                $message = "Insertion Failure Due To : " . mysqli_error($con);
                if(strpos($message,"PRIMARY")){
                    $message = "Stream ID is Already Taken By Some Other Stream";
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
header("location:addstream.php");
?>
