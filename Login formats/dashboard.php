<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

if (!isset($_SESSION['user_info'])) {
    $_SESSION['user_info'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    if (!empty($_POST['fullName']) && !empty($_POST['age']) && !empty($_FILES['image'])) {
        $fullName = $_POST['fullName'];
        $age = $_POST['age'];
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);

        
        if (!is_numeric($age)) {
            $error_message = "Age must be a number.";
        } 
        
        else {
         
            $_SESSION['user_info'] = array();


            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
              
                $_SESSION['user_info'][] = array(
                    'fullName' => $fullName,
                    'age' => $age,
                    'image' => $targetFile
                );
                header('Location: dashboard.php');
                exit();
            } else {
                $error_message = "Failed to upload image.";
            }
        }
    } else {
        $error_message = "Please fill all fields.";
    }
}

if (isset($_GET['logout'])) {
   
    unset($_SESSION['user_info']);
    session_destroy();
  
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
   body {
        background-color: #f0f0f0; 
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
    }

    .form-container {
        max-width: 600px;
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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand " href="#" style="color: #ff66a3;"><b>Dashboard</b></a>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
      <p><a href="?logout=true" class="btn btn-custom btn-block"><b>Logout</b></a></p>
      </li>
    </ul>
  </div>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-container">
                <h2 class="text-center mb-4" style="color: #ff66a3;">Dashboard</h2>
            <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
            <?php if (isset($error_message)) : ?>
                <div class="error"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <form action="dashboard.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" class="form-control" id="fullName" name="fullName" required>
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="text" class="form-control" id="age" name="age" required>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" id="image" name="image" required>
                </div><br>
                <button type="submit" class="btn btn-custom btn-block">Add Information</button>
            </form></div>
            <?php if (!empty($_SESSION['user_info'])) : ?>
                <h3 class="mt-5">User Information</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Age</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['user_info'] as $userInfo) : ?>
                            <tr>
                                <td><?php echo $userInfo['fullName']; ?></td>
                                <td><?php echo $userInfo['age']; ?></td>
                                <td><img src="<?php echo $userInfo['image']; ?>" alt="User Image" style="max-width: 100px;"></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
           
        </div>
    </div>
</div>
</body>
</html>
