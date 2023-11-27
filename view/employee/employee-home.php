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

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once '../../controller/updateTable.php';
    updateGateStatus($conn);
    
    
    $sql = "
    SELECT w.*, r.*
    FROM watergate w
    INNER JOIN (
        SELECT watergate_ID, MAX(report_time) AS max_report_time
        FROM daily_report
        GROUP BY watergate_ID
    ) latest_reports
    ON w.watergate_ID = latest_reports.watergate_ID
    JOIN daily_report r
    ON latest_reports.watergate_ID = r.watergate_ID AND latest_reports.max_report_time = r.report_time;
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
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
  <title>Homepage Employee/Staff</title>
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
          <li><a href="#" class="active"><i class='bx bx-home' ></i> หน้าหลัก</a></li>
          <li><a href="employee-wg-reporter.php"><i class='bx bx-notepad'></i> บันทึกระดับน้ำประจำวัน</a></li>
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
      <div class="homepage" style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
        <div class="templatemo-flex-row flex-content-row">
          <div class="col-1">
            <a href="employee-wg-reporter.php">
              <div class="panel panel-default margin-10" style="text-align: center; margin: 20px; width: 500px; padding: 40px;">
                <img src="../image/reporter2.png" width="170" height="170" style="padding-top:20px;">
                <h2 style="padding-top:50px;">บันทึกระดับน้ำประจำวัน</h2>
              </div>
            </a>
          </div>
          <div class="col-1">
            <a href="employee-wg-assignment.php">
              <div class="panel panel-default margin-10" style="text-align: center; margin: 20px; width: 500px;  padding: 40px;">
                <img src="../image/assignment2.png" width="200" height="200">
                <h2 style="padding-top: 20px;">ตรวจสอบการสั่งงาน</h2>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>
  
  <script src="../../js/script.js"></script> 

</body>
</html>


