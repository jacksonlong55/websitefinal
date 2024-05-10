<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $planID = $_POST['planID'];
    $date = $_POST['date'];
    $duration = $_POST['duration'];
    $notes = $_POST['notes'];

    $sql = "INSERT INTO Workout_Session (PlanID, Date, Duration, Notes) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);

    $stmt->bind_param("isss", $planID, $date, $duration, $notes);
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Workout session added successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error adding workout session: ' . $stmt->error]);
    }

    $stmt->close();
}

$connection->close();
?>