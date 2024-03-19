<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: login.php");
   exit();
}
?>

<?php include_once"include/header.php"; ?>
<body><br><br><br><br>

  <div class="container">
    <?php
    // print_r($_POST);
    if(isset($_POST["submit"]))
    {
      $user_name = $_POST["uname"];
      $email = $_POST["email"];
      $password = $_POST["password"];
      $repeatpassword = $_POST["repeat_password"];

      $passwordHash = password_hash($password, PASSWORD_DEFAULT); // hashing

      $errors = array();

      if(empty($username) || empty($email) || empty($password) || empty($repeatpassword)) {
        array_push($errors, "All fields are required");
      }

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
      }

      if (strlen($password) < 3) {
        array_push($errors, "Password must be at least 3 characters long");
      }

      if ($password !== $repeatpassword) {
        array_push($errors, "Passwords do not match");
      }

      require_once "database.php";
      $sql = "INSERT INTO users (user_name, email, password) VALUES (?, ?, ?)";
      $stmt = mysqli_prepare($conn, $sql);

      if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $user_name, $email, $passwordHash);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
          echo "<div class='alert alert-success'>You are registered successfully.</div>";
          header("Location: login.php");

          
        } else {
          echo "<div class='alert alert-danger'>Failed to register. Please try again later.</div>";
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
            <h4>Signup</h4>
          </div>
          <div class="card-body">
            <form action="signup.php" method="POST">
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter your username" name="uname" required >
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" required >
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required >
                </div>
              </div>
              <div class="form-group">
                <label for="repeat_password">Repeat Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="repeat_password" placeholder="Repeat your password" name="repeat_password" required >
                </div>
              </div><br>
              <button type="submit" class="btn btn-outline-primary" id="signup-button" name="submit" value="Register" >Signup</button>
            </form>
          </div>
        </div> 
        <div><span></span><p> Already Registered <a href="login.php">Login Here</a></p></div>
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

 