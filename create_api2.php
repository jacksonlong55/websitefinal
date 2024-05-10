<?php
include 'config.php';

if(isset($_GET['sessionID'])) {
    $sessionID = $_GET['sessionID'];
    
    $sql = "DELETE FROM Workout_Session WHERE SessionID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $sessionID);
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Workout session deleted successfully.']);
    } else {

        echo json_encode(['status' => 'error', 'message' => 'Failed to delete workout session.']);
    }

    $stmt->close();
} else {
    $sql = "SELECT SessionID, PlanID, Date, Duration, Notes FROM Workout_Session ORDER BY SessionID DESC";
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
        echo json_encode(['status' => 'error', 'message' => 'No workouts.']);
    }
}

$connection->close();
?>