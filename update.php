<?php
               $conn = mysqli_connect('localhost', 'root', 'sark', 'side_crud');
               if(isset($_GET['id']) && is_numeric($_GET['id'])){
    
                $userid = $_GET['id'];
                $get_user = mysqli_query($conn,"SELECT * FROM `courses` WHERE id='$userid'");
                
                if(mysqli_num_rows($get_user) === 1){
                    
                    $row = mysqli_fetch_assoc($get_user);
                
           ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO Crud</title>
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <style>
    textarea{
        color:#000;
    }
    </style>
</head>
       <div class="container">

           <div class="page-header">
              <h1>Read Product</h1>
           </div>


           <form  method="post">
           <?php include('errors.php'); ?>
           <div class="form-group">
    <label for="exampleInputCourses">Course Name</label>
    <input type="text" class="form-control" id="cname"  name="cname" value="<?php echo $row['cname'];?>" placeholder="Enter Course Name">
  </div>

    <div class="form-group">
    <label for="exampleInputEmail1">About Course</label>
    <textarea class="form-control" name="cabout" id="cabout" cols="30" rows="10" value="<?php echo $row['cabout'];?>"></textarea>
    
  </div>


  <button type="submit" class="btn btn-primary" name="submit">Update</button>

           </form>
            
       </div>

       <script src="js/jquery-2.0.0.min.js"></script>
       <script src="js/bootstrap.js"></script>
</body>
</html>


<?php

    }else{
        // set header response code
        http_response_code(404);
        echo "<h1>404 Page Not Found!</h1>";
    }
    
}else{
    // set header response code
    http_response_code(404);
    echo "<h1>404 Page Not Found!</h1>";
}


/* ---------------------------------------------------------------------------
------------------------------------------------------------------------------ */


// UPDATING DATA

if(isset($_POST['cname']) && isset($_POST['cabout'])){
    
    // check username and email empty or not
    if(!empty($_POST['cname']) && !empty($_POST['cabout'])){
        
        // Escape special characters.
        $cname = mysqli_real_escape_string($conn, htmlspecialchars($_POST['cname']));
        $cabout = mysqli_real_escape_string($conn, htmlspecialchars($_POST['cabout']));
        
        //CHECK EMAIL IS VALID OR NOT
        //if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $user_id = $_GET['id'];
            // CHECK IF EMAIL IS ALREADY INSERTED OR NOT
            $check_cname = mysqli_query($conn, "SELECT `cname` FROM `courses` WHERE cname = '$cname' AND id != '$user_id'");
            
            if(mysqli_num_rows($check_cname) > 0){    
                
                echo "<h3>This Course name is already registered. Please Try another.</h3>";
            }else{
                
                // UPDATE USER DATA               
                $update_query = mysqli_query($conn,"UPDATE `courses` SET cname='$cname',cabout='$cabout' WHERE id=$user_id");

                //CHECK DATA UPDATED OR NOT
                if($update_query){
                    echo "<script>
                    alert('Data Updated');
                    window.location.href = 'view_courses.php';
                    </script>";
                    exit;
                }else{
                    echo "<h3>Opps something wrong!</h3>";
                }
            }
        //}else{
        //    echo "Invalid email address. Please enter a valid email address";
        //}
        
    }else{
        echo "<h4>Please fill all fields</h4>";
    }   
}

// END OF UPDATING DATA

?>
