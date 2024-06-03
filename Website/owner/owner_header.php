<?php
session_start();
include("../connect.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INPT Mobile Track</title>
    <!--------bootstrap css link-------->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <style>
        .navbar-nav .nav-link {
            color: #0561a2 !important;
            font-weight: bold;
        }
        .navbar-nav .nav-link:hover {
            color: #ddd !important;
        }
        .navbar-brand img {
            height: 40px;
        }
        .navbar {
            background-color: #343a40; /* Dark background */
        }
        
        .custom-filter:hover {
        background-color:#0561a2;
        color:#fff;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        padding: 0.375rem 1.75rem 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        margin-right: 10px;
    }
    .custom-filter {
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        padding: 0.375rem 1.75rem 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        margin-right: 10px;
    }
    .custom-filter:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    .form-group label {
        font-weight: bold;
    }
    </style>
</head>
<body>
    <nav style="background-color:rgba(255,255,255); "class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#"><img style='width: 80px;height:fit-content;' src="logo.png" alt="Logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a  style="color:blue"class="nav-link" href="ownerhomepage.php">Home</a>
                </li>
              
                <li class="nav-item">
                    <a  style="color:blue"class="nav-link" href="../contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a style="color:blue" class="nav-link" href="../About.php">About</a>
                </li>
                <li class="nav-item">
                    <a style="color:blue" class="nav-link" href="../Acceuil.html">Log-out</a>
                </li>
            
            </ul>
            

        </div>
    </nav>
</body>
</html>