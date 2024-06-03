<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - INPT Mobile Track</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1, h2, h3 {
            color: #333;
            text-align: center;
        }
        p {
            line-height: 1.6;
            margin-bottom: 20px;
            text-align: justify;
        }
        .intro {
            text-align: center;
            font-size: 1.2em;
            color: #555;
            margin-top: 10px;
            margin-bottom: 40px;
        }
        .story-mission-container {
            display: flex;
            flex-direction: column;
            margin-top: 40px;
        }
        .story, .mission {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            transition: transform 0.3s ease-in-out;
        }
        .story:hover, .mission:hover {
            transform: scale(1.05);
        }
        .story img, .mission img {
            max-height: 250px;
            width: 40%;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .story p, .mission p {
            width: 50%;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .mission img {
            order: -1; /* Place the image on the left for the mission section */
        }
        .values {
            margin-top: 40px;
            text-align: center;
        }
        .values ul {
            list-style-type: none;
            padding: 0;
        }
        .values li {
            background: #fff;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        /* Animation on scroll */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <!-- Inclure votre barre de navigation -->

    <div class="container">
        <h1>About Us</h1>
        <p class="intro animate-on-scroll">Empowering Students with Sustainable Mobility Solutions.</p>
        <p class="intro animate-on-scroll">Welcome to INPT Mobile Track! We are dedicated to providing high-quality mobile solutions...</p>

        <div class="story-mission-container">
            <h3>Our Story</h3>
            <div class="story animate-on-scroll">
                <p>Students from INPT and the Al Irfane region often find themselves relying on public transportation for their daily commute. This dependence can sometimes be unfavorable due to traffic congestion and long queues at public transport terminals. To address this issue, we conceived INPT Mobile Track. Our initiative aims to ease student commutes by providing bicycles and scooters at affordable prices. This solution not only enhances student mobility but also contributes to environmental preservation by reducing emissions from public transportation.</p>
                <img src="images/Vue_INPT.jpg" alt="Our Story Image">
            </div>
            <h3>Our Mission</h3>
            <div class="mission animate-on-scroll">
                <img src="images/our_mission.jpg" alt="Our Mission Image">
                <p>Our mission is to revolutionize student transportation by offering eco-friendly and affordable mobility solutions. We strive to reduce our carbon footprint while ensuring convenience and efficiency for students. By integrating advanced technology with sustainable practices, we aim to create a better, greener future for everyone.</p>
            </div>
        </div>

        <h2 class="values">Our Values</h2>
        <ul class="values animate-on-scroll">
            <li>Customer satisfaction is our top priority.</li>
            <li>We believe in innovation and continuous improvement.</li>
            <li>Transparency and integrity guide our actions.</li>
        </ul>
    </div>

    <!-- Inclure votre pied de page -->
    <?php include 'footer.php'; ?>

    <script>
        // Function to add visible class to elements on scroll
        function animateOnScroll() {
            const elements = document.querySelectorAll('.animate-on-scroll');
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            elements.forEach(element => {
                const elementOffset = element.offsetTop;
                const elementHeight = element.offsetHeight;
                if (scrollTop > elementOffset - window.innerHeight + elementHeight / 3) {
                    element.classList.add('visible');
                }
            });
        }

        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
    </script>
</body>
</html>
