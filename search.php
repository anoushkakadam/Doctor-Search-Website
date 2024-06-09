<?php
// Establish database connection (assuming you have XAMPP set up with MySQL)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doctor_search";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Process form input
$specialization = isset($_GET['specialization']) ? $conn->real_escape_string($_GET['specialization']) : '';
$location = isset($_GET['location']) ? $conn->real_escape_string($_GET['location']) : '';

// Prepare and execute SQL query
$sql = "SELECT * FROM doctors WHERE specialization LIKE '%$specialization%' AND location LIKE '%$location%'";
$result = $conn->query($sql);

// Display search results
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<div class='doctor'>";
    echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
    echo "<p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>";
    echo "<p><strong>Specialization:</strong> " . htmlspecialchars($row['specialization']) . "</p>";
    echo "<p><strong>Phone:</strong> " . htmlspecialchars($row['phone']) . "</p>";
    echo "<p><strong>Description:</strong> " . htmlspecialchars($row['description']) . "</p>";
    echo "</div>";
  }
} else {
  echo "No results found";
}

$conn->close();
?>
