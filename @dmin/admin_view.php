<!-- packgages view for clint  -->

<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../@dmin/admin_login.php");
    exit;
}

include_once 'db_config.php'; 

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT image_data FROM images WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $imageData);
    mysqli_stmt_fetch($stmt);

    if ($imageData) {
        header("Content-Type: image/jpeg");
        echo $imageData;
    } else {
      echo "<script>alert('No image found.'); window.location.href='view_images.php';</script>";
 
    }

 
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
  <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
   .button-group {
    margin-top: 10px;
    display: flex;
    gap: 4px;
}

.btn {
    padding: 8px 12px;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    color: white;
    font-size: 14px;
    transition: 0.3s;
}

.btn:hover {
    opacity: 0.8;
}



.delete-btn {
    background-color: #dc3545; /* Red */
}
.upload-btn , .edit-btn, .download-btn {
    background-color: #3b79c9;
}
.no-pdf {
    color: red;
    font-size: 14px;
}
.card-text {
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: normal;
    max-width: 100%;
    text-align: justify;
}


      .header{
        background: #3b79c9;
      }
      .popular{
  padding-top: 150px;
}
    </style>

</head>
<body>
<header class="header" data-header >            
        <div class="header-bottom">
          <div class="container">      
          <div class="">
                
                  <img src="../assets/img/icon/logo.png" height="70px"> 
                </div> 
             
            <nav class="navbar" data-navbar>    
              <div class="navbar-top"> 
                         
    
                <button class="nav-close-btn" aria-label="Close Menu" data-nav-close-btn>
                  <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#3b79c9"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/></svg>  </button>
    
              </div>
              
              <ul class="navbar-list">
      
                <li>
                  
                  <a href="#home" class="navbar-link" data-nav-link>home</a>
                </li>
      
                <li>
                  <a href="#" class="navbar-link" data-nav-link>about us</a>
                </li>
      
                <!-- <li>
                  <a href="#destination" class="navbar-link" data-nav-link></a>
                </li> -->
      
                <li>
                  <a href="./componets/package.php" class="navbar-link" data-nav-link>packages</a>
                </li>

                <li>
                  <a href="#service" class="navbar-link" data-nav-link>Service</a>
                </li>

                <li>
                  <a href="#gallery" class="navbar-link" data-nav-link>gallery</a>
                </li>
      
                <li>
                  <a href="#contact" class="navbar-link" data-nav-link>contact us</a>
                </li>
      
              </ul>

            </nav>
      
            <button class="btn btn-primary">Book Now</button>
            <a href="tel:+919998963732" class="helpline-box">      
                <div class="icon-box">
                
                  <img src="../assets/img/icon/pcall.svg"> 
                </div>      
                <div class="wrapper">
                  <p class="helpline-title">For Further Inquires :</p>      
                  <p class="helpline-number">+919998963732</p>
                </div>        
              </a>
            <div class="header-btn-group">
            <button class="nav-open-btn" aria-label="Open Menu" data-nav-open-btn>
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff"><g fill="none"><path d="M0 0h24v24H0V0z"/><path d="M0 0h24v24H0V0z" opacity=".87"/></g><path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7zm-4 6h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z"/></svg>
              </button>
      </div>
          </div>
        </div>
      
      </header>
      
<section class="popular" id="destination">
                <div class="container">
                <!-- <img class="package_bg" src="../assets/img/america.jpg" > -->
                  <p class="section-subtitle">Uncover place</p>
        
                  <h2 class="h2 section-title">Popular destination</h2>
        
                  <p class="section-text">
                    Explore the endless possibilities of your next adventure with us. From breathtaking landscapes to vibrant cities, our meticulously crafted tour packages promise an unforgettable experience. Enjoy seamless travel with comprehensive services like visa assistance, flight bookings, and 24/7 support. Each journey is customized to cater to your preferences, ensuring a perfect getaway. Join us and let your dream destination come to life with expert guidance every step of the way.
                  </p>
        
                  <ul class="popular-list">

                  <?php


// Fetch data from the database, including the PDF column
$sql = "SELECT id, image_data, country, place, description, pdf FROM images";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $imageId = $row['id']; 
        $country = $row['country'];
        $place = $row['place'];
        $description = $row['description'];
        $pdfExists = !empty($row['pdf']); // Check if PDF exists

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

                    <p class='card-subtitle'>
                        <a href='#'>$country</a>
                    </p>

                    <h3 class='h3 card-title'>
                        <a href='#'>$place</a>
                    </h3>

                    <p class='card-text'>
                        $description
                    </p>

                    <div class='button-group'>
                        <a href='edit_pdf.php?id=$imageId' class='btn upload-btn'>Upload PDF</a>
                        <a href='edit_image.php?id=$imageId' class='btn edit-btn'>Edit</a>
                        " . ($pdfExists ? "<a href='download_pdf.php?id=$imageId' target='_blank' class='btn download-btn'>PDF</a>" 
                        : "<span class='no-pdf'>No PDF Available</span>") . "
                        <a href='delete_image.php?id=$imageId' class='btn delete-btn' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
                        
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

<script src="../assets/js/script.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>