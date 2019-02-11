<?php include_once("header.php"); ?>
<br>
<h1> Add New Stream Details :- </h1>
<br>
<?php
$streamid = isset($_SESSION["streamid"]) ? $_SESSION["streamid"] : "";
$streamname = isset($_SESSION["streamname"]) ? $_SESSION["streamname"] : "";

?>
<form method="post" action="insertstream.php" 
    <div class="row form-group">
        <div class="col-md-2">
            <label for="streamid"> Enter Stream ID  : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="streamid" id="streamid" value="<?php echo $streamid; ?>">
        </div>        
    </div>
    <div class="row form-group">
        <div class="col-md-2">
            <label for="streamname"> Enter Stream Name : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="streamname" id="streamname" value="<?php echo $streamname; ?>">
        </div>        
    </div>
    <div class="row">
        <div class="col-md-10">
            <button class="btn btn-primary btn-block" name="action" type="submit">Add Stream Details</button>
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
unset($_SESSION["streamid"]);
unset($_SESSION["streamname"]);
?>
<?php include_once("footer.php"); ?>