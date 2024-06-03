<?php
include '../connect2.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $promo_id = $_POST['promo_id'];
    
    $sql = "DELETE FROM promotion WHERE id = $promo_id";
    
    if (mysqli_query($con, $sql)) {
        echo "discount deleted successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
