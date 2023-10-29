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
  <title>Command Management Manager</title>
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
          <li><a href="manager-assignment-order.php"><i class='bx bx-briefcase-alt-2'></i> การสั่งการประจำวัน</a></li>
          <li><a href="#" class="active"><i class='bx bx-terminal'></i> บันทึกการสั่งงานทั้งหมด</a></li>
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
      <div class="panel panel-default margin-10" style="text-align: center; margin: 20px; padding: 20px;">
        <h2 style="text-align: left;"><a href="manager-assignment-check.php" class="templatemo-link"><i class='bx bx-arrow-back'></i></a></h2>
        <h2>บันทึกการสั่งงาน</h2>
        <div class="table-responsive" style="padding: 20px;">
          <table class="table">
            <tbody style="text-align: left; padding-left: 40px;">
              <tr>
                <td><b>ID</b></td>
                <td><?php echo $result['command_ID']; ?></td>
              </tr>
              <tr>
                <td><b>ชื่อประตู</b></td>
                <td><?php echo $result['gate_name']; ?></td>
              </tr>
              <tr>
                <td><b>สถานะ</b></td>
                <td><?php echo $result['gate_status'] == 0 ? "ปกติ" : "วิกฤติ"; ?></td>
              </tr>
              <tr>
                <td><b>วันที่ออกคำสั่ง</b></td>
                <td><?php echo $result['command_time']; ?></td>
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
                <td><b>ปริมาณน้ำระบายออก</b></td>
                <td>0.50</td>
              </tr>
              <tr>
                <td><b>หมายเหตุ</b></td>
                <td><?php echo $result['note']; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="form-group" style="text-align: right; padding-top: 20px;">
          <button name='deleteButton' type="delete" class="btn-primary" style="font-size: 16px; margin-right: 20px;">Delete</button>
        </div>
      </div>
    </div>

  </div>
  
  <script src="../../js/script.js"></script> 

</body>
</html>