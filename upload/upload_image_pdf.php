<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../@dmin/admin_login.php");
    exit;
}

include 'db_config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pdf_content = null;
    $imageData = null;

    // Check if the image file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageData = file_get_contents($imageTmpName); // Read the image into a variable
    } else {
        echo "Image upload failed or no image uploaded.";
        exit;
    }

    // Get additional form fields
    $country = htmlspecialchars($_POST['country']);
    $place = htmlspecialchars($_POST['place']);
    $description = htmlspecialchars($_POST['description']);
    $day = (int)$_POST['day'];
    $night = (int)$_POST['night'];
    $pax = (int)$_POST['pax'];
    $price = htmlspecialchars($_POST['price']);

    // Prepare the SQL query to insert the data into the database
    $sql = "INSERT INTO images (image_name, image_data, country, place, day, night, pax, price, pdf, description) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        // Bind the parameters (s = string, i = integer, b = blob)
        mysqli_stmt_bind_param($stmt, 'sbssiiisss', $imageName, $imageData, $country, $place, $day, $night, $pax, $price, $pdf_content, $description);

        // Send BLOB data for image
        mysqli_stmt_send_long_data($stmt, 1, $imageData);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Data Uploaded'); window.location.href='../@dmin/admin_dashboard.php';</script>";
        } else {
            echo "Error uploading the image and PDF: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing the query.";
    }
}

// Close the database connection
mysqli_close($conn);
?>
