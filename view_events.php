<?php
// Include database connection code here
require_once "database.php";

// Query to retrieve events
$sql = "SELECT * FROM events";
$result = $conn->query($sql);

?>

<?php include_once "include/header.php"; ?>
<body><br><br><br><br>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card border-dark">
                <div class="card-header text-white" style="background-color:#44156a;">
                    <h4>Event List</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>".$row["name"]."</td>";
                                    echo "<td>".$row["date"]."</td>";
                                    echo "<td>".$row["description"]."</td>";
                                    echo "<td><a href='manage_attendance.php?event_id=".$row["id"]."' class='btn btn-primary'>Manage Attendance</a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>No events found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
