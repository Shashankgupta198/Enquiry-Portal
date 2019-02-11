<?php

session_start();
$message = "";
$iserror = true;
if (isset($_GET["collegeid"])) {
    $collegeid = trim($_GET["collegeid"]);
    if (empty($collegeid)) {
        $message = "Please Fill All Boxes";
    } else {
        require("../api/OpenConnection.php");
        require("../api/utility.php");
        //$query = "delete from courses where courseid='{$courseid}'";
        $table_name = "instituteinfo";
        $column_values = array();
        $column_values["collegeid"] = $collegeid;
        $query = generateDeleteQuery($table_name, $column_values);
        $result = mysqli_query($con, $query);
        if ($result && mysqli_affected_rows($con)>0) {
            $message = "College Information is Removed from System";
            $iserror = false;
        } else {
            $message = "Deletion Failure Due To : " . mysqli_error($con);
        }        
        require("../api/CloseConnection.php");
    }
} else {
    $message = "Insufficient Data Provided";
}
if ($iserror) {
    $_SESSION["error"] = "yes";
}
$_SESSION["message"] = $message;
header("location:viewinstitute.php");
?>
