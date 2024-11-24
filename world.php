<?php
$host = 'localhost';
$username = 'lab5_user'; 
$password = 'password123'; 
$dbname = 'world';

// Retrieve the country and lookup type from the GET request
$country = isset($_GET['country']) ? $_GET['country'] : '';
$lookupType = isset($_GET['lookup']) ? $_GET['lookup'] : '';

// Create a PDO connection
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Prepare and execute the SQL query based on the lookup type
if ($lookupType === 'cities') {
    $stmt = $conn->prepare("SELECT cities.name AS cityName, cities.district, cities.population
                           FROM cities
                           JOIN countries ON cities.country_code = countries.code
                           WHERE countries.name LIKE :country");
} else {
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
}

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
        <?php if ($lookupType === 'cities'): ?>
            <h2>Cities in <?= $country ?></h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>District</th>
                        <th>Population</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?= $row['cityName']; ?></td>
                            <td><?= $row['district']; ?></td>
                            <td><?= $row['population']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <h2>Country Information for <?= $country ?></h2>
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
        <?php endif; ?>
    <?php else: ?>
        <p>No information available for the specified country.</p>
    <?php endif; ?>

</body>
</html>
