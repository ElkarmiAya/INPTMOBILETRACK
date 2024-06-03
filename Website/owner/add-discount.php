<?php
include '../connect2.php';
include '../header.php';

if (!isset($_SESSION['email'])) {
    header("Location: login_owner.php");
    exit();
}

$bike_id = isset($_GET['bike_id']) ? $_GET['bike_id'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $discount = $_POST['discount'];
    $bike_id = $_POST['bike_id'];

    $sql = "INSERT INTO promotion (category_id, title, discount) VALUES ('$bike_id', '$title', '$discount')";
    if (mysqli_query($con, $sql)) {
        echo "Promotion added successfully!";
        header("Location: success.php");
    
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Discount</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h3 class="mt-5">Add Promotion</h3>
        <form method="POST" action="add-discount.php">
            <input type="hidden" name="bike_id" value="<?php echo $bike_id; ?>">
            <div class="form-group">
                <label for="title">Promotion Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="discount">Discount (%)</label>
                <input type="number" class="form-control" id="discount" name="discount" required>
            </div>
            <button type="submit" onclick="window.location.href='ownerhomepage.php'"class="btn btn-primary">Add Promotion</button>
        </form>
    </div>
</body>
</html>
