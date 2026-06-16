<?php
include 'config.php';

$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];

    $result = mysqli_query(
        $conn,
        "SELECT * FROM inventory
         WHERE item_name LIKE '%$search%'
         OR category LIKE '%$search%'
         ORDER BY id DESC"
    );
}
else{
    $result = mysqli_query(
        $conn,
        "SELECT * FROM inventory ORDER BY id DESC"
    );
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Inventory</title>

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

        .table-container{
            background:white;
            padding:20px;
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

    <h2>Search Inventory</h2>

    <!-- SEARCH BAR -->
    <form method="GET" class="mb-4">

        <div class="input-group">

            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Search by item name or category..."
                   value="<?= $search ?>">

            <button class="btn btn-primary">
                Search
            </button>

        </div>

    </form>

    <div class="table-container">

        <table class="table table-hover">

            <thead class="table-dark">

            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Condition</th>
                <th>Date Added</th>
            </tr>

            </thead>

            <tbody>

            <?php while($row = mysqli_fetch_assoc($result)){ ?>

            <tr>

                <td><?= $row['id']; ?></td>
                <td><?= $row['item_name']; ?></td>
                <td><?= $row['category']; ?></td>

                <td>
                    <span class="badge bg-success">
                        <?= $row['quantity']; ?>
                    </span>
                </td>

                <td><?= $row['item_condition']; ?></td>
                <td><?= $row['date_added']; ?></td>

            </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>
