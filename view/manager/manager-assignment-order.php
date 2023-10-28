<?php
    /*session_start();
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
    }*/

    
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
  <title>Homepage Manager</title>
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
          <li><a href="manager-home.php"><i class='bx bx-home' ></i> หน้าหลัก</a></li>
          <li><a href="#" class="active"><i class='bx bx-briefcase-alt-2'></i> การสั่งการประจำวัน</a></li>
          <li><a href="manager-assignment-check.php"><i class='bx bx-terminal'></i> บันทึกการสั่งงานทั้งหมด</a></li>
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
      <div class="water-gate-critical-table"  style="text-align: center; margin: 20px;">
        <h2 style="margin: 20px;">ประตูน้ำที่อยู่สถานะวิกฤติ</h2>
        <div class="panel panel-default table-responsive">
          <table class="table table-striped table-bordered templatemo-user-table">
            <thead>
              <tr>
                <td>ID</td>
                <td>ชื่อประตูระบายน้ำ</td>
                <td>สถานะปัจจุบัน</td>
                <td>ระดับน้ำเหนือน้ำ<br>(ม.รทก.)</td>
                <td>เกณฑ์ควบคุมระดับน้ำ<br>เหนือน้ำ (ม.รทก.)</td>
                <td>ระดับน้ำท้ายน้ำ<br>(ม.รทก.)</td>
                <td>เกณฑ์ควบคุมระดับน้ำ<br>ท้ายน้ำ (ม.รทก.)</td>
                <td>ดำเนินการแก้ไข</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>WG001</td>
                <td>ประตูน้ำที่ 1</td>
                <td>วิกฤติ</td>
                <td>1.04</td>
                <td>1.20</td>
                <td>0.98</td>
                <td>0.80</td>
                <td><a href="manager-assignment-order01.php" class="templatemo-edit-btn">สั่งการ</a></td>
              </tr>
              <tr>
                <td>WG002</td>
                <td>ประตูน้ำที่ 2</td>
                <td>วิกฤติ</td>
                <td>1.65</td>
                <td>1.20</td>
                <td>0.46</td>
                <td>0.80</td>
                <td><a href="manager-assignment-order01.php" class="templatemo-edit-btn">สั่งการ</a></td>
              </tr>
            </tbody>
          </table>    
        </div>
      </div>
    </div>

  </div>
  
  <script src="../../js/script.js"></script> 

</body>
</html>