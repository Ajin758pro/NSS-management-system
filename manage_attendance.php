<?php
// Include database connection code here
require_once "database.php";

// Query to retrieve events
$sql_events = "SELECT id, name FROM events";
$result_events = $conn->query($sql_events);

// Query to retrieve volunteers
$sql_volunteers = "SELECT id, name FROM volunteers";
$result_volunteers = $conn->query($sql_volunteers);

?>

<?php include_once "include/header.php"; ?>
<body><br><br><br><br>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card border-dark">
                <div class="card-header text-white" style="background-color:#44156a;">
                    <h4>Manage Attendance</h4>
                </div>
                <div class="card-body">
                    <form action="manage_attendance_process.php" method="post">
                        <div class="form-group">
                            <label for="event_id">Event:</label>
                            <select class="form-control" name="event_id" id="event_id">
                                <?php
                                while ($row = $result_events->fetch_assoc()) {
                                    echo "<option value='".$row['id']."'>".$row['name']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <br>
                        <?php
                        while ($row = $result_volunteers->fetch_assoc()) {
                            echo '<div class="row mb-3">';
                            echo '<div class="col-md-4">';
                            echo '<label>'.$row['name'].'</label>';
                            echo '</div>';
                            echo '<div class="col-md-4">';
                            echo '<select class="form-control" name="status[]">';
                            echo '<option value="present">Present</option>';
                            echo '<option value="absent">Absent</option>';
                            echo '</select>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
