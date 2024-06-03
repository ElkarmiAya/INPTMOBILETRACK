<?php
include '../connect2.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bike_id = $_POST['bike_id'];
    
    $sql = "DELETE FROM bikes WHERE id = $bike_id";
    
    if (mysqli_query($con, $sql)) {
        echo "Bike deleted successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
