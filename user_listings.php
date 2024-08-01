<?php
include 'db_connection.php';

// Fetch the property listings from the database
$result = $conn->query("SELECT * FROM properties ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Listings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: auto;
        }
        h1 {
            text-align: center;
            margin-bottom: 40px;
        }
        .grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .property-card {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: calc(33.333% - 20px);
            box-sizing: border-box;
            transition: transform 0.3s ease;
            text-align: center;
        }
        .property-card img {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .property-card h3 {
            margin: 10px 0;
            font-size: 1.25em;
        }
        .property-card p {
            margin: 10px 0;
            color: #555;
        }
        .property-card a {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
        .property-card a:hover {
            background: #0056b3;
        }
        .property-card:hover {
            transform: translateY(-5px);
        }
        @media (max-width: 768px) {
            .property-card {
                width: calc(50% - 20px);
            }
        }
        @media (max-width: 480px) {
            .property-card {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Available Properties</h1>
        <div class="grid">
            <?php
            while($row = $result->fetch_assoc()) {
                echo "<div class='property-card'>";
                if ($row['image']) {
                    echo "<img src='uploads/" . htmlspecialchars($row['image']) . "' alt='Property Image'>";
                }
                echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                echo "<p>Location: " . htmlspecialchars($row['location']) . "</p>";
                echo "<p>Price: $" . number_format($row['price'], 2) . "</p>";
                echo "<a href='view_property.php?id=" . $row['id'] . "'>View Details</a>";
                echo "</div>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
