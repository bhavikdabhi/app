<?php
// Database connection
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../@dmin/admin_login.php");
    exit;
}

include 'db_config.php';

// Check if an ID is provided
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the existing data
    $sql = "SELECT * FROM images WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $image_name = $row['image_name'];
        $country = $row['country'];
        $place = $row['place'];
        $description = $row['description'];
    } else {
        echo "<script>alert('Record not found!'); window.location.href='admin_dashboard.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Invalid request!');</script>";
    exit;
}

// Close the statement
mysqli_stmt_close($stmt);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WonderlandHoliday</title>
  <link rel="shortcut icon" href="../assets/img/hlogo.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

:root {
    --primary-color: #3b79c9;
    --secondary-color: #ffffff;
    --text-color: #333;
    --border-color: #ccc;
    --hover-color: #3166b0;
    --input-bg: #f0f5ff;
}

body {
    background-color: var(--primary-color);
    font-family: 'Poppins', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* Form Container */
.form-container {
    background: var(--secondary-color);
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
    width: 350px;  /* Increased width slightly */
    text-align: center;
}

/* Heading */
h2 {
    color: var(--primary-color);
    margin-bottom: 15px;
    font-size: 20px;
}

/* Form Groups */
.form-group {
    margin-bottom: 12px;
    text-align: left;
}

label {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-color);
}

/* Input & Textarea Fix */
input, textarea {
    width: calc(100% - 10px);  /* Ensures input stays within the container */
    height: 40px; /* Increased height */
    padding: 8px;
    background-color: var(--input-bg);
    border: 1px solid var(--border-color);
    border-radius: 5px;
    font-family: 'Poppins', sans-serif;
    margin-top: 3px;
    box-sizing: border-box;
}

textarea {
    height: 80px; /* Increased height */
    resize: none;
}

/* Image Preview */
.image-preview {
    display: flex;
    justify-content: center;
    margin-bottom: 12px;
}

.image-preview img {
    width: 120px;  /* Increased size */
    height: auto;
    border-radius: 8px;
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.2);
}

/* Button */
button {
    width: 100%;
    padding: 12px;
    background-color: var(--primary-color);
    border: none;
    color: var(--secondary-color);
    font-size: 14px;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
}

button:hover {
    background-color: var(--hover-color);
}
.view-btn {
    margin-top: 10px;
    width: 100%;
    padding: 10px;
    background-color: var(--hover-color);
    border: none;
    color: var(--secondary-color);
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
    font-family: var(--ff-poppins);
}

</style>
</head>
<body>

<div class="form-container">
    <h2>Edit Info</h2>
    <form action="update_image.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="form-group">
            <label for="country">Country</label>
            <input type="text" name="country" id="country" value="<?php echo $country; ?>" required>
        </div>

        <div class="form-group">
            <label for="place">Place</label>
            <input type="text" name="place" id="place" value="<?php echo $place; ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="3" required><?php echo $description; ?></textarea>
        </div>

        <div class="image-preview">
            <img src="display_image.php?id=<?php echo $id; ?>" alt="Current Image">
        </div>

        <div class="form-group">
            <label for="image">Upload New Image</label>
            <input type="file" name="image" id="image" accept="image/*">
        </div>

        <button type="submit" class="view-btn">Update</button>

        <button class="view-btn" onclick="redirectToImages()">Packages</button>
    </form>
 
</div>

<script>
    function redirectToImages() {
        window.location.href = "../@dmin/admin_dashboard.php";
    }
</script>
</body>
</html>

<?php
mysqli_close($conn);
?>
