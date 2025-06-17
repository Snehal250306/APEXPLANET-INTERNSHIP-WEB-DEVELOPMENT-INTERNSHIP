<?php
include 'db.php';// Make sure session is started

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// ✅ Ensure these variables are always defined
$hasPosts = ($result && $result->num_rows > 0);
$posts = $result;

include 'myblogview.php';
?>

