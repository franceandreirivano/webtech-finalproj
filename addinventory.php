<?php
include 'config.php';

$message = "";

if(isset($_POST['add'])){

    $item_name = $_POST['item_name'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $condition = $_POST['condition'];
    $date_added = $_POST['date_added'];

    $sql = "INSERT INTO inventory
            (item_name,category,quantity,item_condition,date_added)
            VALUES
            ('$item_name','$category','$quantity','$condition','$date_added')";

    if(mysqli_query($conn,$sql)){
        $message = "Item Added Successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Inventory</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
        }

        /* SIDEBAR FIX */
        .sidebar{
            width:250px;
            height:100vh;
            position:fixed;
            background:#1f2937;
            color:white;

            display:flex;
            flex-direction:column;

            padding-top:20px;
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
            max-width:700px;
            border:none;
            border-radius:15px;
            box-shadow:0 2px 10px rgba(0,0,0,.1);
        }

        /* push logout to bottom */
        .logout{
            margin-top:auto;
        }
    </style>
</head>

<body>

<div class="sidebar">

    <h3 class="text-center mt-3">📦 ACES IMS</h3>
    <hr>

    <a href="dashboard.php">📊 Dashboard</a>
    <a href="viewinventory.php">📦 Products</a>
    <a href="addinventory.php">➕ Add Product</a>
    <a href="search.php">🔍 Search</a>
    <a href="logout.php">🚪 Logout</a>
   
    <div class="logout">
        <a href="logout.php">🚪 Logout</a>
    </div>

</div>

<div class="content">

    <div class="card card-form p-4">

        <h3>Add New Product</h3>

        <?php if($message){ ?>
            <div class="alert alert-success">
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <form method="POST">

            <div class="mb-3">
                <label>Item Name</label>
                <input type="text" name="item_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Category</label>
                <input type="text" name="category" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Quantity</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Condition</label>
                <select name="condition" class="form-control">
                    <option>New</option>
                    <option>Good</option>
                    <option>Used</option>
                    <option>Damaged</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Date Added</label>
                <input type="date" name="date_added" class="form-control" required>
            </div>

            <button type="submit" name="add" class="btn btn-primary">
                Add Product
            </button>

        </form>

    </div>

</div>

</body>
</html>
