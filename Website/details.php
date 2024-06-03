<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INPT Mobile Track</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <style>
        .jumbotron {
            background-color:#68D2E8;
            padding: 2rem 1rem;
            margin-bottom: 2rem;
        }
        .product-info {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
      
        .product-info img {
            max-width: 100%;
            height: auto;
        }
        .price {
          font-size: 20px; /* Ajustez la taille de la police selon vos préférences */
          color: #FFC55A; /* Couleur du texte */
        }
        .contact-info {
            color: #666;
            
            margin-top: 1rem;
        }
        .cat_name{
          font-family:Montserrat;
          color: #0561A2;
          font-weight: bold;
          font-size: 40px; 
        }
        .desc{
          font-style: italic;
        }
        .cat_name2{
          font-weight: bold;
          font-size: 35px; 
          font-family:Montserrat;
          color: #0561A2;
        }
    </style>
</head>
<body>
    <?php include 'connect2.php'; ?>
    <?php include 'header.php'; ?>
    
    <?php
    $id = $_GET['details_id'];
    $sql = "SELECT * FROM `bikes` WHERE id=$id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $category_name = $row['name'];
    $category_desc = $row['description'];
    $category_price = $row['prix'];
    $category_image = $row['image'];
    $category_proprietaire = $row['propriétaire'];
    $category_tel = $row['téléphone'];
    ?>

    <div class="jumbotron">
        <div class="container">
            <h1 class="cat_name"><?php echo $category_name ?> </h1>
            <p class="lead"><?php echo $category_desc ?></p>
            <a href="homepage.php" class="btn btn-dark">Continue Shopping</a>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <img src="<?php echo $category_image ?>" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 col-sm-12 product-info">
                <h2 class="cat_name2"><?php echo $category_name ?></h2>
                <p class="desc"><?php echo $category_desc ?></p>
                <p class="price">Price: <?php echo $category_price ?>MAD</p>
                <p class="contact-info">Propriétaire:<br><?php echo $category_proprietaire ?></p>
                <p class="contact-info">Contacter le propriétaire:<br>0<?php echo $category_tel ?></p>
                
                <button class="btn btn-success" onclick="window.location.href='sendingmsg.php?owner_phone=<?php echo $category_tel; ?>'">Message au Propriétaire</button>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
