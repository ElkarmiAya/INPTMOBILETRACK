
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - INPT Mobile Track</title>
    <!--------bootstrap css link-------->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <style>
        .contact-section {
            padding: 60px 0;
        }
        .contact-section h2 {
            margin-bottom: 30px;
        }
        .contact-info {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

    <div class="container contact-section">
        <h2 class="text-center">Contact Us</h2>
        <div class="row">
            <div class="col-lg-6 contact-info">
                <h4>Our Address</h4>
                <p>1234 Street Name, City, Country</p>
                <h4>Phone</h4>
                <p>+1 234 567 890</p>
                <h4>Email</h4>
                <p>info@inptmobiletrack.com</p>
            </div>
            <div class="col-lg-6">
                <form action="contact-form-handler.php" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <!--------bootstrap js link-------->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
