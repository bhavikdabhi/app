<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../@dmin/admin_login.php");
    exit;
}
include_once '../upload/db_config.php';
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
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="./ad.css">
</head>
<body>

<header class="header">
    <button class="menu-btn" id="menuToggle">&#9776;</button> 
    <span class="logo">Admin Dashboard</span>
    <nav>
        <a href="index.php">Home</a>
        <a href="new_admin.php">New Admin</a>
    </nav>
</header>

<div class="dashboard-container">
    <nav class="sidebar" id="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="../upload/upload_form.php">Add Des..</a></li>
            <li><a href="../upload/edit_package.php">Packages</a></li> 
            <!-- packages_view.php gallery.php -->
            <li><a href="">Gallery</a></li>
            <li><a href="logout.php" class="logout-btn">Logout</a></li>
        </ul>
    </nav>
</div>



    <main class="main-content">
        <h2>Packages View</h2>

        <ul class="popular-list">
            <?php
            $sql = "SELECT id, image_data, country, place, description, pdf FROM images";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $imageId = $row['id']; 
                    $country = $row['country'];
                    $place = $row['place'];
                    $description = $row['description'];
                    $pdfExists = !empty($row['pdf']); 

                    echo "
                    <li>
                        <div class='popular-card'>
                            <figure class='card-img'>
                                <img src='display_image.php?id=$imageId' alt='$place' loading='lazy'>
                            </figure>

                            <div class='card-content'>
                                <div class='card-rating'>
                                    <img src='../assets/img/icon/starr.svg'>
                                    <img src='../assets/img/icon/starr.svg'>
                                    <img src='../assets/img/icon/starr.svg'>
                                    <img src='../assets/img/icon/starr.svg'> 
                                    <img src='../assets/img/icon/starr.svg'>
                                </div>
                                <p class='card-subtitle'>$country</p>
                                <h3 class='h3 card-title'>$place</h3>
                                <p class='card-text'>$description</p>

                                <div class='button-group'>
                                    <a href='../upload/edit_pdf.php?id=$imageId' class='btn upload-btn'>Upload PDF</a>
                                    <a href='../upload/edit_image.php?id=$imageId' class='btn edit-btn'>Edit</a>
                                    " . ($pdfExists ? "<a href='../upload/download_pdf.php?id=$imageId' target='_blank' class='btn download-btn'>PDF</a>" 
                                    : "<span class='no-pdf'>No PDF Available</span>") . "
                                    <a href='../upload/delete_image.php?id=$imageId' class='btn delete-btn' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
                                </div>
                            </div>
                        </div>
                    </li>";
                }
            } else {
                echo "<p>No records found.</p>";
            }
            mysqli_close($conn);
            ?>
        </ul>
    </main>
</div>
<script>
document.getElementById("menuToggle").addEventListener("click", function () {
    let sidebar = document.getElementById("sidebar");
    let content = document.querySelector(".main-content");

    sidebar.classList.toggle("open");
    content.classList.toggle("shifted");
});
</script>





</body>
</html>
