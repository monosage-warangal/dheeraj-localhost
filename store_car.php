<?php
// Include your database connection
require_once 'config.php';

// Check if data_car parameter is received via POST
if (isset($_POST['data_car'])) {
    // Get the JSON string from POST data
    $data_car = $_POST['data_car'];

    // Decode the JSON string into an associative array
    $car_data = json_decode($data_car, true);

    // Extract values from decoded JSON
    $id = $car_data['id'];
    $title = $car_data['title'];
    $year = $car_data['year'];
    // Assuming 'price' is formatted as "₹5000/day" and needs to be cleaned
    $price = (float) preg_replace('/[^\d.]/', '', $car_data['price']); // Extract numeric part of price
    $details = implode(', ', $car_data['details']); // Convert array to comma-separated string
    // Assuming 'images' is an array and needs to be stored as JSON
    $images = json_encode($car_data['images']);

    // Prepare SQL statement to insert data into 'cars' table
    $sql = "INSERT INTO cars (id, title, year, price, details, images) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    // Prepare and execute the statement
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id, $title, $year, $price, $details, $images]);

    // Optionally, you can check if the insertion was successful
    if ($stmt->rowCount() > 0) {
        echo "Car details inserted successfully.";
    } else {
        echo "Error inserting car details.";
    }
} else {
    echo "No data received.";
}
?>
