<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="login.css">
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>

  <div class="navbar">
    <div class="logoimg1">
      <img src="assets/bmilogo512h.png" alt="logo" class="bmilogo">
    </div>
    <div class="logoimg2">
      <img src="assets/User.png" alt="user" class="user">
    </div>
  </div>

  <div class="signin">
    <?php
    if (isset($_POST["login"])){
      $email = $_POST["email"];
      $password = $_POST["password"];
        require_once "database.php";
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if ($user) {
            if (password_verify($password, $user["password"])){
              header("Location: index.php"); 
              die();
            } else {
              echo "<div class='alert alert-danger'>Password is incorrect</div>";
            }
        } else {
          echo "<div class='alert alert-danger'>Email does not match</div>";
        }
    }
    ?>
    

    <form action="login.php" method="post">
      <h1>เข้าสู่ระบบ</h1>

      <div class="form-group">
        <h3>ชื่อผู้ใช้งาน :</h3>
        <div class="input-with-icon">
          <input type="text" name="email" id="email" placeholder="กรอกชื่อผู้ใช้งาน" class="form-control">
        </div>
      </div>

      <div class="form-group">
        <h3>รหัสผ่าน :</h3>
        <div class="input-with-icon">
          <input type="password" name="password" id="password" placeholder="รหัสผ่าน" class="form-control">
        </div>
      </div>

      <div class="form-group">
        <div class="forgotpass" href=""> ลืมรหัสผ่าน </div>
      </div>

      <div class="action-buttons">
        <button type="submit" name="login" class="login-button btn btn-primary" id="loginBtn">ล็อกอิน</button>
      </div>
    </form> 


    <div class="register">
      <p>คุณยังไม่มีบัญชีใช่ไหม? <a href="register.php" class="register-link">คลิกที่นี่</a></p>
    </div>
  </div>

  <script src="login.js"></script>
</body>
</html>
