<!DOCTYPE html>
<html>
<head>
    <title>My Blogs</title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            padding: 40px;
             background-color: #e3e961;
            background: url("background.jpg");
        }
        .post {
            background-color:rgb(233, 237, 159);
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(234, 29, 29, 0.1);
        }
        .post h3 {
            margin: 0;
        }
         a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #fff;
            background: #9db800;
            padding: 10px 20px;
            border-radius: 8px;
        }
        a:hover {
            background-color: #c6e805;
        }
    </style>
</head>
<body>

    <h1>📓 My Blogs</h1>
    <hr><br>

    <?php if ($hasPosts): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="post">
                <h3><?= htmlspecialchars($row['title']) ?></h3>
                <p><?= nl2br(htmlspecialchars($row['content'])) ?></p>
                <small>Posted on <?= $row['created_at'] ?></small>

                <div class="actions">
                    <a href="edit.php?id=<?= $row['id'] ?>">✏️ Edit</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this blog?')">🗑️ Delete</a>
                </div>
                <br>
                 <div>
                    <a href="dashboard.php">← Back to Dashboard</a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No blogs yet. <a href="createview.php">Create your first blog</a></p>
        <br>
                 <div>
                    <a href="dashboard.php">← Back to Dashboard</a>
                </div>
    <?php endif; ?>

</body>
</html>
