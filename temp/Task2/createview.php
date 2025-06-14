<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create your own Blog </title>
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
        .back-link {
            text-align: center;
        }                       
    </style>
</head>
<body>
    <div class="wrapper">
    <h1>✍️ Create Blog Post</h1>

    <?php if (isset($error)) echo "<div class='error'>{$error}</div>"; ?>

    <form method="POST" action="create.php">
        <div class="input-box">
                <input type="text" name="title" placeholder="Blog Title" required>
            </div>
            <div class="textarea-box">
                <textarea cols="45" rows="7    " name="content" placeholder="Write your blog content here..." required></textarea>
            </div>
        <input type="submit" class="btn" value="Publish">
    </form>
        <br>
    <div class="back-link">
        <a href="dashboard.php">← Back to Dashboard</a>
    </div>
</div>
    
</body>
</html>