<?php
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$limit = 5; // Posts per page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $limit;

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$searchParam = "%" . $search . "%";

// Count total posts with or without search
if ($search) {
    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM posts WHERE title LIKE ? OR content LIKE ?");
    $stmt->bind_param("ss", $searchParam, $searchParam);
} else {
    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM posts");
}
$stmt->execute();
$result = $stmt->get_result();
$totalPosts = $result->fetch_assoc()['total'];
$totalPages = ceil($totalPosts / $limit);
$stmt->close();

// Fetch posts with user info
if ($search) {
    $stmt = $conn->prepare("
        SELECT posts.*, users.username 
        FROM posts 
        JOIN users ON posts.user_id = users.id 
        WHERE posts.title LIKE ? OR posts.content LIKE ? 
        ORDER BY posts.created_at DESC 
        LIMIT ? OFFSET ?
    ");
    $stmt->bind_param("ssii", $searchParam, $searchParam, $limit, $offset);
} else {
    $stmt = $conn->prepare("
        SELECT posts.*, users.username 
        FROM posts 
        JOIN users ON posts.user_id = users.id 
        ORDER BY posts.created_at DESC 
        LIMIT ? OFFSET ?
    ");
    $stmt->bind_param("ii", $limit, $offset);
}
$stmt->execute();
$posts = $stmt->get_result();
$hasPosts = $posts->num_rows > 0;

include 'dashboardview.php';
?>