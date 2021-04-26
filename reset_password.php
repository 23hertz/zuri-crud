<?php

session_start();

if (!(isset($_SESSION['username']) || $_SESSION['username'] == ''))
{
    header("location:index.php");
}

$dbcon = mysqli_connect('localhost', 'root', 'sark', 'side_crud') or die(mysqli_error($dbcon));

$password1 = mysqli_real_escape_string($dbcon, $_POST['newPassword']);
$username = mysqli_real_escape_string($dbcon, $_SESSION['username']);


$chg = mysqli_query($dbcon, "UPDATE users SET pword='$password1' WHERE username='$username'");
if($chg)
{
    echo "You have successfully changed your password.";
}
else
{
    mysqli_error($dbcon);
}
mysqli_close($dbcon);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="style/custom.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
          
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link ml-2" href="homepage.php">Cancel</a>
            </div>
        </form>

        </div>    
</body>
</html>