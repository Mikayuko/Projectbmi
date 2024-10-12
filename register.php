<?php
if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $recheckPassword = $_POST["recheckPassword"];
    $username = $_POST["username"];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $errors = array();

    if (empty($email) OR empty($password) OR empty($recheckPassword)) {
        array_push($errors, "All fields are required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    if (strlen($password) < 4) {
        array_push($errors, "Password must be at least 4 characters long");
    }
    if ($password !== $recheckPassword) {
        array_push($errors, "Password does not match");
    }
    require_once "database.php";
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn ,$sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount > 0){
        array_push($errors,"Email already exists!");
    }
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $preparestmt = mysqli_stmt_prepare($stmt, $sql);
        if ($preparestmt) {
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $passwordHash);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'> You are registered successfully. </div>";
        } else {
            die("Something went wrong");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500&display=swap" rel="stylesheet">
    <title>ลงทะเบียนผู้ใช้งาน</title>
</head>
<body>
    <div>
        <div class="navbar">
            <div class="logoimg1">
                <img src="assets/bmilogo512h.png" alt="logo" class="bmilogo">
            </div>
            <div class="logoimg2">
                <img src="assets/user.png" alt="user" class="user">
            </div>
        </div>

        <div class="signin">
            <form action="register.php" method="post">
                <h1>ลงทะเบียนผู้ใช้งาน</h1>

                <div class="form-group">
                    <h3>Email :</h3>
                    <div class="input-with-icon">
                        <input type="text" name="email" id="email" placeholder="กรอกอีเมล" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <h3>รหัสผ่าน :</h3>
                    <div class="input-with-icon">
                        <input type="password" name="password" id="password" placeholder="สร้างรหัสผ่าน" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <h3>ยืนยันรหัสผ่าน :</h3>
                    <div class="input-with-icon">
                        <input type="password" name="recheckPassword" id="recheckPassword" placeholder="ยืนยันรหัสผ่าน" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <h3>ชื่อผู้ใช้งาน :</h3>
                    <div class="input-with-icon">
                        <input type="text" name="username" id="username" placeholder="กรอกชื่อผู้ใช้งาน" class="form-control">
                    </div>
                </div>

                <div class="action-buttons">
                    <button type="submit" name="submit" class="register-button">ลงทะเบียน</button>
                    <a href="login.php" class="login-button">เข้าสู่ระบบ</a>
                </div>

                </div>
            </form>
        </div>
    </div>
    <script src="register.js"></script>
</body>
</html>
