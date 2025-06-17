<?php
include 'db.php';

$error = ""; // Default empty error

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "❌ Invalid credentials.";
        }
    } else {
        $error = "❌ User not found.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        * {
            margin: 0; padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url("background.jpg") no-repeat center center/cover;
        }
        .wrapper {
            width: 400px;
            padding: 40px;
            background-color: #9db800;
            border-radius: 10px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.5);
        }
        .wrapper h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #fff;
        }
        .input-box {
            position: relative;
            margin-bottom: 20px;
            width: 100%;
            height: 40px;
        }
        .input-box input {
            width: 100%;
            height: 100%;
            padding: 0 10px;
            border: none;
            outline: none;
            background-color: transparent;
            color: #000;
            font-size: 16px;
        }
        .input-box input::placeholder {
            color: #c6e805;
        }
        .remember-forget {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .remember-forget label, .remember-forget a {
            color: #fff;
        }
        .btn {
            width: 100%;
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
        .register-link {
            text-align: center;
            margin-top: 20px;
            color: #fff;
        }
        .register-link a {
            color: #fff;
            text-decoration: none;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
        .error {
            background: #fff3f3;
            color: #ff0000;
            padding: 8px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <form method="post">
        <h1>Login</h1>

        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <div class="input-box">
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="input-box">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="remember-forget">
            <label>
                <input type="checkbox" name="remember"> Remember Me
            </label>
            <a href="#">Forgot Password?</a>
        </div>
        <button class="btn" type="submit">Login</button>
        <div class="register-link">
            <p>Don't have an account? <a href="register.html">Register</a></p>
        </div>
    </form>
</div>
</body>
</html>
