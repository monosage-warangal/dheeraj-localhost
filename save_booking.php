<?php
include('config.php');
session_start(); // Start session if not already started

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rent_now'])) {

   // Print received data for debugging
   echo '<pre>';
   print_r($_POST);
   echo '</pre>';
    // Retrieve car details from POST data
    $carId = $_POST['car_id'];
    $title = $_POST['title'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $details = $_POST['details'];
    $images = $_POST['images'];
    $username = $_SESSION['username']; // Retrieve username from session

    try {
        $stmt = $conn->prepare("INSERT INTO car_details (car_id, title, year, price, details, images, username, booking_date) 
                                VALUES (:car_id, :title, :year, :price, :details, :images, :username, NOW())");
        $stmt->bindParam(':car_id', $carId);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':details', $details);
        $stmt->bindParam(':images', $images);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        header("Location: profile.php"); // Redirect to profile page after successful booking
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
