<?php include_once("header.php"); ?>
<br>
<h1> Add New Course Details :- </h1>
<br>
<?php
$courseid = isset($_SESSION["courseid"]) ? $_SESSION["courseid"] : "";
$coursename = isset($_SESSION["coursename"]) ? $_SESSION["coursename"] : "";
$coursefee = isset($_SESSION["coursefee"]) ? $_SESSION["coursefee"] : "";
?>
<form method="post" action="insertcourse.php">
    <div class="row form-group">
        <div class="col-md-2">
            <label for="courseid"> Enter Course ID : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="courseid" id="courseid" value="<?php echo $courseid;?>">
        </div>        
    </div>
    <div class="row form-group">
        <div class="col-md-2">
            <label for="coursename"> Enter Course Name : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="coursename" id="coursename" value="<?php echo $coursename;?>">
        </div>        
    </div>
    <div class="row form-group">
        <div class="col-md-2">
            <label for="coursefee"> Enter Course Fee : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="coursefee" id="coursefee"  value="<?php echo $coursefee;?>">
        </div>        
    </div>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary btn-block" type="submit">Add Course Details</button>
        </div>
    </div>
</form>
<br>
<?php
if (isset($_SESSION["message"])) {
    $alert_class_name = "alert-success";
    if(isset($_SESSION["error"])){
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
unset($_SESSION["courseid"]);
unset($_SESSION["coursename"]);
unset($_SESSION["coursefee"]);
?>
<?php include_once("footer.php"); ?>