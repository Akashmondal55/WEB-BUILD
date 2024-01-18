<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "vlog_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$description = $_POST['description'];
$videoName = $_FILES['video']['name'];
$videoTemp = $_FILES['video']['tmp_name'];

$targetDir = "uploads/";
$targetFile = $targetDir . basename($videoName);
move_uploaded_file($videoTemp, $targetFile);

$sql = "INSERT INTO vlogs (title, description, video_path) VALUES ('$title', '$description', '$targetFile')";

if ($conn->query($sql) === TRUE) {
    echo "Vlog submitted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
