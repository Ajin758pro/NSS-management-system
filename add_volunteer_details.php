

<?php include_once"include/header.php"; ?>
<body><br><br><br><br>

  <div class="container">
    <?php
    if(isset($_POST["submit"]))
    {
      $name = $_POST["name"];
      $email = $_POST["email"];
      $phone = $_POST["phone"];
      $address = $_POST["address"];
      $gender = $_POST["gender"];
      $age = $_POST["age"];

      $errors = array();

      if(empty($name) || empty($email) || empty($phone) || empty($address) || empty($gender) || empty($age)) {
        array_push($errors, "All fields are required");
      }

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
      }

      if (strlen($phone) != 10 || !ctype_digit($phone)) {
        array_push($errors, "Phone number must be 10 digits long and contain only numbers");
      }

      require_once "database.php";
      $sql = "INSERT INTO volunteers (name, email, phone, address, gender, age) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = mysqli_prepare($conn, $sql);

      if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssi", $name, $email, $phone, $address, $gender, $age);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
          echo "<div class='alert alert-success'>Volunteer added successfully.</div>";
        } else {
          echo "<div class='alert alert-danger'>Failed to add volunteer. Please try again later.</div>";
        }

        mysqli_stmt_close($stmt);
      } else {
        echo "<div class='alert alert-danger'>Something went wrong.</div>";
      }

      mysqli_close($conn);
    }
    ?>
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card border-dark" >
          <div class="card-header text-white" style="background-color:#44156a ;" >
            <h4>Add Volunteer</h4>
          </div>
          <div class="card-body">
            <form action="add_volunteer_details.php" method="POST">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone" required>
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" required>
              </div>
              <div class="form-group">
                <label for="gender">Gender</label><br>
                <input type="radio" id="male" name="gender" value="Male">
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="Female">
                <label for="female">Female</label>
              </div>
              <div class="form-group">
                <label for="age">Age</label>
                <input type="number" class="form-control" id="age" placeholder="Enter age" name="age" required>
              </div>
              <button type="submit" class="btn btn-outline-primary" name="submit">Add Volunteer</button>
            </form>
          </div>
        </div> 
      </div>
    </div>
  </div>
</body>
</html>
<script>
  // Function to hide the error and success divs after 3 seconds
  function hideMessages() {
    setTimeout(function() {
      document.querySelectorAll('.alert').forEach(function(alert) {
        alert.style.display = 'none';
      });
    }, 3000); // 3000 milliseconds = 3 seconds
  }

  // Call the hideMessages function when the page loads
  window.onload = function() {
    hideMessages();
  };
</script>
