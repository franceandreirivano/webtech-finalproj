<?php
include 'config.php';

$result = mysqli_query($conn, "SELECT * FROM inventory ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory Dashboard</title>

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

    <h3 class="text-center">📦 IMS</h3>
    <hr>

    <a href="dashboard.php">📊 Dashboard</a>
    <a href="viewinventory.php">📦 Products</a>
    <a href="addinventory.php">➕ Add Product</a>
    <a href="search.php">🔍 Search</a>
    <a href="logout.php">🚪 Logout</a>

</div>

<div class="content">

    <h2>Inventory Products</h2>

    <div class="table-container">

        <div class="d-flex justify-content-between mb-3">
            <h4>Products</h4>

            <a href="addinventory.php" class="btn btn-primary">
                Add Product
            </a>
        </div>

        <table class="table table-hover">

            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Condition</th>
                    <th>Date Added</th>
                    <th>Action</th>
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

                    <!-- ✅ ACTION BUTTONS (EDIT + DELETE) -->
                    <td>
                        <a href="editinventory.php?id=<?= $row['id']; ?>"
                           class="btn btn-warning btn-sm me-1">
                            Edit
                        </a>

                        <a href="delete.php?id=<?= $row['id']; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Delete this item?')">
                            Delete
                        </a>
                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>
