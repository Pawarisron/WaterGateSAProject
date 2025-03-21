<?php
  require_once 'db.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/style.css" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Login</title>
</head>

<body>
  <div class="wrapper">
    <form action="controller/logincontroller.php" method='post'>
      <h1>Sign In</h1>
      <p>ระบบจัดการประตูระบายน้ำฝั่งตะวันออก สำนักงานชลประทานที่ 11</p>
      <div class="input-box">
        <input name='employee_ID' type="text" placeholder="UserID" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input name = 'password' type="password" placeholder="Password" required>
        <i class='bx bxs-lock-alt'></i>
      </div>
      <button name ='signin' type="submit" class="btn">Login</button>
    </form>
  </div>
  <script src="js/script.js"></script>
</body>

</html>