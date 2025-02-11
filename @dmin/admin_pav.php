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
    <style>

.button-group {
    display: flex;
    gap: 10px; /* Adds spacing between buttons */
    flex-wrap: wrap; /* Ensures buttons wrap on smaller screens */
    margin-top: 15px;
}

.btn {
    display: inline-block;
    padding: 10px 15px;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
    transition: all 0.3s ease-in-out;
    min-width: 100px;
}

/* Upload PDF Button */
.upload-btn {
    background-color: #4CAF50;
    color: white;
    border: 2px solid #4CAF50;
}

.upload-btn:hover {
    background-color: white;
    color: #4CAF50;
    border: 2px solid #4CAF50;
}

/* Edit Button */
.edit-btn {
    background-color: #2196F3;
    color: white;
    border: 2px solid #2196F3;
}

.edit-btn:hover {
    background-color: white;
    color: #2196F3;
    border: 2px solid #2196F3;
}

/* PDF Button */
.download-btn {
    background-color: #FF9800;
    color: white;
    border: 2px solid #FF9800;
}

.download-btn:hover {
    background-color: white;
    color: #FF9800;
    border: 2px solid #FF9800;
}

/* Delete Button */
.delete-btn {
    background-color: #f44336;
    color: white;
    border: 2px solid #f44336;
}

.delete-btn:hover {
    background-color: white;
    color: #f44336;
    border: 2px solid #f44336;
}

/* No PDF Available */
.no-pdf {
    background-color: #ddd;
    color: #666;
    padding: 10px 15px;
    border-radius: 5px;
    font-size: 14px;
    text-align: center;
    min-width: 100px;
}

    </style>
  
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
            <li><a href="admin_dashboard.php">view Des..</a></li>
            <!-- packages_view.php gallery.php -->
            <li><a href="">Gallery</a></li>
            <li><a href="logout.php" class="logout-btn">Logout</a></li>
        </ul>
    </nav>
</div>



    <main class="main-content">
        <h2>Packages View</h2>

        <ul class="package-list">
            <?php
           

            $sql = "SELECT id, image_data, country, place, description, day, night, pax, price, pdf FROM images";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $imageId = $row['id']; 
                    $country = $row['country'];
                    $place = $row['place'];
                    $description = $row['description'];
                    $day = $row['day'];
                    $night = $row['night'];
                    $pax = $row['pax'];
                    $price = $row['price'];
                    $pdfExists = !empty($row['pdf']);

                    echo "<li>
                    <div class='package-card'>
                      <figure class='card-banner'>
                        <img src='../upload/display_image.php?id=$imageId' alt='$place' loading='lazy'>
                      </figure>
                      <div class='card-content'>
                        <h3 class='h3 card-title'>$country - $place</h3>
                        <p class='card-text'>$description</p>
                        <ul class='card-meta-list'>
                          <li class='card-meta-item'>
                            <div class='meta-box'>"; ?>
                             <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#588cd0"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                         <?php   echo " <p class='text'>$day D / $night N</p>
                            </div>
                          </li>
                          <li class='card-meta-item'>
                            <div class='meta-box'>";
                            ?>
                      <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#588cd0"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M9 13.75c-2.34 0-7 1.17-7 3.5V19h14v-1.75c0-2.33-4.66-3.5-7-3.5zM4.34 17c.84-.58 2.87-1.25 4.66-1.25s3.82.67 4.66 1.25H4.34zM9 12c1.93 0 3.5-1.57 3.5-3.5S10.93 5 9 5 5.5 6.57 5.5 8.5 7.07 12 9 12zm0-5c.83 0 1.5.67 1.5 1.5S9.83 10 9 10s-1.5-.67-1.5-1.5S8.17 7 9 7zm7.04 6.81c1.16.84 1.96 1.96 1.96 3.44V19h4v-1.75c0-2.02-3.5-3.17-5.96-3.44zM15 12c1.93 0 3.5-1.57 3.5-3.5S16.93 5 15 5c-.54 0-1.04.13-1.5.35.63.89 1 1.98 1 3.15s-.37 2.26-1 3.15c.46.22.96.35 1.5.35z"/></svg>
                      <?php 
                            
                            echo "     <p class='text'>Pax: $pax</p>
                            </div>
                          </li>
                          <li class='card-meta-item'>
                            <div class='meta-box'>"; ?>
                             <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#588cd0"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 4c1.93 0 5 1.4 5 5.15 0 2.16-1.72 4.67-5 7.32-3.28-2.65-5-5.17-5-7.32C7 5.4 10.07 4 12 4m0-2C8.73 2 5 4.46 5 9.15c0 3.12 2.33 6.41 7 9.85 4.67-3.44 7-6.73 7-9.85C19 4.46 15.27 2 12 2z"/><path d="M12 7c-1.1 0-2 .9-2 2s.9 2 2 2a2 2 0 100-4zM5 20h14v2H5v-2z"/></svg>
                             <?php 
                            
                            echo "                                <p class='text'>$place</p>
                            </div>
                          </li>
                        </ul>
                      </div>
                      <div class='card-price'>
                        
                      <p class='price'> $price ₹<span>/ per person</span></p>
                        <div class='button-group'>
                        <a href='../upload/edit_pdf.php?id=$imageId' class='btn upload-btn'>Upload PDF</a>
                        <a href='../upload/edit_package.php?id=$imageId' class='btn edit-btn'>Edit</a>";
                if ($pdfExists) {
                  echo "<a href='../upload/download_pdf.php?id=$imageId' class='btn download-btn' target='_blank'>PDF</a>";
                } else {
                    echo "<span class='no-pdf'>No PDF Available</span>";
                }
                echo " <a href='../upload/delete_image.php?id=$imageId' class='btn delete-btn' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
                             
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
