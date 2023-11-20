<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

// Retrieve the country from the GET request
$country = isset($_GET['country']) ? $_GET['country'] : '';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

//$stmt = $conn->query("SELECT * FROM countries");
$stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
$stmt->bindParam(':country', $country, PDO::PARAM_STR);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php if (!empty($results)): ?>
  <ul>
      <?php foreach ($results as $row): ?>
        <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
      <?php endforeach; ?>
  </ul>
<?php else: ?>
  <p>No information available for the specified country.</p>
<?php endif; ?>