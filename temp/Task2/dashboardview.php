<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        * {
            margin: 0; padding: 0; box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #e3e961;
            background: url("background.jpg") no-repeat center center/cover;
        }

        .content {
            flex: 3;
            padding: 40px;
        }

        .sidebar {
            flex: 1;
            background-color: #9db800;
            padding: 40px 20px;
            box-shadow: -3px 0 10px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar h2 {
            color: #fff;
            margin-bottom: 30px;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            margin: 10px 0;
            font-weight: bold;
            transition: color 0.3s;
        }

        .sidebar a:hover {
            color: #c6e805;
        }

        .post {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .post h3 {
            margin-bottom: 10px;
            color: #333;
        }

        .post p {
            color: #555;
        }

        .post small {
            color: #888;
        }

        .no-posts {
            text-align: center;
            margin-top: 100px;
            font-size: 1.2em;
            color: #444;
        }
    </style>
</head>
<body>

    <div class="content">
        <h1>📰 All Blog Posts</h1>
        <hr><br>

        <?php if (isset($hasPosts) && $hasPosts): ?>
            <?php while ($row = $posts->fetch_assoc()): ?>
                <div class="post">
                    <h3><?= htmlspecialchars($row['title']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($row['content'])) ?></p>
                    <small>Posted by <?= htmlspecialchars($row['username']) ?> on <?= $row['created_at'] ?></small>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="no-posts">No blogs found. <a href="createview.php">Create your own blog</a>.</div>
        <?php endif; ?>
    </div>

    <div class="sidebar">
        <h2>📋 Menu</h2>
        <a href="profile.php">👤 Profile</a>
        <a href="createview.php">✍️ Create Blog</a>
        <a href="myblog.php">📓 My Blog</a>
        <a href="logout.php">🚪 Logout</a>
    </div>

</body>
</html>
