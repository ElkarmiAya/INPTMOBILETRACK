<?php include 'connect2.php'; ?>
<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INPT Mobile Track - Filtered Results</title>
    <!--------bootstrap css link-------->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body{
            background-color: #c9d6ff;
            background:linear-gradient(to bottom ,#fff,#68D2E8); 
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            margin-bottom: 20px; /* Ajoutez un espace entre les cartes */
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card-title {
            font-size: 24px;
            font-weight: bold;
        }
        .card-text {
            font-size: 16px;
            color: #666;
        }
        .promotion-text {
            font-weight: bold;
            color: #FF69B4;
            text-shadow: 0 0 10px #FF69B4;
        }
        .header-title {
            font-size: 36px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        .sub-header {
            font-size: 28px;
            font-weight: bold;
            color: #34D399;
        }
    </style>
</head>
<body>

<h1 class="text-center text-primary my-3 header-title">Filtered Results</h1>
<h2 class="text-center text-success mb-4 sub-header">Choose yours <i class="fas fa-bicycle"></i></h2>

<div class="container">
    <div class="row">
        <!------------php code------------>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["apply_filters"])) {
            $price_filter = $_POST["price_filter"];
            $gender_filter = $_POST["gender_filter"];
            $type_filter = $_POST["type_filter"];

            $sql = "SELECT b.*, p.title as promotion_title, p.discount as promotion_discount 
                    FROM bikes b 
                    LEFT JOIN promotion p ON b.id = p.category_id
                    WHERE 1=1";

            if (!empty($price_filter) && $price_filter != "Filtrer par prix") {
                list($min_price, $max_price) = explode("-", $price_filter);
                $sql .= " AND b.prix BETWEEN $min_price AND $max_price";
            }

            if (!empty($gender_filter) && $gender_filter != "Filtrer par genre") {
                $sql .= " AND b.genre = '$gender_filter'";
            }

            if (!empty($type_filter) && $type_filter != "Filtrer par type") {
                $sql .= " AND b.type = '$type_filter'";
            }

            $result = mysqli_query($con, $sql);

            if (!$result) {
                die("Erreur SQL: " . mysqli_error($con));
            }

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $category_id = $row['id'];
                    $category_name = $row['name'];
                    $category_desc = $row['description'];
                    $category_price = $row['prix'];
                    $category_image = $row['image'];
                    $owner = $row['propriétaire'];
                    $promotion_title = $row['promotion_title'];
                    $promotion_discount = $row['promotion_discount'];
        ?>
                    <div class="col-12 mb-5">
                        <div class="card">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img class="card-img" src="<?php echo $category_image; ?>" alt="Card image cap" style="height: 300px; object-fit: contain;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $category_name; ?></h5>
                                        <p class="card-text"><?php echo substr($category_desc, 0, 50) . '...'; ?></p>
                                        <p class="card-text"><strong><?php echo $category_price; ?> MAD</strong></p>
                                        <?php if (!is_null($promotion_title)) { ?>
                                            <p class="promotion-text"><?php echo $promotion_title . " - " . $promotion_discount . "% off"; ?></p>
                                        <?php } ?>
                                        <div class="d-flex align-items-center">
                                            <a href="details.php?details_id=<?php echo $category_id; ?>" class="btn btn-primary">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        <?php
                }
            } else {
                echo "<div class='alert alert-info'>Aucun résultat trouvé.</div>";
            }
        }
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
