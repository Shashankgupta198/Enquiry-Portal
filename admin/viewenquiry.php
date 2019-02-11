<?php
include_once("header.php");
require_once("../api/OpenConnection.php");
?>
<br>
<h1> Enquiry Information : </h1>
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
            <th>Enquiry Id</th>
            <th>Student Name</th>
            <th>Father Name</th>
            <th>Contact No.</th>
            <th>Enquiry Date</th>
            <th>Description</th>
            <th>Username</th>
            <th>College ID</th>
            <th>Course ID</th>
            <th>Stream ID</th>
            <th>IS Admitted</th>
            <th colspan="2">Operations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "select enquiryid, studentname, fathername, contactno, enquirydate, description, "
                . "username, collegeid, courseid, streamid, isadmission ";
        $query .= " from enquiryinfo";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row["enquiryid"] . '</td>';
                echo '<td>' . $row["studentname"] . '</td>';
                echo '<td>' . $row["fathername"] . '</td>';
                echo '<td>' . $row["contactno"] . '</td>';
                echo '<td>' . $row["enquirydate"] . '</td>';
                echo '<td>' . $row["description"] . '</td>';
                echo '<td>' . $row["username"] . '</td>';
                echo '<td>' . $row["collegeid"] . '</td>';
                echo '<td>' . $row["courseid"] . '</td>';
                echo '<td>' . $row["streamid"] . '</td>';
                echo '<td>' . $row["isadmission"] . '</td>';
                echo '<td>';
                echo '<a class="btn btn-primary" href="deleteenquiry.php?enquiryid=';
                echo urlencode($row["enquiryid"]) . '" onclick="return confirm(\'Are You To Remove This Record\')">Delete This Enquiry</a>';
                echo '</td>';
                echo '<td>';
                $functions = "setData('" . addslashes($row["enquiryid"]) . "','" . addslashes($row["studentname"]) . "','" . addslashes($row["fathername"]) . "','" . addslashes($row["contactno"]) . "','" . addslashes($row["enquirydate"]) . "','" . addslashes($row["description"]) . "','" . addslashes($row["username"]) . "','" . addslashes($row["collegeid"]) . "','" . addslashes($row["courseid"]) . "','" . addslashes($row["streamid"]) . "','" . addslashes($row["isadmission"]) . "')";
                echo '<button onclick="' . $functions . '" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Edit This Record</button>';
                echo '</td>';
                echo '</tr>';
            }
            mysqli_free_result($result);
        } else {
            echo '<tr><td colspan="5" align="center">';
            echo 'There is no Enquiry Details Saved in System';
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
                <h4 class="modal-title">Update Enquiry Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" action="updateenquiry.php">
                    <div class="row form-group">
        <div class="col-md-2">
            <label for="studentname"> Enter Student Name : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="studentname" id="studentname">
        </div>        
    </div>
    <div class="row form-group">
        <div class="col-md-2">
            <label for="fathername"> Enter Father Name : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="fathername" id="fathername">
        </div>        
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            <label for="contactno"> Enter Contact No. : </label>
        </div>
        <div class="col-md-10">
            <input type="number" class="form-control" name="contactno" id="contactno">
        </div>        
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            <label for="enquirydate"> Enter Enquiry Date : </label>
        </div>
        <div class="col-md-10">
            <input type="date" class="form-control" name="enquirydate" id="enquirydate">
        </div>        
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            <label for="description"> Enter Description : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="description" id="description">
        </div>        
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            <label for="username"> Enter Username : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="username" id="username">
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
                        echo $collegename . " [ " . $collegename . " ]";
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
                        echo $coursename . " [ " . $coursename . " ]";
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
                        echo $streamname . " [ " . $streamname . " ]";
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
    <div class="col-md-12">
        <button class="btn btn-primary btn-block" type="submit">Add Enquiry Details</button>
    </div>
</div>                </form>
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
function setData(eid,sname,fname,cno,ed,desc,uname,cid,coid,sid,isad){    
    $("#enquiryid").val(eid);
    $("#studentname").val(sname);
    $("#fathername").val(fname);
    $("#contactno").val(cno);
    $("#enquirydate").val(ed);
    $("#description").val(desc);
    $("#username").val(uname);
    $("#collegeid").val(cid);
    $("#courseid").val(coid);
    $("#streamid").val(sid);
    $("#isadmission").val(isad);
}
</script>
<?php
require_once("../api/CloseConnection.php");
