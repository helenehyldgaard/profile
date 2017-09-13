<?php
    session_start();
    include_once'dbcon.php';
?>    
    <!doctype html>
    <html>
    <head>
    <link rel="stylesheet" href="style.css">
    <body>
        
        <?php
            // Here we check if we have any users inside of the database
            // If we do we start looping them out with the whileloop and check if 
            // that person has an image uploaded in the root-folder of the website
            $sql = "SELECT * FROM user";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $sqlImg = "SELECT * FROM profileimg WHERE userid='$id'";
                    $resultImg = mysqli_query($conn, $sqlImg);
                    while ($rowImg = mysqli_fetch_assoc($resultImg)) {
                        echo "<div class='user-container'>";
                            if ($rowImg['status'] == 0 ) { //if the status is equal to 0, then there has not been uploaded an image
                                echo "<img src='uploads/profile".$id.".jpg?'".mt_rand().">";
                            } else {
                                echo "<img src='uploads/profiledefault.jpg'>";
                            }
                            echo "<p>".$row['username']."</p>";
                        echo "</div>";
                    }
                    
                }
            } else {
                 
            }
        
            if(isset($_SESSION['id'])) {
                if ($_SESSION['id'] == 1) {
                    echo "You are logged in as user #1";
                }
                
                echo "<form action='upload.php' method='POST'              enctype='multipart/form-data'>
                        <input type='file' name='file'>
                        <button type='submit' name='submit'>Upload profile image</button>
                      </form>";
            } else {
                
                
                echo "<form action='signup.php' method='POST'>
                    <input type='text' name='first' placeholder='First name'>
                    <input type='text' name='last' placeholder='Last name'>
                    <input type='text' name='uid' placeholder='Username'>
                    <input type='password' name='pwd' placeholder='Password'>
                    <button type='submit' name='submitSignup'>Sign up</button>
                        
                    </form>";
            }
        ?>
        
        
        
        <div class="log">
        <form action="login.php" method="POST">
            <button type="submit" name="submitLogin">Login</button>
        </form>
        </div>
         <div class="logg">
        <form action="logout.php" method="POST">
            <button type="submit" name="submitLogout">Logout</button>
        </form>
        </div>
        
        
    </body>
    </head>
    </html>