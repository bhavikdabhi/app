<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../@dmin/admin_login.php");
    exit;
}
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
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="form-container">
    <h2>Upload Package Details</h2>
    <form action="upload_image_pdf.php" method="POST" enctype="multipart/form-data">
        
        <label for="image">Choose Image:</label>
        <input type="file" name="image" id="image" accept="image/*" required>

        <label for="country">Country:</label>
        <input type="text" name="country" id="country" required>

        <label for="place">Place:</label>
        <input type="text" name="place" id="place" required>

        <label for="day">Days:</label>
        <input type="number" name="day" id="day" required>

        <label for="night">Nights:</label>
        <input type="number" name="night" id="night" required>

        <label for="pax">Pax (No. of People):</label>
        <input type="number" name="pax" id="pax" required>

        <label for="price">Price ($):</label>
        <input type="text" name="price" id="price" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" required></textarea>

        <button type="submit">Upload</button>
    </form>

    <button class="view-btn" onclick="redirectToDashboard()">View Packages</button>
</div>

<script>
    function redirectToDashboard() {
        window.location.href = "../@dmin/admin_dashboard.php";
    }
</script>

</body>
</html>
