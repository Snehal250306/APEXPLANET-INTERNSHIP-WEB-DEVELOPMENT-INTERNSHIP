<?php
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch post to edit
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $post_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $post_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "❌ Blog post not found or unauthorized.";
        exit;
    }

    $post = $result->fetch_assoc();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $post_id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ssii", $title, $content, $post_id, $user_id);

    if ($stmt->execute()) {
        header("Location: myblog.php");
        exit;
    } else {
        echo "❌ Failed to update blog.";
    }
}
?>

<!-- HTML form -->
<!DOCTYPE html>
<html>
<head><title>Edit Blog</title>
 <style>
        *
        {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "poppins", sans-serif;
        }
        body
        {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #e3e961;
            background: url("background.jpg");
        }
        .wrapper
        {
            width: 400px;
            padding: 40px;
            background-color: #9db800;
            border-radius: 10px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.5);
        }

        .wrapper h1
        {
            text-align: center;
            margin-bottom: 30px;
            color: #fff;

        }
        .wrapper .input-box
        {
            position: relative;
            margin-bottom: 30px;
            width: 100%;
            height: 40px;
        }
        .input-box input
        {
            width: 100%;
            height: 100%;
            padding: 0 10px;
            border: none;
            outline: none;
            background-color: transparent;
            color: #000000;
            font-size: 16px;
        }
        .input-box input::placeholder
        {
            color: #c6e805;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #c6e805;
            color: #000;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-group {
            margin-bottom: 20px;
        }   

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #dce61d;
            color: #333;
            font-size: 16px;
        }
        .form-group textarea {
            height: 100px;
            resize: vertical;
            color: #c6e805;
        }
        .form-group input:focus, .form-group textarea:focus {
            outline: none;
            border: 2px solid #c6e805;
            box-shadow: 0 0 5px rgba(200, 232, 19, 0.2);
        }
        .form-group input:focus, .form-group textarea:focus {
            outline: none;
            border: 2px solid #c6e805;
            box-shadow: 0 0 5px rgba(198, 230, 5, 0.2);
        }
        .btn:hover {
            background-color: #b3d600;
        }       
        </style>
</head>
<body>
        <div class="wrapper">
    <h2>Edit Blog Post</h2>
    <form method="POST" action="edit.php">
        <input type="hidden" name="id" value="<?= $post['id'] ?>">
        <div class="input-box">
        <label>Title:</label><br>
        <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br><br>
        </div>
        <div class="textarea-box">
        <label>Content:</label><br>
        <textarea name="content" rows="6" cols="45" required><?= htmlspecialchars($post['content']) ?></textarea><br><br>
        </div>
        <button type="submit" class="btn" value="Update Blog">Update Blog</button>
    </form>
    </div>
</body>
</html>
