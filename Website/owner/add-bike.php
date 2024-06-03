<?php
session_start();
include '../connect2.php';
include '../connect.php';

$owner_email = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $_POST['category_name'];
    $category_desc = $_POST['category_desc'];
    $category_price = $_POST['category_price'];
    $gender = $_POST['genre'];
    $type = $_POST['type'];
    echo $gender ;


    if(isset($_FILES["fileToUpload"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        
       

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $category_image = $target_file;
                echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file was uploaded.";
    }

    $sql1 = "SELECT `nom_complet` FROM `owners` WHERE email = '$owner_email'";
    $result = mysqli_query($conn, $sql1);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $nom_complet = $row['nom_complet'];
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    $sql2 = "SELECT `télephone` FROM `owners` WHERE email = '$owner_email'";
    $result2 = mysqli_query($conn, $sql2);
    if ($result2) {
        while ($row = mysqli_fetch_assoc($result2)) {
            $phone = $row['télephone'];
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    $sql = "INSERT INTO `bikes`( `name`, `description`, `prix`, `image`, `propriétaire`, `téléphone`, `genre`, `type`)
            VALUES ('$category_name', '$category_desc', '$category_price','./owner/$category_image', '$nom_complet', '$phone','$gender','$type')";
    
    if (mysqli_query($con, $sql)) {
        echo "Bike added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Bike</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="my-4">Add Bike</h2>
    <form method="POST" action="add-bike.php">
        <div class="form-group">
            <label for="category_name">Bike Name</label>
            <input type="text" class="form-control" id="category_name" name="category_name" required>
        </div>
        <div class="form-group">
            <label for="category_desc">Description</label>
            <textarea class="form-control" id="category_desc" name="category_desc" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="category_price">Price</label>
            <input type="number" class="form-control" id="category_price" name="category_price" required>
        </div>
        <div class="form-group">
            <label for="category_image">Image URL</label>
            <input type="text" class="form-control" id="category_image" name="category_image" required>
        </div>
        <button type="submit" class="btn btn-success">Add Bike</button>
    </form>
</div>
<?php include '../footer.php'; ?>
</body>
</html>