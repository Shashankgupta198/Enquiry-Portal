<?php include_once("header.php"); ?>
<br>
<h1> Search Details : </h1>
<br>
<?php
$year = isset($_SESSION["year"]) ? $_SESSION["year"] : "";
$collegeid = isset($_SESSION["collegeid"]) ? $_SESSION["collegeid"] : "";
$streamid = isset($_SESSION["streamid"]) ? $_SESSION["streamid"] : "";
?>
<form method="post" action="insertcourse.php">
    <div class="row form-group">
        <div class="col-md-2" style="inline">
            <label for="year"> Enter Year : </label>
        </div>
        <div class="col-md-2">
            <input type="date" class="form-control" name="year" id="year" value="<?php echo $year;?>">
        </div>        
    </div>
    <div class="row form-group">
        <div class="col-md-2" style="inline">
            <label for="collegeid"> Enter College Name : </label>
        </div>
        <div class="col-md-2">
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
        <div class="col-md-2" style="inline">
            <label for="streamid"> Enter Stream : </label>
        </div>
        <div class="col-md-2">
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
    <div class="row">
        <div class="col-md-2">
            <button class="btn btn-primary btn-block" type="submit">Show Student Details</button>
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
unset($_SESSION["year"]);
unset($_SESSION["collegeid"]);
unset($_SESSION["streamid"]);
?>
<?php include_once("footer.php"); ?>