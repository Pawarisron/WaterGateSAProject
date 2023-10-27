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

    $sql = "SELECT
    cl.command_ID,
    cl.employee_com_ID,
    cl.watergate_com_ID,
    wn.gate_name,
    cl.note,
    clt.command_time
FROM
    commands_log AS cl
JOIN
    commands_log_time AS clt
ON
    cl.command_ID = clt.command_time_ID
JOIN
    watergate_name AS wn
ON
    cl.watergate_com_ID = wn.watergate_name_ID;";


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
      <div class="assignment-table"  style="text-align: center; margin: 20px;">
        <h2 style="margin: 20px;">รายการการสั่งงานประจำวัน</h2>
        <div class="panel panel-default table-responsive">
          <table class="table table-striped table-bordered templatemo-user-table">
            <thead>
              <tr>
                <td>ID</td>
                <td>วันที่</td>
                <td>ประตูน้ำ</td>
                <td>คำสั่ง</td>
              </tr>
            </thead>
            <tbody>
            <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr>';
                    echo '<td>' . $row['command_ID'] . '</td>';
                    echo '<td>' . $row['command_time'] . '</td>';
                    echo '<td>' . $row['gate_name'] . '</td>';
                    echo '<td><a href="employee-wg-assignment01.php?command_ID=' . $row['command_ID'] . '">รายละเอียดคำสั่ง</a></td>';

                }
                ?>       
            </tbody>
          </table>    
        </div>
      </div>
    </div>

  </div>
  
  <script src="../../js/script.js"></script> 

</body>
</html>