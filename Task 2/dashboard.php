<?php
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch all posts with the associated username
$query = "
    SELECT posts.*, users.username 
    FROM posts 
    JOIN users ON posts.user_id = users.id 
    ORDER BY posts.created_at DESC
";

$result = $conn->query($query);
$hasPosts = $result && $result->num_rows > 0;
$posts = $result;

include 'dashboardview.php'; // Send posts to view
?>

