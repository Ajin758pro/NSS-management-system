<?php
// Include database connection code here
require_once "database.php";

// Define variables to store form data and error messages
$name = $date = $description = "";
$nameErr = $dateErr = $descriptionErr = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $date = htmlspecialchars($_POST['date']);
    $description = htmlspecialchars($_POST['description']);

    // Validate form data
    if (empty($name)) {
        $nameErr = "Event name is required";
    }
    if (empty($date)) {
        $dateErr = "Date is required";
    }
    if (empty($description)) {
        $descriptionErr = "Description is required";
    }

    // Insert into events table if there are no errors
    if (empty($nameErr) && empty($dateErr) && empty($descriptionErr)) {
        $sql = "INSERT INTO events (name, date, description) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            // Bind parameters to the prepared statement
            $stmt->bind_param("sss", $name, $date, $description);
            
            // Execute the prepared statement
            if ($stmt->execute()) {
                $successMessage = "Event created successfully";
            } else {
                $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
            }
            
            // Close statement
            $stmt->close();
        } else {
            $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close database connection
$conn->close();
?>

<?php include_once "include/header.php"; ?>
<body><br><br><br><br>
<div class="container">
    <?php if (isset($successMessage)): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $successMessage; ?>
        </div>
    <?php endif; ?>
    <?php if (isset($errorMessage)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card border-dark">
                <div class="card-header text-white" style="background-color:#44156a;">
                    <h4>Create Event</h4>
                </div>
                <div class="card-body">
                    <form action="create_event.php" method="post">
                        <div class="form-group">
                            <label for="name">Event Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                            <small class="text-danger"><?php echo $nameErr; ?></small>
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="<?php echo $date; ?>">
                            <small class="text-danger"><?php echo $dateErr; ?></small>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"><?php echo $description; ?></textarea>
                            <small class="text-danger"><?php echo $descriptionErr; ?></small>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
