<?php
include 'db_config.php';
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../@dmin/admin_login.php");
    exit;
}


// Get the ID from the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the existing data
    $sql = "SELECT * FROM images WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $country = $row['country'];
        $place = $row['place'];
        $description = $row['description'];
        $image_name = $row['image_name'];
        $pdf_exists = !empty($row['pdf']);
    } else {
        echo "<script>alert('Record not found!'); window.location.href='admin_dashboard.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Invalid request!');</script>";
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
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600&family=Poppins:wght@400;600&display=swap');

:root {
    --ff-poppins: "Poppins", sans-serif;
    --ff-nunito: "Nunito", sans-serif;
    --primary-color: #3b79c9;
    --secondary-color: #ffffff;
    --text-color: #333;
    --border-color: #ccc;
    --hover-color: #3166b0;
}

body {
    background-color: var(--primary-color);
    font-family: var(--ff-nunito);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* Form Container */
.form-container {
    background: var(--secondary-color);
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    width: 350px;
    text-align: center;
    font-family: var(--ff-poppins);
}

/* Heading */
h2 {
    color: var(--primary-color);
    margin-bottom: 15px;
    font-size: 22px;
}

/* Form Fields */
label {
    display: block;
    text-align: left;
    margin: 10px 0 5px;
    font-weight: 600;
    color: var(--text-color);
}

input, textarea {
    width: calc(100% - 20px);
    max-width: 310px;
    padding: 10px;
    border: 1px solid var(--border-color);
    border-radius: 5px;
    font-family: var(--ff-nunito);
    margin-bottom: 12px;
}

/* Button */
button {
    width: 100%;
    padding: 12px;
    background-color: var(--primary-color);
    border: none;
    color: var(--secondary-color);
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
    font-family: var(--ff-poppins);
}

button:hover {
    background-color: var(--hover-color);
}

/* Button Group */
.button-group {
    margin-top: 10px;
    display: flex;
    justify-content: center;
    gap: 10px;
}

/* Buttons */
.btn {
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    color: white;
    font-size: 14px;
    transition: 0.3s;
}

.download-btn {
    background-color: #28a745;
}

.download-btn:hover {
    background-color: #218838;
}

/* No PDF Text */
.no-pdf {
    color: red;
    font-size: 14px;
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
    <h2>Edit Image & PDF Details</h2>
    <form action="update_pdf.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="country">Country</label>
        <input type="text" name="country" id="country" value="<?php echo $country; ?>" required>

        <label for="place">Place</label>
        <input type="text" name="place" id="place" value="<?php echo $place; ?>" required>

        <label for="description">Description</label>
        <textarea name="description" id="description" rows="4" required><?php echo $description; ?></textarea>

        <div class="button-group">
            <?php if ($pdf_exists): ?>
                <a href="download_pdf.php?id=<?php echo $id; ?>" class="btn download-btn">View PDF</a>
            <?php else: ?>
                <span class="no-pdf">No PDF uploaded</span>
            <?php endif; ?>
        </div>

        <label for="pdf">Upload New PDF (Optional)</label>
        <input type="file" name="pdf" accept="application/pdf">

        <button type="submit">Update</button>
        
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
