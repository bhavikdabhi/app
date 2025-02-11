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
<link rel="stylesheet" href="css/edit.css">
</head>
<body>
<div class="container">
        <header>Add Destination</header>
        <form action="upload_image_pdf.php" method="POST" enctype="multipart/form-data">
            <div class="form first">
                <div class="details personal">
                    <div class="fields">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="input-field">
                            <label>Country:</label>
                            <input type="text" name="country" id="country" required>
                        </div>
                        <div class="input-field">
                            <label>Place:</label>
                            <input type="text" name="place" id="place" required>
                        </div>
                        <div class="input-field">
                            <label>Description:</label>
                            <textarea name="description" id="description" rows="4" required></textarea>
                        </div>
                        <div class="input-field">
                            <label>Days:</label>
                            <input type="number" name="day" id="day"  required>
                        </div>
                        <div class="input-field">
                            <label>Nights:</label>
                            <input type="number" name="night" id="night"  required>
                        </div>                             
                   
                        <div class="input-field">
                            <label>Pax (No. of People):</label>
                            <input type="number" name="pax" id="pax" required>
                        </div>
                        <div class="input-field">
                            <label>Price (₹):</label>
                            <input type="text" name="price" id="price"  required>
                        </div>
                      
                       <div class="input-field">  
                                                
                            <label for="image">Upload New Image</label>
                            <input type="file" name="image" id="image" accept="image/*">                    
                        </div>                       
                    </div>
                  
                        <button type="submit" class="nextBtn">Update Package</button>                
                </div> 
                   
        </form>
    </div>
    <script src="./css/script.js"></script>

</body>
</html>
