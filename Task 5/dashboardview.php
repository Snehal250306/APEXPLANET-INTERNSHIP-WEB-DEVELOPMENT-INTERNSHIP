<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <!-- ✅ Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url("background.jpg") no-repeat center center/cover;
            min-height: 100vh;
        }
        .sidebar {
            background-color: #9db800;
            min-height: 100vh;
            padding: 30px 15px;
            color: white;
        }
        .sidebar a {
            color: white;
            display: block;
            margin: 10px 0;
            font-weight: 500;
            text-decoration: none;
        }
        .sidebar a:hover {
            color: #c6e805;
        }
        .post {
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .no-posts {
            text-align: center;
            font-size: 1.2rem;
            margin-top: 50px;
        }
        .no-posts a {
            color: #007bff;
            text-decoration: none;
        }           
        .no-posts a:hover {
            text-decoration: underline;
        }   
        .pagination {
            justify-content: center;            
            margin-top: 20px;

            margin-bottom: 20px;
        }   
        .pagination .page-item.active .page-link {  
            background-color: #9db800;

            border-color: #9db800;
            color: white;
        }
        .pagination .page-link {
            color: #9db800;
            border: 1px solid #9db800;
            border-radius: 50%;
            padding: 10px 15px;
            margin: 0 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        .pagination .page-link:hover {
            background-color: #c6e805;
            color: white;
        }
        .pagination .page-item.disabled .page-link {
            color: #6c757d; 
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }
        .pagination .page-item.disabled .page-link:hover {
            background-color: #f8f9fa;
            color: #6c757d;
        }  
            .btn {
            width: 20%;
            height: 40px;
            background-color: #b8cf08;
            border: none;
            color: #000;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #c6e805;
        }   
        
    </style>
</head>
<body>
    <br>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <h2 class="mb-4">📋 Menu</h2>
            <a href="profile.php">👤 Profile</a>
            <a href="createview.php">✍️ Create Blog</a>
            <a href="myblog.php">📓 My Blog</a>
            <a href="logout.php">🚪 Logout</a>
        </div>

        <!-- Content Area -->
        <div class="col-md-9 p-5">
            <form class="mb-4" method="GET" action="dashboard.php">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search blogs..." value="<?= htmlspecialchars($search ?? '') ?>">
        <button class="btn" type="submit">Search</button>
    </div>
</form>
            <h1 class="mb-4">📰 All Blog Posts</h1>
            <hr>

            <?php if (!isset($hasPosts)) $hasPosts = false; ?>
            <?php if (!isset($posts)) $posts = null; ?>

            <?php if ($hasPosts): ?>
                <?php while ($row = $posts ->fetch_assoc()): ?>
                    <div class="post">
                        <h3><?= htmlspecialchars($row['title']) ?></h3>
                        <p><?= nl2br(htmlspecialchars($row['content'])) ?></p>
                        <small class="text-muted">Posted by <?= htmlspecialchars($row['username']) ?> on <?= $row['created_at'] ?></small>
                    </div>
                <?php endwhile; ?>

                <!-- ✅ Bootstrap Pagination -->
                <?php if (isset($totalPages) && $totalPages > 1): ?>
                    <nav>
                        <ul class="pagination">
                            <?php if ($currentPage > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $currentPage - 1 ?>">&laquo;</a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($currentPage < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $currentPage + 1 ?>">&raquo;</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php endif; ?>

            <?php else: ?>
                <div class="no-posts alert alert-warning">
                    No blogs found. <a href="create.php" class="alert-link">Create your own blog</a>.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>
