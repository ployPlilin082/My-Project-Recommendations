<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost";
$username = "u299560388_651104"; // เปลี่ยนให้เป็นชื่อผู้ใช้ฐานข้อมูลของคุณ
$password = "UP3292Bg"; // เปลี่ยนให้เป็นรหัสผ่านฐานข้อมูลของคุณ
$dbname = "u299560388_651104"; // เปลี่ยนให้เป็นชื่อฐานข้อมูลของคุณ

// สร้างการเชื่อมต่อโดยใช้ mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['Login'])){

    $username = $_POST["username"];
    $password = $_POST['password'];

    $sql = "SELECT * FROM register WHERE Name = '$username' AND Password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "SQL Error: " . mysqli_error($conn);
    }

// ตรวจสอบผลลัพธ์
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION["user"] = $row["Name"];
            header("Location: movie.php");
        } else {
            echo "User not found.";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

    // ปิดการเชื่อมต่อ
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: #ffffff;
            padding: 40px;
            width: 400px;
            border-radius: 10px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }

        .login-title {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5rem;
            color: #333;
        }

        .input-box {
            display: flex;
            align-items: center;
            position: relative;
            margin-bottom: 20px;
        }

        .input-box input {
            width: 100%;
            padding: 12px 15px;
            padding-left: 45px;
            border: 1px solid #ddd;
            border-radius: 30px;
            outline: none;
            font-size: 1rem;
            transition: 0.3s;
            background-color: #f8f9fa;
        }

        .input-box input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .input-box i {
            position: absolute;
            left: 15px;
            font-size: 1.3rem;
            color: #007bff;
        }

        .remember-forgot-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 5px;
        }

        .remember-me h5 {
            font-size: 0.9rem;
            color: #555;
        }

        .forgot-password h5 {
            font-size: 0.9rem;
            color: #007bff;
            cursor: pointer;
            transition: color 0.3s;
        }

        .forgot-password h5:hover {
            text-decoration: underline;
            color: #0056b3;
        }

        .login-button {
            width: 100%;
            padding: 12px;
            border: none;
            background-color: #007bff;
            color: white;
            font-size: 1rem;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .login-button:hover {
            background-color: #0056b3;
            box-shadow: 0 5px 15px rgba(0, 91, 187, 0.5);
        }

        .register-section {
            text-align: center;
            margin-top: 25px;
            font-size: 0.9rem;
            color: #555;
        }

        .register-button {
            margin-top: 10px;
            padding: 12px;
            border: none;
            background-color: #28a745;
            color: white;
            font-size: 1rem;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .register-button:hover {
            background-color: #218838;
            box-shadow: 0 5px 15px rgba(33, 136, 56, 0.5);
        }

        .error-message {
            color: red;
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 15px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <form class="container" action="login.php" method="POST">
        <h1 class="login-title">Login</h1>

        <?php if (isset($error_message)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
    
        <section class="input-box">
            <input type="text" name="username" placeholder="Username" required>
            <i class='bx bxs-user'></i>
        </section>
        
        <section class="input-box">
            <input type="password" name="password" placeholder="Password" required>
            <i class='bx bxs-lock-alt'></i>
        </section>
        
        <button name = "Login" class="login-button" type="submit">Login</button>
        
        <div class="register-section">
            <h5>Don't have an account?</h5>
            <button class="register-button" type="button" onclick="window.location.href='register.php'">Register</button>
        </div>
    </form>
</body>
</html>
