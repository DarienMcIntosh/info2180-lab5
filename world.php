<?php
$host = 'localhost';
$username = 'lab5_user'; // Replace with your actual MySQL username
$password = 'password123'; // Replace with your actual MySQL password
$dbname = 'world';

// Retrieve the country from the GET request
$country = isset($_GET['country']) ? $_GET['country'] : '';

// Create a PDO connection
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Prepare and execute the SQL query
$stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
$stmt->bindParam(':country', $country, PDO::PARAM_STR);
$stmt->execute();

// Fetch the results
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World Database Lookup</title>
    <link rel="stylesheet" href="world.css">
</head>
<body>

    <h1>World Database Lookup</h1>

    <?php if (!empty($results)): ?>
        <table>
            <thead>
                <tr>
                    <th>Country Name</th>
                    <th>Continent</th>
                    <th>Independence Year</th>
                    <th>Head of State</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $row): ?>
                    <tr>
                        <td><?= $row['name']; ?></td>
                        <td><?= $row['continent']; ?></td>
                        <td><?= $row['independence_year']; ?></td>
                        <td><?= $row['head_of_state']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No information available for the specified country.</p>
    <?php endif; ?>

</body>
</html>
