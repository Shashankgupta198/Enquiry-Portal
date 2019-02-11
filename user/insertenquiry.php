<?php
session_start();
$message = "";
$iserror = true;
if(isset($_POST["studentname"]) && isset($_POST["fathername"]) && isset($_POST["contactno"]) 
        && isset($_POST["enquirydate"]) && isset($_POST["description"]) && isset($_POST["username"])
                && isset($_POST["collegeid"]) && isset($_POST["courseid"]) && isset($_POST["streamid"]) && isset($_POST["isadmission"])){
    $studentname = trim($_POST["studentname"]);
    $fathername = trim($_POST["fathername"]);
    $contactno = trim($_POST["contactno"]);
    $enquirydate = trim($_POST["enquirydate"]);
    $description = trim($_POST["description"]);
    $username = trim($_POST["username"]);
    $collegeid = trim($_POST["collegeid"]);
    $courseid = trim($_POST["courseid"]);
    $streamid = trim($_POST["streamid"]);
    $isadmission = trim($_POST["isadmission"]);
    $_SESSION["studentname"] = $studentname;
    $_SESSION["fathername"] = $fathername;
    $_SESSION["contactno"] = $contactno;
    $_SESSION["enquirydate"] = $enquirydate;
    $_SESSION["description"] = $description;
    $_SESSION["username"] = $username;
    $_SESSION["collegeid"] = $collegeid;
    $_SESSION["courseid"] = $courseid;
    $_SESSION["streamid"] = $streamid;
    $_SESSION["isadmission"] = $isadmission;
    
    if(empty($studentname) || ( !is_numeric($contactno) && empty($contactno)) || empty($enquirydate) || empty($description)
             || empty($username) || empty($isadmission)){
        $message = "Please Fill All Boxes";
    }else if(is_numeric ($contactno)){
        if($contactno>0){
            require("../api/OpenConnection.php");
            require("../api/utility.php");
            $table_name = "enquiryinfo";
            $column_values = array();
            //$column_values["courseid"] = addslashes($courseid);
            //$column_values["coursename"] = addslashes($coursename);
            $column_values["studentname"] = mysqli_escape_string($con, $studentname);
            $column_values["fathername"] = mysqli_escape_string($con, $fathername);
            $column_values["contactno"] = (int)$contactno;
            $column_values["enquirydate"] = mysqli_escape_string($con, $enquirydate);
            $column_values["description"] = mysqli_escape_string($con, $description);
            $column_values["username"] = mysqli_escape_string($con, $username);
            $column_values["collegeid"] = mysqli_escape_string($con, $collegeid);
            $column_values["courseid"] = mysqli_escape_string($con, $courseid);
            $column_values["streamid"] = mysqli_escape_string($con, $streamid);
            $column_values["isadmission"] = mysqli_escape_string($con, $isadmission);
            $query = generateInsertQuery($table_name, $column_values);
            //$message = $query;
            $result = mysqli_query($con,$query);
            if($result){
                $message = "Enquiry Information is Saved in System";
                $iserror = false;
            }else{
                $message = "Insertion Failure Due To : " . mysqli_error($con);
                if(strpos($message,"PRIMARY")){
                    $message = "Enquiry ID is Already Taken By Some Other Enquiry";
                }
            }
            require("../api/CloseConnection.php");
        }
    }else{
        $message = "Contact No. must be a number";
    }
}else{
    $message = "Insufficient Data Provided";
}    
if($iserror){
    $_SESSION["error"] = "yes";
}
$_SESSION["message"] = $message;
header("location:addenquiry.php");
?>
