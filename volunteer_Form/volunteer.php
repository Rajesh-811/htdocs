<?php
$host = "localhost";  
$dbname = "nova_ngo"; 
$username = "root";   
$password = "";       

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect POST data
$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$countryCode = isset($_POST['countryCode']) ? $_POST['countryCode'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';

// Fix DOB issue
$dobYear = isset($_POST['dobYear']) ? $_POST['dobYear'] : '';
$dobMonth = isset($_POST['dobMonth']) ? $_POST['dobMonth'] : '';
$dobDay = isset($_POST['dobDay']) ? $_POST['dobDay'] : '';
$dob = ($dobYear && $dobMonth && $dobDay) ? "$dobYear-$dobMonth-$dobDay" : NULL;

$appointmentDate = isset($_POST['appointmentDate']) ? $_POST['appointmentDate'] : NULL;
$appointmentTime = isset($_POST['selectedTime']) ? $_POST['selectedTime'] : NULL;

// Address fields
$address = isset($_POST['address']) ? $_POST['address'] : '';
$city = isset($_POST['city']) ? $_POST['city'] : '';
$state = isset($_POST['state']) ? $_POST['state'] : '';
$postalCode = isset($_POST['postalCode']) ? $_POST['postalCode'] : '';

// Fix interests issue
$interests = isset($_POST['interests']) && is_array($_POST['interests']) ? implode(", ", $_POST['interests']) : '';

$stmt = $conn->prepare("INSERT INTO volunteers 
                        (first_name, last_name, email, dob, country_code, phone, address, city, state, postal_code, appointment_date, appointment_time, interests) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("SQL Error: " . $conn->error); // Check if SQL query is incorrect
}

$stmt->bind_param("sssssssssssss", $firstName, $lastName, $email, $dob, $countryCode, $phone, $address, $city, $state, $postalCode, $appointmentDate, $appointmentTime, $interests);

if ($stmt->execute()) {
    echo "✅ Registration Successful!";
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
