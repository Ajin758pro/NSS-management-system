<?php
require_once "database.php";
session_start();

if (isset($_SESSION["user"])) {
   header("Location: index.php");
   exit();
}

if (isset($_POST["login"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];
  
  // Check if the email and password match the admin credentials
  if ($email === "admin@gmail.com" && $password === "1212") {
    $_SESSION["user"] = "admin";
    header("Location: dashboard.php");
    exit();
  } else {
    // Check against regular user credentials in the database
    require_once "database.php";
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
      $user = $result->fetch_assoc();
      $hashedPassword = $user["password"];
      if (password_verify($password, $hashedPassword)) {
        $_SESSION["user"] = "regular";
        header("Location: index.php");
        exit();
      } else {
        echo "<div class='alert alert-danger'>Invalid email or password.</div>";
      }
    } else {
      echo "<div class='alert alert-danger'>Invalid email or password.</div>";
    }
  }
}
?>
<?php include_once"include/header.php"; ?>
<body><br><br><br><br>
  <div class="row justify-content-center mt-5">
    <div class="col-md-6">
      <div class="card border-dark" >
        <div class="card-header  text-white" style="background-color:#44156a ;">
          <h4>Login</h4>
        </div>
        <div class="card-body">
          <form action="login.php" method="POST">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required>
              </div>
            </div><br>
            <button type="submit" class="btn btn-outline-primary" id="login-button" name="login" value="Login">Login</button>
          </form>
        </div>
      </div>
      <div><p>Not registered yet? <a href="signup.php">Signup Here</a></p></div>
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
