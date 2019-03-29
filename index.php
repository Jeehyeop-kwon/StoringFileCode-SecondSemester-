<?php require('header.php'); ?> 
<body>
  <main class="container">
     <header> 
       <h1> INSTAPic!</h1>
        <a href="index.php"> Add A New Pic</a><br>
        <a href="images.php"> View Pictures</a>
     </header>
     
     <?php 
    
        //require our helper files 
        require('db.php'); 
        require('appvars.php'); 
    
        // if the form has been submitted 
        if(isset($_POST['submit'])) {
          
          $description = $_POST['description']; 
          //use $_FILES to grab the picture info 
          $photo = $_FILES['photo']['name']; 

          $photo_type = $_FILES['photo']['type']; 

          $photo_size = $_FILES['photo']['size']; 

          echo 'description : '.$description.'<br>';
          echo 'photo : '.$photo.'<br>';
          echo 'photo_type :' .$photo_type.'<br>';
          echo 'photo_size : '.$photo_size.'<br>';
          
          //if the user has given us a photo and a description 
          
          if(!empty($description) && !empty($photo)) {
            //check for the right filetype & size 
            
          if((($photo_type == 'image/gif') || ($photo_type == 'image/jpg') || ($photo_type == 'image/jpeg') || ($photo_type == 'image/png')) && ($photo_size > 0) && ($photo_size <= MAXFILESIZE)) {
            
            //check for file upload errors 
            
            if($_FILES['photo']['error'] == 0) {
              
              $target = UPLOADPATH . $photo; 

              echo 'file error : '. $_FILES['photo']['error'].'<br>';
              
              //move the file to the images folder 
              
              if(move_uploaded_file($_FILES['photo']['tmp_name'], $target ));

              echo 'file tmp_name : '.$_FILES['photo']['tmp_name'].'<br>';
              
              // set up our query 
              
              $sql = "INSERT INTO pictures(picture_description, photo) VALUES (:description, :photo);"; 
              
              //prepare 
              $cmd = $conn->prepare($sql); 
              
              //bind
              
              $cmd->bindParam(':description', $description);
              $cmd->bindParam(':photo', $photo); 
              
              //execute 
              
              $cmd->execute(); 
              
              //close the db connection 
              
              $cmd->closeCursor(); 
            
        
              
            }
            else {
              echo '<p> There was a problem with your file upload </p>'; 
      
            }
         
          }
          else {
            echo '<p> The must submit either a png, jpeg, jpg, or a png and your file cannot be bigger than 32kb <p>'; 

            }

          }
          
          else {
            echo '<p> Please fill out all the info!! </p>'; 
          
          }

        }

    ?>
    <!-- don't forget the multipart form data --> 
    <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"?> 
       <div class="form-group">
         <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAXFILESIZE; ?>">
         <label for="description">Description: </label>
         <input type="text" name="description" class="form-control" id="description">
       </div>
       
       <div class="form-group">
         <label for="photo">Photo:</label>
         <input type="file" id="photo" name="photo" class="form-control">
      </div>  
      <input type="submit" name="submit">
    </form>
  </main>
</body>
</html>