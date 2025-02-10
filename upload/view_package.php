<!-- packgages view for clint  -->
<?php


 include_once './db_config.php'; 

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
        echo "No image found.";
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

.download-btn {
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
.package-card .card-banner img {
    width: 100%;
    height: 302px;}
      
    </style>

</head>
<body>
<header class="header header" data-header >            
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
                  <a href="../index.php" class="navbar-link" data-nav-link>home</a>
                </li>
      
                <li>
                  <a href="#" class="navbar-link" data-nav-link>about us</a>
                </li>
      
                 <li>
                  <a href="../upload/view_images.php" class="navbar-link" data-nav-link>Destination</a>
                </li> 
      
                <li>
                  <a href="#package" class="navbar-link" data-nav-link>packages</a>
                </li>

                <li>
                  <a href="../index.php#service" class="navbar-link" data-nav-link>Service</a>
                </li>

                <!-- <li>
                  <a href="#gallery" class="navbar-link" data-nav-link>gallery</a>
                </li> -->
      
                <li>
                  <a href="../index.php#contact" class="navbar-link" data-nav-link>contact us</a>
                </li>
      
              </ul>

            </nav>
      
            <!-- <button class="btn btn-primary">Book Now</button> -->
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

      <section class="package" id="package">
    <div class="container">
        <p class="section-subtitle">Popular Packages</p>
        <h2 class="h2 section-title">Checkout Our Packages</h2>
        <p class="section-text">
            Checkout our packages for an unforgettable experience, tailored to suit every traveler’s dream!
        </p>

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
                        <img src='display_image.php?id=$imageId' alt='$place' loading='lazy'>
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
                        
                      <p class='price'>\$ $price <span>/ per person</span></p>
                        <div class='button-group'>";
                if ($pdfExists) {
                  echo "<a href='download_pdf.php?id=$imageId' class='btn download-btn' target='_blank'>Download PDF</a>";
                } else {
                    echo "<span class='no-pdf'>No PDF Available</span>";
                }
                echo "</div>
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

        <button class="btn btn-primary">View All Packages</button>
    </div>
</section>




<script src="../assets/js/script.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>