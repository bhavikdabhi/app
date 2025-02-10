   <section class="package" id="package">
                <div class="container">
        
                  <p class="section-subtitle">Popular Packeges</p>
        
                  <h2 class="h2 section-title">Checkout Our Packeges</h2>
        
                  <p class="section-text">
                    Checkout our packages for an unforgettable experience, tailored to suit every traveler’s dream!
                   </p>
        
                  <ul class="package-list">
                    <?php


                    // Fetch data from the database
                    $sql = "SELECT id, image_data, country, place, description, pdf FROM images";
                    $result = mysqli_query($conn, $sql);
                    
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $imageId = $row['id']; 
                            $country = $row['country'];
                            $place = $row['place'];
                            $description = $row['description'];
                            $day = $row['day'];
                            $night=$row['night'];
                            $pax = $row['pax'];
                            $pdfExists = !empty($row['pdf']); // Check if PDF exists
                    
        echo "
                    <li>
                      <div class="package-card">
        
                        <figure class="card-banner">
                          <img src='display_image.php?id=$imageId' alt='$place' loading='lazy'>
                        </figure>
        
                        <div class="card-content">
        
                          <h3 class="h3 card-title">  <a href='#'>$country</a>  <a href='#'>$place</a></h3>
        
                          <p class="card-text">
                            $description
                          </p>
        
                          <ul class="card-meta-list">
        
                            <li class="card-meta-item">
                              <div class="meta-box">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#588cd0"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                                <p class="text">$dayD/$nightN</p>
                              </div>
                            </li>
        
                            <li class="card-meta-item">
                              <div class="meta-box">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#588cd0"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M9 13.75c-2.34 0-7 1.17-7 3.5V19h14v-1.75c0-2.33-4.66-3.5-7-3.5zM4.34 17c.84-.58 2.87-1.25 4.66-1.25s3.82.67 4.66 1.25H4.34zM9 12c1.93 0 3.5-1.57 3.5-3.5S10.93 5 9 5 5.5 6.57 5.5 8.5 7.07 12 9 12zm0-5c.83 0 1.5.67 1.5 1.5S9.83 10 9 10s-1.5-.67-1.5-1.5S8.17 7 9 7zm7.04 6.81c1.16.84 1.96 1.96 1.96 3.44V19h4v-1.75c0-2.02-3.5-3.17-5.96-3.44zM15 12c1.93 0 3.5-1.57 3.5-3.5S16.93 5 15 5c-.54 0-1.04.13-1.5.35.63.89 1 1.98 1 3.15s-.37 2.26-1 3.15c.46.22.96.35 1.5.35z"/></svg>
                                <p class="text">pax: $pax</p>
                              </div>
                            </li>
        
                            <li class="card-meta-item">
                              <div class="meta-box">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#588cd0"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 4c1.93 0 5 1.4 5 5.15 0 2.16-1.72 4.67-5 7.32-3.28-2.65-5-5.17-5-7.32C7 5.4 10.07 4 12 4m0-2C8.73 2 5 4.46 5 9.15c0 3.12 2.33 6.41 7 9.85 4.67-3.44 7-6.73 7-9.85C19 4.46 15.27 2 12 2z"/><path d="M12 7c-1.1 0-2 .9-2 2s.9 2 2 2a2 2 0 100-4zM5 20h14v2H5v-2z"/></svg>
        
                                <p class="text">$place</p>
                              </div>
                            </li>
                      
        
                          </ul>
        
                        </div>
        
                        <div class="card-price">
        
                          <div class="wrapper">
        
                            <p class="reviews">(25 reviews)</p>
        
                            <div class="card-rating">
                              <img src="./assets/img/icon/starr.svg">
                              <img src="./assets/img/icon/starr.svg">
                              <img src="./assets/img/icon/starr.svg">
                              <img src="./assets/img/icon/starr.svg"> 
                              <img src="./assets/img/icon/starr.svg">
                            </div>
        
                          </div>
        
                          <p class="price">
                           $price
                            <span>/ per person</span>
                          </p>
        
                          <div class='button-group'>
                            " . ($pdfExists ? "<a href='download_pdf.php?id=$imageId' class='btn download-btn'>Download PDF</a>" 
                              : "<span class='no-pdf'>No PDF Available</span>") . "
                              </div>
      
        
                        </div>
        
                      </div>
                    </li>;
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