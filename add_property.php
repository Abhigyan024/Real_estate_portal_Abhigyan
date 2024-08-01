<?php
include 'db_connection.php';

$title = $_POST['title'];
$location = $_POST['location'];
$price = $_POST['price'];
$description = $_POST['description'];

// Initialize an array to store image paths
$image_paths = [];

if (isset($_FILES['images'])) {
    $total_files = count($_FILES['images']['name']);
    for ($i = 0; $i < $total_files; $i++) {
        $image_name = basename($_FILES['images']['name'][$i]);
        $target = 'uploads/' . $image_name;
        if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $target)) {
            $image_paths[] = $image_name;  // Store the image name (or full path)
        }
    }
}

// Convert the image paths array to a comma-separated string
$images_string = implode(',', $image_paths);

$sql = "INSERT INTO properties (title, location, price, description, image) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssdss', $title, $location, $price, $description, $images_string);

if ($stmt->execute()) {
    echo "New property added successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
header("Location: listing.html"); // Redirect back to the listing page
exit();
?>
