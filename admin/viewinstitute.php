<?php
include_once("header.php");
require_once("../api/OpenConnection.php");
?>
<br>
<h1> Institute Information : </h1>
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
?>
<table class="table table-hover table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>College ID</th>
            <th>College Name</th>
            <th colspan="2">Operations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "select collegeid ,collegename";
        $query .= " from instituteinfo";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row["collegeid"] . '</td>';
                echo '<td>' . $row["collegename"] . '</td>';
                echo '<td>';
                echo '<a class="btn btn-primary" href="deleteinstitute.php?collegeid=';
                echo urlencode($row["collegeid"]) . '" onclick="return confirm(\'Are You To Remove This Record\')">Delete This College</a>';
                echo '</td>';
                echo '<td>';
                $functions = "setData('" . addslashes($row["collegeid"]) . "','" . addslashes($row["collegename"]) . "')";
                echo '<button onclick="' . $functions . '" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Edit This Record</button>';
                echo '</td>';
                echo '</tr>';
            }
            mysqli_free_result($result);
        } else {
            echo '<tr><td colspan="5" align="center">';
            echo 'There is no College Details Saved in System';
            echo '</td></tr>';
        }
        ?>
    </tbody>
</table>
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update College Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" action="updateinstitute.php">
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="collegeid"> Enter College ID : </label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="collegeid" id="collegeid">
                        </div>        
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="collegename"> Enter College Name : </label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="collegename" id="collegename">
                        </div>        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-block" type="submit">Add College Details</button>
                        </div>
                    </div>               
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<?php include_once("footer.php"); ?>
<script>
    function setData(coid, coname) {
        $("#collegeid").val(coid);
        $("#collegename").val(coname);
    }
</script>
<?php
require_once("../api/CloseConnection.php");
