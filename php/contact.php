<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/contact.css">
    <link rel="shortcut icon" href="../images/Új projekt.png" type="image/x-icon">
    <title>Contact Us</title>
</head>
<body>
    <div class="wrapper">

        <?php include 'header/header_player.php'; ?> 

    <main>
        <div class="content">
            <h2>Contact Us</h2>
            <p>We'd love to hear from you! Whether you have a question, suggestion, or feedback, feel free to reach out to us.</p>
            
            <div class="contact-info">
                <h3>Our Contact Information:</h3>
                <ul>
                    <li>Email: <a href="mailto:contact@company.com">contact@company.com</a></li>
                    <li>Phone: +1 (123) 456-7890</li>
                    <li>Address: 123 Fantasy Street, Dreamland, Wonderland</li>
                    <li>Operating Hours: Monday - Friday, 9 AM - 5 PM</li>
                </ul>
            </div>

            <div class="contact-form">
                <h3>Send Us a Message</h3>
                <form action="send_message.php" method="POST">
                    <label for="name">Your Name:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Your Email:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="message">Your Message:</label>
                    <textarea id="message" name="message" rows="5" required></textarea>

                    <button type="submit" class="btn-submit">Send Message</button>
                </form>
            </div>
        </div>
    </main>

    <?php include 'footer/footer.php'; ?> 

</div>
</body>
</html>
