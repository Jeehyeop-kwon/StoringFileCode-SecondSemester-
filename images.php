<?php require('header.php'); ?>
  <body>
    <main class="container">
       <header>
         <h1> INSTAPic!</h1>
          <a href="index.php"> Add A New Pic</a><br>
          <a href="delete.php"> Delet All pictures</a>
       </header>
       <?php 
          //require our helper files 
          require('db.php'); 
          require ('appvars.php');
      
          //write sql query 
      
          $sql = "SELECT * FROM pictures;"; 
      
          //prepare 
      
          $cmd = $conn->prepare($sql); 
        
          //execute the query and store the results 
      
          $cmd->execute(); 
      
          //use fetchALL method
      
          $pictures = $cmd->fetchAll(); 
      
          echo '<div class="photocontainer">'; 
          
          //loop through the results 
      
          foreach($pictures as $picture) {
            echo '<div>
                    <img src="' . UPLOADPATH . $picture['photo'] . '">
                    <p>' . $picture['picture_description'] . '</p>
                  </div>'; 
          }
      
        echo '</div>'; 
      
        $cmd->closeCursor(); 

        ?>
      
    </main>
  </body>
</html>