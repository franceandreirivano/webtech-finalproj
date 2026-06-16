<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id']) || empty($_GET['id'])){
    header("Location: viewinventory.php");
    exit();
}

$id = (int) $_GET['id']; // SAFE CAST

if(isset($_POST['confirm_delete'])){

    mysqli_query($conn, "DELETE FROM inventory WHERE id=$id");

    header("Location: viewinventory.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card p-4 shadow text-center">

        <h3>⚠️ Are you sure you want to delete this item?</h3>

        <form method="POST">

            <button class="btn btn-danger mt-3" name="confirm_delete">
                Yes, Delete
            </button>

            <a href="viewinventory.php" class="btn btn-secondary mt-3">
                Cancel
            </a>

        </form>

    </div>

</div>

</body>
</html>
