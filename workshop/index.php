<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_workshop'])) {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $price = $_POST['price'];
    $instructor_name = $_POST['instructor_name'];

 

    $sql = "INSERT INTO workshops (name, date, time, price, instructor_name) 
            VALUES ('$name', '$date', '$time', '$price', '$instructor_name')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


$sql = "SELECT * FROM workshops";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Workshop Management System</title>
</head>
<body>
    <h1>Workshops</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Price</th>
            <th>Instructor Name</th>
            <th>Actions</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['date']."</td>";
            echo "<td>".$row['time']."</td>";
            echo "<td>".$row['price']."</td>";
            echo "<td>".$row['instructor_name']."</td>";
            echo "<td><a href='edit.php?id=".$row['id']."'>Edit</a> | <a href='delete.php?id=".$row['id']."'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h2>Add New Workshop</h2>
    <form method="POST" action="">
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Date:</label>
        <input type="date" name="date" min="<?php echo date('Y-m-d'); ?>" required><br>
        <label>Time:</label>
        <input type="time" name="time" min="<?php echo date('H:i'); ?>" required><br>
        <label>Price:</label>
        <input type="number" step="0.01" name="price" required><br>
        <label>Instructor Name:</label>
        <input type="text" name="instructor_name" required><br>
        <input type="submit" name="add_workshop" value="Add Workshop">
    </form>
</body>
</html>