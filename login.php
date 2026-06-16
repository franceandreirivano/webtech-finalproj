<?php
session_start();
include 'config.php';

$error = "";
$message = "";

/* SUCCESS MESSAGE FROM REGISTER */
if(isset($_SESSION['success'])){
    $message = $_SESSION['success'];
    unset($_SESSION['success']);
}

/* LOGIN PROCESS */
if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn,
        "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($query) > 0){

        $user = mysqli_fetch_assoc($query);

        if(password_verify($password, $user['password'])){

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];

            header("Location: dashboard.php");
            exit();

        } else {
            $error = "Invalid Password!";
        }

    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory System Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(135deg,#1e3c72,#2a5298);
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .login-card{
            width:420px;
            border:none;
            border-radius:20px;
            box-shadow:0 15px 30px rgba(0,0,0,.2);
        }

        .logo{
            font-size:60px;
        }

        .btn-login{
            background:#0d6efd;
            border:none;
        }

        .btn-login:hover{
            background:#0b5ed7;
        }
    </style>
</head>

<body>

<div class="card login-card p-4">

    <div class="text-center">
        <div class="logo">📦</div>
        <h2>Inventory System</h2>
        <p class="text-muted">Login to continue</p>
    </div>

    <!-- SUCCESS MESSAGE -->
    <?php if($message){ ?>
        <div class="alert alert-success">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <!-- ERROR MESSAGE -->
    <?php if(!empty($error)){ ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" name="login" class="btn btn-primary btn-login w-100">
            Login
        </button>

    </form>

    <hr>

    <div class="text-center">
        Don't have an account?
        <a href="register.php">Register</a>
    </div>

</div>

</body>
</html>
