<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_workshop'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $price = $_POST['price'];
    $instructor_name = $_POST['instructor_name'];



    $sql = "UPDATE workshops SET 
            name='$name', date='$date', time='$time', price='$price', instructor_name='$instructor_name' 
            WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM workshops WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Workshop not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Workshop</title>
</head>
<body>
    <h1>Edit Workshop</h1>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
        <label>Date:</label>
        <input type="date" name="date" value="<?php echo $row['date']; ?>" min="<?php echo date('Y-m-d'); ?>" required><br>
        <label>Time:</label>
        <input type="time" name="time" value="<?php echo $row['time']; ?>" min="<?php echo date('H:i'); ?>" required><br>
        <label>Price:</label>
        <input type="number" step="0.01" name="price" value="<?php echo $row['price']; ?>" required><br>
        <label>Instructor Name:</label>
        <input type="text" name="instructor_name" value="<?php echo $row['instructor_name']; ?>" required><br>
        <input type="submit" name="edit_workshop" value="Update Workshop">
    </form>
</body>
</html>