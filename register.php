<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost";
$username = "u299560388_651104";
$password = "UP3292Bg";
$dbname = "u299560388_651104"; 

// Create connection using mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        // รับค่าจากฟอร์ม
        $username = $_POST['name'];
        $birthday = $_POST['birthday'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $SexID = $_POST['Sex'];
        $p_password = $_POST['password'];
        $TitleID = $_POST['initial'];

        // ตรวจสอบให้แน่ใจว่าค่าที่ส่งมานั้นไม่ว่างเปล่า
        if (!empty($username) && !empty($birthday) && !empty($email) && !empty($phone) && !empty($SexID) && !empty($p_password) && !empty($TitleID)) {
            // ใช้ prepared statement เพื่อป้องกัน SQL Injection
            $stmt = $conn->prepare("INSERT INTO register (Name, Email, Password, Phone, SexID, Data, TitleID) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $username, $email, $p_password, $phone, $SexID, $birthday, $TitleID);
            

            // ตรวจสอบการเพิ่มข้อมูล
            if ($stmt->execute() === TRUE) {
                echo '<script>alert("Success insert data")</script>';
                header('Location: login.php'); // เปลี่ยนเส้นทางไปยังหน้าล็อกอิน
                exit(); // หยุดการทำงานของสคริปต์หลังจากเปลี่ยนเส้นทาง
            } else {
                echo "<script>alert('Failed to insert data: " . $stmt->error . "')</script>";
            }

            // ปิด statement
            $stmt->close();
        } else {
            echo "<script>alert('Please fill all required fields')</script>";
        }
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงทะเบียน</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- Boxicons for Icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Prompt', sans-serif;
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

        .title {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5rem;
            color: #333;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-group input, .form-group select {
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

        .form-group input:focus, .form-group select:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 38px;
            font-size: 1.3rem;
            color: #007bff;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            font-size: 1rem;
            border-radius: 30px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            transition: 0.3s;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            box-shadow: 0 5px 15px rgba(0, 91, 187, 0.5);
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #565e64;
            box-shadow: 0 5px 15px rgba(86, 94, 100, 0.5);
        }

        .radio-group {
            display: flex;
            align-items: center;
            gap: 15px;
            padding-left: 45px;
            margin-top: 10px; /* เพิ่มระยะห่างข้างบน */
        }

        .radio-container {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 16px;
            user-select: none;
        }

        .radio-container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #eee;
            border-radius: 50%;
        }

        .radio-container:hover input ~ .checkmark {
            background-color: #ccc;
        }

        .radio-container input:checked ~ .checkmark {
            background-color: #007bff;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .radio-container input:checked ~ .checkmark:after {
            display: block;
        }

        .radio-container .checkmark:after {
            top: 7px;
            left: 7px;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: white;
        }

        /* ปรับระยะห่างของชื่อ-นามสกุล */
        .name-group {
            margin-top: -10px; /* ขยับขึ้นเล็กน้อย */
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

<div class="container"> 
    <h1 class="title">ลงทะเบียน</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form-group">
            <label for="initial">คำนำหน้า</label>
            <div class="radio-group">
                <label class="radio-container">
                    <input type="radio" name="initial" value="Mr." checked> นาย
                    <span class="checkmark"></span>
                </label>
                <label class="radio-container">
                    <input type="radio" name="initial" value="Ms."> นาง
                    <span class="checkmark"></span>
                </label>
                <label class="radio-container">
                    <input type="radio" name="initial" value="Miss."> นางสาว
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>
        <div class="form-group name-group">
            <label for="name">ชื่อ-นามสกุล</label>
            <input type="text" name="name" class="form-control" required>
            <i class='bx bxs-user-detail'></i>
        </div>
        <div class="form-group">
            <label for="birthday">วัน-เดือน-ปีเกิด</label>
            <input type="date" name="birthday" class="form-control" required>
            <i class='bx bxs-calendar'></i>
        </div>
        <div class="form-group">
            <label for="Sex">เพศ</label>
            <select name="Sex" class="form-control" required>
                <option value="">เลือกเพศ</option>
                <option value="1">ชาย</option>
                <option value="2">หญิง</option>
                <option value="3">อื่น</option>
            </select>
            <i class='bx bxs-user'></i>
        </div>
        <div class="form-group">
            <label for="phone">เบอร์โทร</label>
            <input type="tel" name="phone" class="form-control" required>
            <i class='bx bxs-phone'></i>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
            <i class='bx bxs-envelope'></i>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
            <i class='bx bxs-lock-alt'></i>
        </div>
        
        <input type="hidden" name="save" value="Yes">
        <div class="button-group">
            <button type="submit" class="btn btn-primary" name="add">บันทึกข้อมูล</button>
            <a href="login.php" class="btn btn-secondary">ย้อนกลับ</a>
        </div>
    </form>
</div>

</body>
</html>
