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
       <div class="page-header">
              <h1>View Courses</h1>
           </div>
           <?php
           include 'config/database.php';

           $action = isset($_GET['action']) ? $_GET['action']: "";
           if($action == 'deleted'){
             echo "<div class='alert alert-success'>Record was deleted</div>";
           }
           ?>
       <?php  
           
            $db = mysqli_connect('localhost', 'root', 'sark', 'side_crud');

            $query = "SELECT id, cname, cabout FROM courses ORDER BY id DESC";
            $result = mysqli_query($db,$query);

            $rows = mysqli_num_rows($result);

            echo "<a href='add_course.php' class='btn btn-primary m-b-1em'>Create new Course</a>";

            if($rows > 0){
                echo "<table class='table table-hover table-responsive table-bordered'>";
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Course Name</th>";
                    echo "<th>Course Description</th>";
                    echo "<th>Action</th>";
                    echo "</tr>";
                    //if(mysqli_num_rows($result) > 0){
                      while($row = mysqli_fetch_assoc($result)){
                          echo "<tr>";
                          echo "<td>". $row['id']."</td>";
                          echo "<td>". $row['cname']."</td>";
                          echo "<td>". $row['cabout']."</td>";
                          echo "<td>";

                          //<a href="update.php?id='.$row['id'].'">Edit</a> |
                          //<a href="delete.php?id='.$row['id'].'">Delete</a>
                          echo '<a href="update.php?id='.$row['id'].'">Edit</a> |<a href="delete.php?id='.$row['id'].'">Delete</a>';
                          echo "</td>";
                           echo "</tr>";
                }
           /// }
                echo "</table>";
            }else{
                echo "<div class='alert alert-danger'>No records found.</div>";
            }

            
        ?> 
       

       </div>

       <script src="js/jquery-2.0.0.min.js"></script>
       <script src="js/bootstrap.js"></script>

      
</body>
</html>