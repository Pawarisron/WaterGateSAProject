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

    $sql = "SELECT wg.*, wn.gate_name, dr.upstream, dr.downstream, dr.flow_rate
    FROM watergate wg
    JOIN watergate_name wn ON wg.watergate_ID = wn.watergate_name_ID
    JOIN (
        SELECT dr1.watergate_report_ID, MAX(drt.report_date) AS max_report_date
        FROM daily_report dr1
        JOIN daily_report_time drt ON dr1.report_ID = drt.report_time_ID
        WHERE dr1.watergate_report_ID IN (
            SELECT watergate_ID FROM watergate WHERE gate_status = 1
        )
        GROUP BY dr1.watergate_report_ID
    ) recent_dr ON wg.watergate_ID = recent_dr.watergate_report_ID
    JOIN daily_report dr ON recent_dr.watergate_report_ID = dr.watergate_report_ID
    JOIN daily_report_time drt ON dr.report_ID = drt.report_time_ID AND drt.report_date = recent_dr.max_report_date
    WHERE wg.gate_status = 1;";
    
    
    
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
  <title>Daily Command Manager</title>
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
            <thead style="text-align: center;">
              <tr>
                <td>ID</td>
                <td>ชื่อประตูระบายน้ำ</td>
                <td>สถานะปัจจุบัน</td>
                <td>ระดับน้ำเหนือน้ำ(ม.รทก.)</td>
                <td>ระดับน้ำท้ายน้ำ(ม.รทก.)</td>
                <td>เกณฑ์ควบคุมระดับน้ำเหนือน้ำ (ม.รทก.)</td>
                <td>ดำเนินการแก้ไข</td>
              </tr>
            </thead>
            <tbody style="text-align: center;">
              <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr>';
                    echo '<td>' . $row['watergate_ID'] . '</td>';
                    echo '<td>' . $row['gate_name'] . '</td>';
                    $gateStatus = $row['gate_status'];
                    $statusLabel = '';
                    switch ($gateStatus) {
                        case 0:
                            $statusLabel = "ปกติ";
                            break;
                        case 1:
                            $statusLabel = "วิกฤติ";
                            break;
                        case 2:
                            $statusLabel = "กำลังแก้ไข";
                            break;
                        case 3:
                            $statusLabel = "รอตรวจสอบ";
                            break;
                        default:
                            $statusLabel = "ปกติ";
                    }
                    echo '<td>' . $statusLabel . '</td>';
                    echo '<td>' . $row['upstream'] . '</td>';
                    echo '<td>' . $row['downstream'] . '</td>';
                    echo '<td>' . $row["criterion"] . '</td>';
                    // $_SESSION['watergate_ID'] = $row['watergate_ID'];
                    
                    // echo '<td><a href="manager-assignment-order01.php">สั่งการ</a></td>';
                    echo '<td><a href="manager-assignment-order01.php?watergate_ID=' . $row['watergate_ID'] . '">สั่งการ</a></td>';

                    

                    
                    
                    echo '</tr>';
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