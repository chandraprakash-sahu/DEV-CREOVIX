<?php
session_start();
require_once 'config.php';

// Check admin authentication
if (!isset($_SESSION['admin_logged_in'])) {
    header('HTTP/1.1 403 Forbidden');
    exit('Access denied');
}

if (!isset($_GET['id'])) {
    header('HTTP/1.1 400 Bad Request');
    exit('Message ID required');
}

$id = intval($_GET['id']);
$conn = getDBConnection();

$stmt = $conn->prepare("SELECT * FROM contacts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('HTTP/1.1 404 Not Found');
    exit('Message not found');
}

$message = $result->fetch_assoc();

// Mark as read if unread
if ($message['status'] === 'unread') {
    $update_stmt = $conn->prepare("UPDATE contacts SET status = 'read' WHERE id = ?");
    $update_stmt->bind_param("i", $id);
    $update_stmt->execute();
    $update_stmt->close();
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($message);
?>