<!DOCTYPE html>
<?php

$course_name = "";
$course_desc   = "";

$errors = array(); 

$db = mysqli_connect('localhost', 'root', 'sark', 'side_crud');

if(isset($_POST['submit'])){
    $cname = mysqli_real_escape_string($db, $_POST['cname']);
    $cabout = mysqli_real_escape_string($db, $_POST['cabout']);
    

    if (empty($cname)) { array_push($errors, "Course name is required"); }
    if (empty($cabout)) { array_push($errors, "About course is required"); }

    $course_check_query = "SELECT * FROM courses WHERE cname='$cname' OR cabout='$cabout' LIMIT 1";
    $result = mysqli_query($db, $course_check_query);
    $course = mysqli_fetch_assoc($result);

    if ($course) { 
        if ($course['cname'] === $cname) {
          array_push($errors, "Course already exists");
        }
      }

      if (count($errors) == 0) {
        $query = "INSERT INTO courses (cname, cabout)VALUES('$cname', '$cabout')";
        mysqli_query($db, $query);
        header('location:view_courses.php');
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
    <label for="exampleInputCourses">Course Name</label>
    <input type="text" class="form-control" id="cname"  name="cname" placeholder="Enter Course Name">
  </div>

    <div class="form-group">
    <label for="exampleInputEmail1">About Course</label>
    <textarea class="form-control" name="cabout" id="cabout" cols="30" rows="10"></textarea>
    
  </div>


  <button type="submit" class="btn btn-primary" name="submit">Create Course</button>

           </form>
           
       </div>

       <script src="js/jquery-2.0.0.min.js"></script>
       <script src="js/bootstrap.js"></script>
</body>
</html>