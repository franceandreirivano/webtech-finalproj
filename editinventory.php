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

$id = (int) $_GET['id'];

// GET DATA
$query = mysqli_query($conn, "SELECT * FROM inventory WHERE id=$id");
$item = mysqli_fetch_assoc($query);

// UPDATE DATA
if(isset($_POST['update'])){

    $item_name = $_POST['item_name'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $condition = $_POST['condition'];

    mysqli_query($conn, "UPDATE inventory SET
        item_name='$item_name',
        category='$category',
        quantity='$quantity',
        item_condition='$condition'
        WHERE id=$id
    ");

    header("Location: viewinventory.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card p-4 shadow">

        <h3>Edit Inventory Item</h3>

        <form method="POST">

            <div class="mb-3">
                <label>Item Name</label>
                <input type="text" name="item_name" class="form-control"
                       value="<?= $item['item_name']; ?>" required>
            </div>

            <div class="mb-3">
                <label>Category</label>
                <input type="text" name="category" class="form-control"
                       value="<?= $item['category']; ?>" required>
            </div>

            <div class="mb-3">
                <label>Quantity</label>
                <input type="number" name="quantity" class="form-control"
                       value="<?= $item['quantity']; ?>" required>
            </div>

            <div class="mb-3">
                <label>Condition</label>
                <select name="condition" class="form-control">

                    <option <?= ($item['item_condition']=="New")?"selected":"" ?>>New</option>
                    <option <?= ($item['item_condition']=="Good")?"selected":"" ?>>Good</option>
                    <option <?= ($item['item_condition']=="Used")?"selected":"" ?>>Used</option>
                    <option <?= ($item['item_condition']=="Damaged")?"selected":"" ?>>Damaged</option>

                </select>
            </div>

            <button type="submit" name="update" class="btn btn-warning w-100">
                Update Item
            </button>

            <a href="viewinventory.php" class="btn btn-secondary w-100 mt-2">
                Cancel
            </a>

        </form>

    </div>

</div>

</body>
</html>
