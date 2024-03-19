<?php
// Include database connection code here
require_once "database.php";

// Query to retrieve volunteer details
$sql = "SELECT * FROM volunteers";
$result = $conn->query($sql);

?>

<?php include_once "include/header.php"; ?>
<body><br><br><br><br>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-10">
        <div class="card border-dark" >
          <div class="card-header text-white" style="background-color:#44156a ;">
            <h4>Volunteer Details</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Age</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if ($result->num_rows > 0) {
                      // Output data of each row
                      while($row = $result->fetch_assoc()) {
                          echo "<tr>";
                          echo "<td>".$row["name"]."</td>";
                          echo "<td>".$row["email"]."</td>";
                          echo "<td>".$row["phone"]."</td>";
                          echo "<td>".$row["address"]."</td>";
                          echo "<td>".$row["gender"]."</td>";
                          echo "<td>".$row["age"]."</td>";
                          echo "</tr>";
                      }
                  } else {
                      echo "<tr><td colspan='6'>No volunteers found.</td></tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div> 
      </div>
    </div>
  </div>
</body>
</html>
