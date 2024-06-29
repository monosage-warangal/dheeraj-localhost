<?php
include('config.php');

$cars = [
    [
        "title" => "Audi Car 1",
        "year" => 2019,
        "price" => 5000,
        "details" => json_encode(["4 people","Gasoline", "Automatic","AC"]),
        "images" => json_encode(["css/images/car-2.jpg", "css/images/car-1.jpg", "css/images/car-6.jpg"])
    ],
    [
        "title" => "Audi Car 2",
        "year" => 2020,
        "price" => 5500,
        "details" => json_encode(["4 people","Gasoline", "Automatic","Non-AC"]),
        "images" => json_encode(["css/images/car-2.jpg", "css/images/car-1.jpg", "css/images/car-6.jpg"])
    ],
    [
        "title" => "Audi Car 3",
        "year" => 2019,
        "price" => 13000,
        "details" => json_encode(["4 people","Gasoline", "Automatic","AC"]),
        "images" => json_encode(["css/images/car-2.jpg", "css/images/car-1.jpg", "css/images/car-6.jpg"])
    ],
    [
        "title" => "Audi Car 4",
        "year" => 2019,
        "price" => 23000,
        "details" => json_encode(["4 people","Gasoline", "Automatic","AC"]),
        "images" => json_encode(["css/images/car-2.jpg", "css/images/car-1.jpg", "css/images/car-6.jpg"])
    ]
];

foreach ($cars as $car) {
    $sql = "INSERT INTO cars (title, year, price, details, images) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siiss", $car['title'], $car['year'], $car['price'], $car['details'], $car['images']);
    
    if ($stmt->execute()) {
        echo "New record created successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
    }
}

$stmt->close();
$conn->close();
?>
