<?php
session_start();
include './db_config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../@dmin/admin_login.php");
    exit;
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM images WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
} else {
    echo "<script>alert('Invalid request!'); window.location.href='../@dmin/admin_dashboard.php';</script>";
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
    <link rel="stylesheet" href="./css/edit.css">

</head>
<body>
    <div class="container">
        <header>Edit Package</header>
        <form action="update_package.php" method="POST" enctype="multipart/form-data">
            <div class="form first">
                <div class="details personal">
                    <div class="fields">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="input-field">
                            <label>Country:</label>
                            <input type="text" name="country" id="country" value="<?php echo $row['country']; ?>" required>
                        </div>
                        <div class="input-field">
                            <label>Place:</label>
                            <input type="text" name="place" id="place" value="<?php echo $row['place']; ?>" required>
                        </div>
                        <div class="input-field">
                            <label>Description:</label>
                            <textarea name="description" id="description" rows="4" required><?php echo $row['description']; ?></textarea>
                        </div>
                        <div class="input-field">
                            <label>Days:</label>
                            <input type="number" name="day" id="day" value="<?php echo $row['day']; ?>" required>
                        </div>
                        <div class="input-field">
                            <label>Nights:</label>
                            <input type="number" name="night" id="night" value="<?php echo $row['night']; ?>" required>
                        </div>                             
                   
                        <div class="input-field">
                            <label>Pax (No. of People):</label>
                            <input type="number" name="pax" id="pax" value="<?php echo $row['pax']; ?>" required>
                        </div>
                        <div class="input-field">
                            <label>Price (₹):</label>
                            <input type="text" name="price" id="price" value="<?php echo $row['price']; ?>" required>
                        </div>
                        <div class="input-field">  
                        <div class="image-preview">
            <img src="display_image.php?id=<?php echo $id; ?>" alt="Current Image">
        </div>   </div>
                        <div class="input-field">  
                                                
                            <label for="image">Upload New Image</label>
                            <input type="file" name="image" id="image" accept="image/*">                    
                        </div>                       
                    </div>
                  
                        <button type="submit" class="nextBtn">Update Package</button>   
                        <button class="view-btn" onclick="redirectToImages()">Packages</button>        
                </div> 
                   
        </form>
    </div>
    <script src="./script.js"></script>
    <script>
    function redirectToImages() {
        window.location.href = "../@dmin/admin_dashboard.php";
    }
</script>
</body>
</html>