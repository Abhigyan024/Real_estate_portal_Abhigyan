<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Estate Listings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
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
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            margin-bottom: 30px;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            padding: 10px 20px;
            border: none;
            background: #007bff;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }
        .listing {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }
        .listing img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Real Estate Listings</h1>
        
        <form action="add_property.php" method="post" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>
            
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" required>
            
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4"></textarea>
            
            <!-- <label for="image">Image:</label>
            <input type="file" id="image" name="image">
             -->
            <label for="images">Images:</label>
            <input type="file" id="images" name="images[]" multiple>

            <input type="submit" value="Add Property">
        </form>

        <h2>Available Listings</h2>
    <?php
        // Fetch and display the property listings
        include 'db_connection.php';

        $result = $conn->query("SELECT * FROM properties ORDER BY id DESC");

            while($row = $result->fetch_assoc()) {
                echo "<div class='listing'>";
                    if ($row['image']) {
                        echo "<img src='uploads/" . $row['image'] . "' alt='Property Image'>";
        }
                    echo "<h3><a href='view_property.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></h3>";
                    echo "<p>Location: " . $row['location'] . "</p>";
                    echo "<p>Price: $" . $row['price'] . "</p>";
                    echo "<p>" . $row['description'] . "</p>";
                    echo "</div>";
}

$conn->close();
?>

    </div>
</body>
</html>
