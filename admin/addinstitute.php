<?php include_once("header.php"); ?>
<br>
<h1> Add New College Details :- </h1>
<br> 
<?php
$collegeid = isset($_SESSION["collegeid"]) ? $_SESSION["collegeid"] : "";
$collegename = isset($_SESSION["collegename"]) ? $_SESSION["collegename"] : "";

?>
<form method="post" action="insertinstitute.php">
    <div class="row form-group">
        <div class="col-md-2">
            <label for="collegeid"> Enter College ID : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="collegeid" id="collegeid" value="<?php echo $collegeid;?>">
        </div>        
    </div>
    <div class="row form-group">
        <div class="col-md-2">
            <label for="collegename"> Enter College Name : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="collegename" id="collegename" value="<?php echo $collegename;?>">
        </div>        
    </div>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary btn-block" type="submit">Add College Details</button>
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
unset($_SESSION["collegeid"]);
unset($_SESSION["collegename"]);
?>
<?php include_once("footer.php"); ?>