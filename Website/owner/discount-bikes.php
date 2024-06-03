<?php include '../connect2.php'; ?>
<?php include 'owner_header.php'; ?>
<?php
// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    // Rediriger vers la page de login si l'utilisateur n'est pas connecté
    header("Location: login_owner.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f8f9fa;
        }
        .dashboard-section {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        .header-title {
            font-size: 2.5rem;
            margin-bottom: 2rem;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input, .form-group textarea, .form-group select {
            margin-bottom: 1rem;
        }
        .form-group input[type="file"] {
            padding: 0.5rem;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <h1 class="text-center text-primary my-3 header-title">Owner Dashboard</h1>
    <div class="row">
        <!-- Add Bike Section -->
        <div class="col-md-6 offset-md-3">
            <div class="dashboard-section card">
                <div class="card-body"style="width=600px;">
                    <h3 class="card-title">Add Bike</h3>
                    <form action="add-bike.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="category_name">Nom de la catégorie:</label>
                            <input type="text" class="form-control" name="category_name" id="category_name" required>
                        </div>
                        <div class="form-group">
                            <label for="category_desc">Description de la catégorie:</label>
                            <textarea class="form-control" name="category_desc" id="category_desc" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="category_price">Prix de la catégorie:</label>
                            <input type="number" class="form-control" name="category_price" id="category_price" required>
                        </div>
                        <div class="form-group">
                            <label for="genre">Genre:</label>
                            <select class="form-control" name="genre" id="genre" required>
                                <option value="" disabled selected>Choisissez le genre</option>
                                <option value="men">Men</option>
                                <option value="women">Women</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type">Type:</label>
                            <select class="form-control" name="type" id="type" required>
                                <option value="" disabled selected>Choisissez le type</option>
                                <option value="bike">Bike</option>
                                <option value="scooter">Scooter</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fileToUpload">Sélectionnez une image:</label>
                            <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Ajouter un vélo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Optional: JavaScript for additional interactivity can be added here
</script>
</body>
</html>
