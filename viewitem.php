<?php
include "../config/database.php";

$result = mysqli_query(
    $conn,
    "SELECT * FROM inventory ORDER BY id DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory List</title>
</head>
<body>

<h2>Inventory Management</h2>

<a href="add_item.php">Add New Item</a>

<br><br>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Item Name</th>
    <th>Category</th>
    <th>Quantity</th>
    <th>Condition</th>
    <th>Date Added</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

    <td><?= $row['id']; ?></td>
    <td><?= $row['item_name']; ?></td>
    <td><?= $row['category']; ?></td>
    <td><?= $row['quantity']; ?></td>
    <td><?= $row['item_condition']; ?></td>
    <td><?= $row['date_added']; ?></td>

    <td>
        <a href="edit_item.php?id=<?= $row['id']; ?>">
            Edit
        </a>

        |

        <a href="delete_item.php?id=<?= $row['id']; ?>"
           onclick="return confirm('Delete this item?')">
            Delete
        </a>
    </td>

</tr>

<?php } ?>

</table>

</body>
</html>
