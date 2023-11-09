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
    // require_once '../../controller/updateTable.php';
    // updateGateStatus($conn);

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
          <li><a href="#" class="active"><i class='bx bx-home' ></i> หน้าหลัก</a></li>
          <li><a href="manager-assignment-order.php"><i class='bx bx-briefcase-alt-2'></i> การสั่งการประจำวัน</a></li>
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
      <div class="water-gate-report" style="text-align: center; margin: 20px;">
        <h2 style="margin: 20px;">รายงานบันทึกระดับน้ำทั้งหมด</h2>
        <div class="panel panel-default table-responsive">
          <table class="table table-striped table-bordered templatemo-user-table"  style="text-align: center;">
            <thead>
              <tr>
                <td>ID</td>
                <td>ชื่อประตูระบายน้ำ</td>
                <td>สถานะปัจจุบัน</td>
                <td>วันที่บันทึกผลล่าสุด</td>
                <td>อัตราการไหล (ลบ.ม./วินาที)</td>
                <td>ระดับน้ำเหนือน้ำ (ม.รทก.)</td>
                <td>ระดับน้ำท้ายน้ำ (ม.รทก.)</td>
                
              </tr>
            </thead>
            <tbody>
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
                    echo '<td>' . $row['report_time'] . '</td>';
                    echo '<td>' . $row['flow_rate'] . '</td>';
                    echo '<td>' . $row['upstream'] . '</td>';
                    echo '<td>' . $row['downstream'] . '</td>';
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