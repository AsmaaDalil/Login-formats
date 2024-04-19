<?php
session_start();
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 
    if (!empty($_SESSION)) {
        if ($_POST['username'] == $_SESSION['username'] && $_POST['password'] == $_SESSION['password']) {
          
            header('Location: dashboard.php');
            exit();
        } else {
    
            $error = "Invalid username or password. Please try again.";
        }
    } 
    
    else {
        $error = "Please signup again";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
        background-color: #f0f0f0; 
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
    }

    .form-container {
        max-width: 400px;
        margin: 50px auto;
        padding: 30px;
        border-radius: 15px;
        background-color: #ffffff; 
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1); 
        border: 2px solid #ff66a3; 
        border-radius: 10px;
    }

    .btn-custom {
        background-color: #ff66a3;
        border-color: #ff66a3; 
        border-radius: 15px;
    }

    .btn-custom:hover {
        background-color: #ff4d94; 
        border-color: #ff4d94; 
    }

    .btn-custom:focus {
        box-shadow: 0 0 0 0.2rem rgba(255, 102, 163, 0.5); 
    }

    .form-control {
        border-radius: 10px;
        border-color: #dddddd;
    }

    .form-control:focus {
        border-color: #ff66a3; 
        box-shadow: 0 0 0 0.2rem rgba(255, 102, 163, 0.25); 
    }

    .error {
        color: red;
    }
</style>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-container">
                <h2 class="text-center mb-4" style="color: #ff66a3;">login Form</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <?php if (!empty($error)) : ?>
                        <div class="alert alert-danger error" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-custom btn-block">login </button><br>
          <center>  <H6> If You Don't have an account? <a href="index.php" style="color: #ff66a3;">sign Up<b></b></a></H6> </center> 
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
