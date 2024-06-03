<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INPT Mobile Track</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #c9d6ff;
            background: linear-gradient(to bottom, #fff, #68D2E8);
        }
        .card {
            background: #fff;
            margin: 50px auto;
            border-radius: 10px;
            box-shadow: 0 20px 35px rgba(0,0,1,0.5);
        }
        .card-title {
            font-family: Montserrat;
            font-weight: bold;
            font-size: 24px;
        }
        .card-text1 {
            font-style: italic;
        }
        .card-text2 {
            font-size: 18px;
            color: #666;
        }
        .promotion-text {
            font-weight: bold;
            color: #FF69B4;
            text-shadow: 0 0 10px #FF69B4;
        }
        .card:hover {
            transform: translateY(-10px);
            transition: 50ms;
        }
    </style>
</head>
<body>
<?php include '../connect2.php'; ?>
<?php include 'owner_header.php'; ?>
<?php include '../connect.php'; ?>

<div class="container">
    <h1 class="text-center text-primary my-5">Welcome to INPT Mobile Track</h1>
    <h2 class="text-center text-success mb-4">these are your Bicycles <i class="fas fa-bicycle" style="color: #34D399;"></i></h2>
    <div class="container">
        <h1>Welcome, Owner!</h1>
        <a href="received_message.php" class="btn btn-info">View Received Messages</a>
        <a href="../firstpage.php" class="btn btn-info">Déconnexion</a>
        <a href="discount-bikes.php" class="btn btn-info">Add bike</a>
    </div>
    <div class="row">
        <?php
        $owner_email = $_SESSION['email'];
        $sql2 = "SELECT `télephone` FROM `owners` WHERE email = '$owner_email'";
        $result2 = mysqli_query($conn, $sql2);
        if ($result2) {
            while ($row = mysqli_fetch_assoc($result2)) {
                $phone = $row['télephone'];
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        $sql = "
            SELECT b.*, 
                   IFNULL(AVG(r.rating), 0) AS avg_rating, 
                   p.title as promotion_title, 
                   p.discount as promotion_discount ,
                   p.id as pid
            FROM bikes b 
            LEFT JOIN ratings r ON b.id = r.bike_id 
            LEFT JOIN promotion p ON b.id = p.category_id
            WHERE b.téléphone = $phone 
            GROUP BY b.id
        ";
        $result = mysqli_query($con, $sql);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $category_id = $row['id'];
                $category_name = $row['name'];
                $category_desc = $row['description'];
                $category_price = $row['prix'];
                $category_image = $row['image'];
                $avg_rating = round($row['avg_rating'], 1);
                $promotion_title = $row['promotion_title'];
                $promotion_discount = $row['promotion_discount'];
                $promoId=$row['pid'];
        ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $category_name; ?></h5>
                            <p class="card-text1"><?php echo substr($category_desc, 0, 50) . '...'; ?></p>
                            <p class="card-text2">Price: <?php echo $category_price; ?>MAD</p>
                            <p class="card-text">Average Rating: <?php echo $avg_rating; ?> <i class="fas fa-star" style="color: #f39c12;"></i></p>
                            <?php if (!is_null($promotion_title)) { ?>
                                <p class="promotion-text"><?php echo $promotion_title . " - " . $promotion_discount . "% off"; ?></p>
                            <?php } ?>
                            <button class="btn btn-danger delete-bike" data-bike-id="<?php echo $category_id; ?>">Delete</button>
                            <button class="btn btn-danger delete-promo" data-promo_id="<?php echo $promoId; ?>">Delete Discount</button>
                            
                            <button style="margin-top:20px;" class="btn btn-primary add-discount" data-bike_id="<?php echo $category_id; ?>">Add Discount</button>
                            
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-promo').on('click', function() {
            var promoid = $(this).data('promo_id');
            
            if (confirm('Are you sure you want to delete this discount?')) {
                $.ajax({
                    url: 'delete_discount.php',
                    type: 'POST',
                    data: { promo_id: promoid },
                    success: function(response) {
                        alert(response);
                        location.reload();
                    },
                    error: function() {
                        alert('An error occurred while deleting the discount.');
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.delete-bike').on('click', function() {
            var bikeId = $(this).data('bike-id');
            
            if (confirm('Are you sure you want to delete this bike?')) {
                $.ajax({
                    url: 'delete_bike.php',
                    type: 'POST',
                    data: { bike_id: bikeId },
                    success: function(response) {
                        alert(response);
                        location.reload();
                    },
                    error: function() {
                        alert('An error occurred while deleting the bike.');
                    }
                });
            }
        });
    $('.add-discount').on('click', function() {
        var bikeId = $(this).data('bike_id');
        window.location.href = 'add-discount.php?bike_id=' + bikeId;
    });    
        
    });
</script>
</body>
</html>
