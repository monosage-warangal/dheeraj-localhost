<?php
// Assuming you have a database connection setup in config.php
include 'config.php';

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $carId = $_POST['car_id'];
    $rating = $_POST['rating'];
    $reviewText = $_POST['review_text'];
    $reviewMedia = $_FILES['review_media'];

    // Handle file upload if necessary
    $mediaPath = null;
    if ($reviewMedia && $reviewMedia['error'] === 0) {
        $targetDir = 'uploads/';
        $mediaName = basename($reviewMedia['name']);
        $targetPath = $targetDir . $mediaName;
        if (move_uploaded_file($reviewMedia['tmp_name'], $targetPath)) {
            $mediaPath = $targetPath;
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to upload media.']);
            exit;
        }
    }

    // Insert into database
    $stmt = $pdo->prepare('INSERT INTO reviews (car_id, rating, review_text, review_media) VALUES (?, ?, ?, ?)');
    $stmt->execute([$carId, $rating, $reviewText, $mediaPath]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Review saved successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save review.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
