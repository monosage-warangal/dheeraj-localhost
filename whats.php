<?php
session_start();

// Include your database connection code here
include('config.php');

// Retrieve car details from the session
$selectedCar = $_SESSION['selectedCar'];
$car_id = $selectedCar['car_id'];
$car_title = $selectedCar['title'];
$car_year = $selectedCar['year'];
$car_price = $selectedCar['price'];

// Retrieve user details from the session
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];

// Generate the message for WhatsApp
$message = "Hello, I am interested in renting a car. Here are my details:\n\n" .
           "Name: $username\n" .
           "Email: $email\n" .
           "Phone: $phone\n" .
           "Booking Type: One Way\n" .
           "Pickup Location: war\n" . // Static values for demo purposes
           "Dropoff Location: hyd\n" .
           "Pickup Date: 2024-06-20\n" .
           "Pickup Time: 07:00\n" .
           "Return Date: null\n\n" .
           "Car Details:\n" .
           "Car Title: $car_title\n" .
           "Car Year: $car_year\n" .
           "Car Price: ₹$car_price / day";

echo "<script>
  const message = `" . addslashes($message) . "`;
  document.addEventListener('DOMContentLoaded', () => {
    const rentNowButton = document.getElementById('btn');
    rentNowButton.addEventListener('click', () => {
      const encodedMessage = encodeURIComponent(message);
      const whatsappURL = `https://wa.me/+917780598470?text=${encodedMessage}`;
      window.location.href = whatsappURL;
    });
  });
</script>";
?>
