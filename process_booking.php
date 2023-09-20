<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get form values
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $checkin = $_POST['checkin'];
  $checkout = $_POST['checkout'];
  $roomtype = $_POST['roomtype'];
  $vehicleNumber = $_POST['vehicleNumber'];
  $spotValues = $_POST['spotValues'];
  $vehiclePrice = $_POST['vehiclePrice']; // Added vehiclePrice

  // Perform form validation
  if (empty($name) || empty($email) || empty($phone) || empty($checkin) || empty($checkout) || empty($roomtype) || empty($vehicleNumber) || empty($spotValues) || empty($vehiclePrice)) {
    echo "Please fill in all fields";
    return;
  }

  // Calculate the cost of tours based on the number of spots
  $numberOfSpots = count($spotValues);
  $tourCost = $numberOfSpots * 10; // Assuming $10 per spot

  // Calculate the total cost including the tour cost and vehicle price
  $totalCost = $tourCost + $vehiclePrice;

  // Database connection settings
  $host = "localhost"; // Change to your database host
  $username = "your_username"; // Change to your database username
  $password = "your_password"; // Change to your database password
  $dbname = "vgu"; // Change to your database name

  // Create a new PDO instance
  $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
  $pdo = new PDO($dsn, $username, $password);

  // Prepare and execute the SQL query
  $sql = "INSERT INTO bookings (name, email, phone, checkin, checkout, roomtype, vehicle_number, spot_values, vehicle_price, tour_cost, total_cost) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$name, $email, $phone, $checkin, $checkout, $roomtype, $vehicleNumber, $spotValues, $vehiclePrice, $tourCost, $totalCost]);

  // Check if the query was successful
  if ($stmt->rowCount() > 0) {
    echo "Booking Successful! Total cost including tours and vehicle: $totalCost";
  } else {
    echo "Error: Failed to process the booking.";
  }
} else {
  echo "Invalid request";
}
?>
