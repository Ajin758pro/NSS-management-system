<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
   exit();
}
?>
<?php include_once 'include/header.php'; ?>
    <!-- <h1>hello </h1> -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid" style="margin-left: 100px;">
    <a class="navbar-brand" href="#">NSS Management System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item" style="margin-left: 100px;">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item" style="margin-left: 100px;">
          <a class="nav-link" href="view_volunteer_details.php">volunteer_details</a>
        </li>
        <li class="nav-item" style="margin-left: 100px;">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item" style="margin-left: 100px;">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item" style="margin-left: 100px;">
        <a class="btn btn-danger" href="logout.php" ><span style="color:white;">Logout</span></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <div style="margin-left: 50px;">
   
  </div>
<?php include_once 'include/footer.php';?>
