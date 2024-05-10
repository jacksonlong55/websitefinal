<?php
include 'config.php';
header('Content-Type: application/json');

$sql = "SELECT UserID, Name, Email, Age, Gender, FitnessGoals, Username, Password FROM User_Profile";
$result = $connection->query($sql);

if ($result && $result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode([
        'status' => 'success',
        'data' => $data
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No user profiles found.']);
}

$connection->close();
?>