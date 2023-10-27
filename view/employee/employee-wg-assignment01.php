<?php
    session_start();
    require_once '../../db.php';
    if(isset($_SESSION['manager_login'])){
        echo 'MANAGER';
    }
    else if($_SESSION['employee_login']){
        echo 'EMPLOYEE';
    }
    else{
        echo 'ERROR';
        header('location: login.php');
    }

    
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href='https://font.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet' type='text/css'>
  <link href="../../css/font-awesome.min.css" rel="stylesheet">
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/templatemo-style.css" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="file/ผังระบายตะวันออก3.xlsx" rel="filesheet">
  <title>Water Gate Assignment Employee/Staff</title>
</head>

<body>  
  <!-- Left column -->
  <div class="templatemo-flex-row">
    <div class="templatemo-sidebar">
      <header class="templatemo-site-header">
        <h1>ระบบจัดการประตูระบายน้ำฝั่งตะวันออก</h1>
        <p>สำนักงานชลประทานที่ 11</p>
      </header>
      
      <nav class="templatemo-left-nav">          
        <ul>
          <li><a href="employee-home.php"><i class='bx bx-home' ></i> หน้าหลัก</a></li>
          <li><a href="employee-wg-reporter.php"><i class='bx bx-notepad'></i> บันทึกระดับน้ำประจำวัน</a></li>
          <li><a href="#" class="active"><i class='bx bx-briefcase-alt-2'></i> ตรวจสอบการสั่งงาน</a></li>
          <li><a href="../../logout.php"><i class='bx bx-log-out'></i> ออกจากระบบ</a></li>
        </ul>  
      </nav>
    </div>
    <!-- Main content --> 
    <div class="templatemo-content col-1 light-gray-bg">
      <div class="templatemo-top-nav-container">
        <div class="row">
          <nav class="templatemo-top-nav col-lg-12 col-md-12">
            <!--header-->
            <ul class="text-uppercase">
              <h3>royal irrigation department</h3>
            </ul>
          </nav>
        </div>
      </div>
      <div class="assignment-sheet"  style="text-align: center; margin: 20px;">
        <h2 style="margin: 20px;">รายการการสั่งงานประจำวัน</h2>
        <div class="table-responsive" style="padding: 20px;">
          <table class="table">
            <tbody style="text-align: left; padding-left: 40px;">
              <tr>
                <td><b>ID</b></td>
                <td>WG001</td>
              </tr>
              <tr>
                <td><b>ชื่อประตู</b></td>
                <td>ประตูที่ 1</td>
              </tr>
              <tr>
                <td><b>สถานะ</b></td>
                <td>วิกฤติ</td>
              </tr>
              <tr>
                <td><b>วันที่ออกคำสั่ง</b></td>
                <td>22/09/2023 18:45</td>
              </tr>
              <tr>
                <td><b>วันเวลาเปิด</b></td>
                <td>-</td>
              </tr>
              <tr>
                <td><b>วันเวลาปิด</b></td>
                <td>-</td>
              </tr>
              <tr>
                <td><b>หมายเหตุ</b></td>
                <td>ปริมาณน้ำระบายออก 0.50 ม.รทก. โดยเทียบกับอัตราการไหลปัจจุบัน<br>กรุณาเปิดประตูระบายน้ำภายในเวลา 08:00 น. วันที่ 23/09/2023</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="panel panel-default margin-10">
          <div class="panel-heading">
            <h2>อัพเดตหลังเปิดประตูน้ำ</h2>
          </div>
          <div class="panel-body">
            <!--ฝากเติมตรง action ด้วยต้าฟ-->
            <form action="" class="templatemo-login-form" style="text-align: left;">
              <div class="form-group">
                <label for="timestamp">วันเวลาเปิด</label>
                <input name='timestamp' type="datetime-local" class="form-control" id="timestamp" placeholder="">
              </div>
              <div class="form-group">
                <label for="timestamp">วันเวลาปิด</label>
                <input name='timestamp' type="datetime-local" class="form-control" id="timestamp" placeholder="">
              </div>
              <div class="form-group" style="text-align: right; padding-top: 20px;">
                <button name='submitAssignment' type="submit" class="btn-primary" style="font-size: 16px;">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
  
  <script src="../../js/script.js"></script> 

</body>
</html>