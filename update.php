<?php
session_start();
include 'config.php';

/* 🔒 LOGIN CHECK */
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

/* 🔒 VALIDATE ID */
if(!isset($_GET['id']) || empty($_GET['id'])){
    header("Location: viewinventory.php");
    exit();
}

$id = (int) $_GET['id'];

/* GET ITEM */
$query = mysqli_query($conn, "SELECT * FROM inventory WHERE id=$id");
$item = mysqli_fetch_assoc($query);

/* IF NOT FOUND */
if(!$item){
    header("Location: viewinventory.php");
    exit();
}

/* UPDATE */
if(isset($_POST['update'])){

    $item_name = $_POST['item_name'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $condition = $_POST['condition'];

    $sql = "UPDATE inventory SET
            item_name='$item_name',
            category='$category',
            quantity='$quantity',
            item_condition='$condition'
            WHERE id=$id";

    if(mysqli_query($conn,$sql)){
        header("Location: viewinventory.php");
        exit();
    } else {
        $message = "Update failed!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Inventory Item</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
        }

        .sidebar{
            width:250px;
            height:100vh;
            position:fixed;
            background:#1f2937;
            color:white;
        }

        .sidebar a{
            display:block;
            color:white;
            padding:15px 25px;
            text-decoration:none;
        }

        .sidebar a:hover{
            background:#374151;
        }

        .content{
            margin-left:250px;
            padding:30px;
        }

        .card-form{
            max-width:600px;
            border:none;
            border-radius:15px;
            box-shadow:0 2px 10px rgba(0,0,0,.1);
        }
    </style>
</head>

<body>

<div class="sidebar">

    <h3 class="text-center mt-3">📦 IMS</h3>
    <hr>

    <a href="dashboard.php">📊 Dashboard</a>
    <a href="viewinventory.php">📦 Products</a>
    <a href="addinventory.php">➕ Add Product</a>
    <a href="search.php">🔍 Search</a>
    <a href="logout.php">🚪 Logout</a>

</div>

<div class="content">

    <div class="card card-form p-4">

        <h3>Edit Inventory Item</h3>

        <?php if(!empty($message)){ ?>
            <div class="alert alert-danger">
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <form method="POST">

            <div class="mb-3">
                <label>Item Name</label>
                <input type="text" name="item_name"
                       class="form-control"
                       value="<?= $item['item_name']; ?>" required>
            </div>

            <div class="mb-3">
                <label>Category</label>
                <input type="text" name="category"
                       class="form-control"
                       value="<?= $item['category']; ?>" required>
            </div>

            <div class="mb-3">
                <label>Quantity</label>
                <input type="number" name="quantity"
                       class="form-control"
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

            <button type="submit" name="update"
                    class="btn btn-warning w-100">
                Update Item
            </button>

        </form>

    </div>

</div>

</body>
</html>
