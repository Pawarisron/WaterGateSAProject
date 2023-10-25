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
  <title>Water Gate Reporter Employee/Staff</title>
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
          <li><a href="#" class="active"><i class='bx bx-notepad'></i> บันทึกระดับน้ำประจำวัน</a></li>
          <li><a href="employee-water-report.php"><i class='bx bxs-report'></i> รายงานบันทึกระดับน้ำทั้งหมด</a></li>
          <li><a href="employee-wg-assignment.php"><i class='bx bx-briefcase-alt-2'></i> ตรวจสอบการสั่งงาน</a></li>
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
      <form action="">
        <div class="water-gate-reporter" style="text-align: left; margin: 20px;">
          <h2 style="margin: 20px;">บันทึกระดับน้ำประจำวัน</h2>
          <div class="col-lg-6 col-md-6 form-group">  
            <!--ไปหาโค้ดที่มันดึงค่าใส่อัตโนมัติดู ถ้าไม่ได้ก็ค่อยให้กรอกก็ได้-->                
            <label for="inputFirstName">ชื่อ</label>
            <input type="text" class="form-control" id="inputFirstName" placeholder="">                  
          </div>
          <div class="col-lg-6 col-md-6 form-group">                  
            <label for="inputLastName">นามสกุล</label>
            <input type="text" class="form-control" id="inputLastName" placeholder="">                  
          </div>
          <div class="col-lg-6 col-md-6 form-group">                  
            <label for="inputDate">วันที่</label>
            <input type="text" class="form-control" id="inputDate" placeholder="">                  
          </div>
          <div class="col-lg-6 col-md-6 form-group">                  
            <label for="inputTime">เวลา</label>
            <input type="text" class="form-control" id="inputTime" placeholder="">                  
          </div>
          <!--หาวิธีดึงชื่อประตูระบายน้ำมาเป็น option-->
          <div class="col-lg-6 col-md-6 form-group"> 
            <label class="control-label templatemo-block">Single Selection Control</label>                 
            <select class="form-control">
              <option value="html">ประตูน้ำที่ 1</option>
              <option value="plain">ประตูน้ำที่ 2</option>                      
            </select>
          </div>
          <div class="col-lg-12 has-success form-group">                  
            <label for="inputWaterFlow">อัตราการไหล (ลบ.ม./วินาที)</label>
            <input type="float" class="form-control" id="inputWaterFlow" required>                  
          </div>
          <div class="col-lg-12 has-success form-group">                  
            <label for="inputUpstream">ระดับน้ำเหนือน้ำ (ม.รทก.)</label>
            <input type="float" class="form-control" id="inputUpstream" required>                  
          </div>
          <div class="col-lg-12 has-success form-group">                  
            <label for="inpuDownpstream">ระดับน้ำท้ายน้ำ (ม.รทก.)</label>
            <input type="float" class="form-control" id="inputDownstream" required>                  
          </div>
        </div>
        <div style="margin: 480px 20px 20px 35px;">
          <button type="submit" class="btn-primary" style="font-size: 16px;">Submit</button>
        </div>
      </form>
    </div>

  </div>
  
  <script src="../../js/script.js"></script> 

</body>
</html>