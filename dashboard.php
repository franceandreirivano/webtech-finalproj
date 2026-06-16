<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

// Total items
$totalQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM inventory");
$totalRow = mysqli_fetch_assoc($totalQuery);

// Total quantity
$stockQuery = mysqli_query($conn, "SELECT SUM(quantity) as total_stock FROM inventory");
$stockRow = mysqli_fetch_assoc($stockQuery);

// Recent items
$recentQuery = mysqli_query($conn, "SELECT * FROM inventory ORDER BY id DESC LIMIT 5");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
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
            padding-top:20px;
        }

        .sidebar a{
            display:block;
            color:white;
            text-decoration:none;
            padding:15px 25px;
        }

        .sidebar a:hover{
            background:#374151;
        }

        .content{
            margin-left:250px;
            padding:30px;
        }

        .card-box{
            border:none;
            border-radius:15px;
            box-shadow:0 2px 10px rgba(0,0,0,.1);
        }
    </style>
</head>

<body>

<div class="sidebar">

    <h3 class="text-center">📦 ACES IMS</h3>
    <hr>

    <a href="dashboard.php">📊 Dashboard</a>
    <a href="viewinventory.php">📦 Products</a>
    <a href="addinventory.php">➕ Add Product</a>
    <a href="search.php">🔍 Search</a>
    <a href="logout.php">🚪 Logout</a>

</div>

<div class="content">

    <h2>Dashboard</h2>
    <p>Welcome, <?php echo $_SESSION['fullname']; ?> 👋</p>

    <div class="row">

        <div class="col-md-4">
            <div class="card card-box p-3">
                <h5>Total Products</h5>
                <h2><?= $totalRow['total']; ?></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-box p-3">
                <h5>Total Quantity</h5>
                <h2><?= $stockRow['total_stock']; ?></h2>
            </div>
        </div>

    </div>

    <br>

    <div class="card card-box p-3">

        <h5>Recent Items</h5>

        <table class="table table-striped mt-2">

            <tr>
                <th>Item Name</th>
                <th>Category</th>
                <th>Qty</th>
                <th>Condition</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($recentQuery)){ ?>

            <tr>
                <td><?= $row['item_name']; ?></td>
                <td><?= $row['category']; ?></td>
                <td><?= $row['quantity']; ?></td>
                <td><?= $row['item_condition']; ?></td>
            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>
