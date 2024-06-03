<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INPT Mobile Track</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
      body{
    background-color: #c9d6ff;
    background:linear-gradient(to bottom ,#fff,#68D2E8);
} 
.card{
    background:#fff;
    margin:50px auto;
    border-radius:10px;
    box-shadow:0 20px 35px rgba(0,0,1,0.5);
}
.card-title{
    font-family:Montserrat;
   
    font-weight: bold;
    font-size: 24px; 
}
.card-text1{
    font-style: italic;
}
.card-text2{
    font-size: 18px; /* Ajustez la taille de la police selon vos préférences */
    color: #666; /* Couleur du texte */
}
.promotion-text {
            font-weight: bold;
            color: #FF69B4;
            text-shadow: 0 0 10px #FF69B4;
        }
.card:hover {
    transform: translateY(-10px);
    transition:50ms;
}     
    </style>
</head>
<body>
<?php include 'connect2.php'; ?>
<?php include 'header.php'; ?>

<div class="container">
    <h1 class="text-center text-primary my-5">Welcome to INPT Mobile Track</h1>
    <h2 class="text-center text-success mb-4">Choose Your Bicycle <i class="fas fa-bicycle" style="color: #34D399;"></i></h2>
    
    <div class="row">
<?php
$sql = "
    SELECT b.*, 
           IFNULL(AVG(r.rating), 0) AS avg_rating, 
           p.title as promotion_title, 
           p.discount as promotion_discount 
    FROM bikes b 
    LEFT JOIN ratings r ON b.id = r.bike_id 
    LEFT JOIN promotion p ON b.id = p.category_id 
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
        // Continue processing the results as needed
        ?>
        <!-- Your HTML/PHP code to display the data -->
    

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img class="card-img-top" src="<?php echo $category_image; ?>" alt="Bike Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $category_name; ?></h5>
                            <p class="card-text1"><?php echo substr($category_desc, 0, 50) . '...'; ?></p>
                            <p class="card-text2">Price: <?php echo $category_price; ?>MAD</p>
                            <p class="card-text">Average Rating: <?php echo $avg_rating; ?> <i class="fas fa-star" style="color: #f39c12;"></i></p>
                            <?php if (!is_null($promotion_title)) { ?>
                                    <p class="promotion-text"><?php echo $promotion_title . " - " . $promotion_discount . "% off"; ?></p>
                                <?php } ?>
                            <a href="details.php?details_id=<?php echo $category_id; ?>" class="btn btn-primary">Details</a>
                            <div class="star-rating mt-3">
                                <input type="radio" id="5-stars-<?php echo $category_id; ?>" name="rating-<?php echo $category_id; ?>" value="5" />
                                <label for="5-stars-<?php echo $category_id; ?>" class="star">&#9733;</label>
                                <input type="radio" id="4-stars-<?php echo $category_id; ?>" name="rating-<?php echo $category_id; ?>" value="4" />
                                <label for="4-stars-<?php echo $category_id; ?>" class="star">&#9733;</label>
                                <input type="radio" id="3-stars-<?php echo $category_id; ?>" name="rating-<?php echo $category_id; ?>" value="3" />
                                <label for="3-stars-<?php echo $category_id; ?>" class="star">&#9733;</label>
                                <input type="radio" id="2-stars-<?php echo $category_id; ?>" name="rating-<?php echo $category_id; ?>" value="2" />
                                <label for="2-stars-<?php echo $category_id; ?>" class="star">&#9733;</label>
                                <input type="radio" id="1-star-<?php echo $category_id; ?>" name="rating-<?php echo $category_id; ?>" value="1" />
                                <label for="1-star-<?php echo $category_id; ?>" class="star">&#9733;</label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('.star-rating input[type="radio"]').on('change', function() {
            var bikeId = $(this).attr('name').split('-')[1];
            var rating = $(this).val();
            $.ajax({
                url: 'rate_bike.php',
                type: 'POST',
                data: { bike_id: bikeId, rating: rating },
                success: function(response) {
                    alert('Rating saved successfully!');
                    location.reload();
                },
                error: function() {
                    alert('An error occurred while saving the rating.');
                }
            });
        });
    });
</script>
</body>
</html>
