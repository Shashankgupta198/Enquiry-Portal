<?php
include_once("header.php");
require_once("../api/OpenConnection.php");
?>
<br>
<h1> Add New Enquiry Details :- </h1>
<br>
<?php
$studentname = isset($_SESSION["studentname"]) ? $_SESSION["studentname"] : "";
$fathername = isset($_SESSION["fathername"]) ? $_SESSION["fathername"] : "";
$contactno = isset($_SESSION["contactno"]) ? $_SESSION["contactno"] : "";
$enquirydate = isset($_SESSION["enquirydate"]) ? $_SESSION["enquirydate"] : "";
$description = isset($_SESSION["description"]) ? $_SESSION["description"] : "";
$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
$collegeid = isset($_SESSION["collegeid"]) ? $_SESSION["collegeid"] : "";
$courseid = isset($_SESSION["courseid"]) ? $_SESSION["courseid"] : "";
$streamid = isset($_SESSION["streamid"]) ? $_SESSION["streamid"] : "";
$isadmission = isset($_SESSION["isadmission"]) ? $_SESSION["isadmission"] : "";
?>
<form method="post" action="insertenquiry.php">
    <div class="row form-group">
        <div class="col-md-2">
            <label for="studentname"> Enter Student Name : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="studentname" id="studentname" value="<?php echo $studentname; ?>">
        </div>        
    </div>
    <div class="row form-group">
        <div class="col-md-2">
            <label for="fathername"> Enter Father Name : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="fathername" id="fathername" value="<?php echo $fathername; ?>">
        </div>        
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            <label for="contactno"> Enter Contact No. : </label>
        </div>
        <div class="col-md-10">
            <input type="number" class="form-control" name="contactno" id="contactno" value="<?php echo $contactno; ?>">
        </div>        
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            <label for="enquirydate"> Enter Enquiry Date : </label>
        </div>
        <div class="col-md-10">
            <input type="date" class="form-control" name="enquirydate" id="enquirydate" value="<?php echo $enquirydate; ?>">
        </div>        
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            <label for="description"> Enter Description : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="description" id="description" value="<?php echo $description; ?>">
        </div>        
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            <label for="username"> Enter Username : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="username" id="username" value="<?php echo $username; ?>">
        </div>        
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            <label for="collegeid"> Enter College ID : </label>
        </div>
        <div class="col-md-10">
            <select class="form-control" name="collegeid" id="collegeid">
                <option value="">Choose Any College</option>
                <?php
                require_once("../api/OpenConnection.php");
                $query = "select collegeid,collegename from instituteinfo";
                $result = mysqli_query($con, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_row($result)) {
                        list($collegeid, $collegename) = $row;
                        echo '<option value="' . $collegeid . '">';
                        echo $name . " [ " . $collegename . " ]";
                        echo '</option>';
                    }
                    mysqli_free_result($result);
                }
                ?>
            </select>
        </div>         
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            <label for="courseid"> Enter Course ID : </label>
        </div>
        <div class="col-md-10">
            <select class="form-control" name="courseid" id="courseid">
                <option value="">Choose Any Course</option>
                <?php
                require_once("../api/OpenConnection.php");
                $query = "select courseid,coursename from courseinfo";
                $result = mysqli_query($con, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_row($result)) {
                        list($courseid, $coursename) = $row;
                        echo '<option value="' . $courseid . '">';
                        echo $name . " [ " . $coursename . " ]";
                        echo '</option>';
                    }
                    mysqli_free_result($result);
                }
                ?>
            </select>
        </div>         
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            <label for="streamid"> Enter Stream ID : </label>
        </div>
        <div class="col-md-10">
            <select class="form-control" name="streamid" id="streamid">
                <option value="">Choose Any Stream</option>
                <?php
                require_once("../api/OpenConnection.php");
                $query = "select streamid,streamname from streaminfo";
                $result = mysqli_query($con, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_row($result)) {
                        list($streamid, $streamname) = $row;
                        echo '<option value="' . $streamid . '">';
                        echo $name . " [ " . $streamname . " ]";
                        echo '</option>';
                    }
                    mysqli_free_result($result);
                }
                ?>
            </select>
        </div>         
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            <label for="isadmission"> IS Admitted : </label>
        </div>
        <div class="col-md-10">
            <input type="radio" name="admitted" value="Yes" id="r1">
            <label for="r1" value="Yes"> 
        </div> 
        <div class="col-md-10">
            <input type="radio" name="notadmitted" value="No" id="r2">
            <label for="r2" value="No"> 
        </div> 
    </div> 
</div> 


<div class="row">
    <div class="col-md-10">
        <button class="btn btn-primary btn-block" type="submit">Add Enquiry Details</button>
    </div>
</div>
</form>
<br>
<?php
if (isset($_SESSION["message"])) {
    $alert_class_name = "alert-success";
    if (isset($_SESSION["error"])) {
        unset($_SESSION["error"]);
        $alert_class_name = "alert-danger";
    }
    ?>
    <div class="alert <?php echo $alert_class_name; ?>">
        <?php
        echo $_SESSION["message"];
        ?>
    </div>
    <?php
    unset($_SESSION["message"]);
}
unset($_SESSION["studentname"]);
unset($_SESSION["fathername"]);
unset($_SESSION["contactno"]);
unset($_SESSION["enquirydate"]);
unset($_SESSION["description"]);
unset($_SESSION["collegeid"]);
unset($_SESSION["courseid"]);
unset($_SESSION["streamid"]);
unset($_SESSION["isadmission"]);

?>
<?php include_once("footer.php"); ?>