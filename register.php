<?php
session_start();
include 'config.php';

$error = "";

if(isset($_POST['register'])){

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(fullname,email,password)
            VALUES('$fullname','$email','$password')";

    if(mysqli_query($conn,$sql)){

        $_SESSION['success'] = "Registration successful! You can now login.";

        header("Location: login.php");
        exit();

    } else {
        $error = mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(135deg,#1e3c72,#2a5298);
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .register-card{
            width:450px;
            border:none;
            border-radius:20px;
            box-shadow:0 15px 30px rgba(0,0,0,.2);
        }

        .logo{
            font-size:60px;
        }
    </style>
</head>

<body>

<div class="card register-card p-4">

    <div class="text-center">
        <div class="logo">📦</div>
        <h2>Create Account</h2>
        <p class="text-muted">Inventory Management System</p>
    </div>

    <!-- ERROR MESSAGE -->
    <?php if(!empty($error)){ ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <div class="mb-3">
            <label>Full Name</label>
            <input type="text" name="fullname" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" name="register" class="btn btn-success w-100">
            Register
        </button>

    </form>

    <hr>

    <div class="text-center">
        Already have an account?
        <a href="login.php">Login</a>
    </div>

</div>

</body>
</html>
