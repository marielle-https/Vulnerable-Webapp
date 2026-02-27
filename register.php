<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<!-- Google Fonts: League Spartan -->
<link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'League Spartan', sans-serif;
        background: #f0f2f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .register-container {
        background: #fff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        width: 350px;
        text-align: center;
    }

    h1 {
        margin-bottom: 30px;
        font-size: 32px;
        color: #333;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 12px 15px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        width: 100%;
        padding: 12px;
        background-color: #28a745;
        border: none;
        border-radius: 6px;
        color: white;
        font-size: 16px;
        cursor: pointer;
        margin-top: 15px;
        transition: background 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #218838;
    }

    .login-link {
        margin-top: 15px;
        display: block;
        font-size: 14px;
    }

    .login-link a {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }

    .login-link a:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>
<div class="register-container">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "user_db");
    if ($conn->connect_error) { 
        echo "<script>alert('Connection failed: " . $conn->connect_error . "');</script>"; 
    }

    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); 

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "<script>alert('User registered successfully! You can now login.'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<h1>Register</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<input type="submit" value="Register">
</form>

<!-- Link back to login page -->
<span class="login-link">
    Already have an account? <a href="login.php">Login</a>
</span>

</div>
</body>
</html>