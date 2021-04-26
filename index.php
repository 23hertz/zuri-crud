<!DOCTYPE html>
<?php
session_start();

$username = "";
$password = "";

$errors = array(); 

$db = mysqli_connect('localhost', 'root', 'sark', 'side_crud');


if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }

    if (count($errors) == 0) {
        //$password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND pword='$password'";
        $results = mysqli_query($db, $query);

          if (mysqli_num_rows($results) == 1) {
           $_SESSION['username'] = $username;
           $_SESSION['id'] = $id;
          $_SESSION['success'] = "You are now logged in";
          header('location: homepage.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }


  }
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="style/custom.css">
</head>
       <div class="container">

     
           <form  method="post">
           <?php include('errors.php'); ?>
           <div class="form-group">
            <label for="exampleInputUsername">Username</label>
            <input type="text" class="form-control" id="exampleInputUserbane"  name="username" placeholder="Enter Username">
           </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
            </div>

             <button type="submit" class="btn btn-primary" name="submit">Submit</button>

             <p>Not yet a member? <a href="register.php">Sign up</a></p>
           </form>

           
       </div>

       <script src="js/jquery-2.0.0.min.js"></script>
       <script src="js/bootstrap.js"></script>
</body>
</html>