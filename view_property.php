<?php
include 'db_connection.php';

$id = $_GET['id'];

$sql = "SELECT * FROM house_listings WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $property = $result->fetch_assoc();
} else {
    echo "Property not found!";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($property['title']); ?> - Property Details</title>
    <style>
        /* Style as needed, keeping it consistent with previous examples */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .property-images img {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Property Details</h1>
        <div class="property-images">
            <?php 
            $images = explode(',', $property['image']); // Convert the comma-separated string back into an array
            foreach ($images as $image) {
                echo "<img src='uploads/" . htmlspecialchars($image) . "' alt='Property Image'>";
            }
            ?>
        </div>
        <h2><?php echo htmlspecialchars($property['title']); ?></h2>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($property['location']); ?></p>
        <p><strong>Price:</strong> $<?php echo number_format($property['price'], 2); ?></p>
        <p><?php echo nl2br(htmlspecialchars($property['description'])); ?></p>
        <a href="user_listings.php">Back to Listings</a>
    </div>
</body>
</html>
