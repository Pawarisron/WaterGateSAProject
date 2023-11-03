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
    $command_ID = $_GET['command_ID'];
    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once '../../controller/updateTable.php';
    updateGateStatus($conn);


    $sql = "SELECT
    cl.command_ID,
    cl.employee_com_ID,
    cl.watergate_com_ID,
    wn.gate_name,
    cl.note,
    clt.command_time,
    wg.gate_status,
    ctc.closing_time,
    otc.openning_time
FROM
    commands_log AS cl
JOIN
    commands_log_time AS clt
ON
    cl.command_ID = clt.command_time_ID
JOIN
    watergate_name AS wn
ON
    cl.watergate_com_ID = wn.watergate_name_ID
JOIN
    watergate AS wg
ON
    cl.watergate_com_ID = wg.watergate_ID
LEFT JOIN
    closing_time_commands AS ctc
ON
    cl.command_ID = ctc.close_command_ID
LEFT JOIN
    openning_time_commands AS otc
ON
    cl.command_ID = otc.open_command_ID
WHERE
    cl.command_ID = :command_ID";

    

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':command_ID', $command_ID, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch();
   
    
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
      <div class="panel panel-default margin-10" style="text-align: center; margin: 20px; padding: 20px;">
        <h2 style="text-align: left;"><a href="employee-wg-assignment.php" class="templatemo-link"><i class='bx bx-arrow-back'></i></a></h2>
        <h2>รายการการสั่งงานประจำวัน</h2>
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
                <td>
                <?php
                  $status = $result['gate_status'];
                  switch ($status) {
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
                  echo $statusLabel;
                ?>
                </td>
              </tr>
              <tr>
                <td><b>วันที่ออกคำสั่ง</b></td>
                <td><?php echo $result['command_time']; ?></td>
              </tr>
              <tr>
                <td><b>วันเวลาเปิด</b></td>
                <td><?php echo $result['openning_time']; ?></td>
              </tr>
              <tr>
                <td><b>วันเวลาปิด</b></td>
                <td><?php echo $result['closing_time']; ?></td>
              </tr>
              <!--เพิ่มมาใหม่ง้าบ-->
              <tr>
                <td><b>ปริมาณน้ำระบายออก</b></td>
                <td>0.50</td>
              </tr>
              <!---->
              <tr>
                <td><b>หมายเหตุ</b></td>
                <td><?php echo $result['note']; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="panel panel-default margin-10" style="text-align: center; margin: 20px;">
        <div class="panel-heading">
          <h2>อัพเดตหลังเปิดประตูน้ำ</h2>
        </div>
        <div class="panel-body">
          <!--ฝากเติมตรง action ด้วยต้าฟ-->
          <form action="../../controller/employee-wg-assignment01-controller.php" method="post" class="templatemo-login-form" style="text-align: left;">
            <div class="form-group">
              <label for="openTimestamp">วันเวลาเปิด</label>
              <input name='openTimestamp' type="datetime-local" class="form-control" id="timestamp" placeholder="" required>
            </div>
            <div class="form-group">
              <label for="closeTimestamp">วันเวลาปิด</label>
              <input name='closeTimestamp' type="datetime-local" class="form-control" id="timestamp" placeholder="" required>
            </div>
            <input type="hidden" name="command_ID" value="<?php echo $command_ID; ?>">
            <div class="form-group" style="text-align: right; padding-top: 20px;">
              <button name='submitAssignment' type="submit" class="btn-primary" style="font-size: 16px;">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
  
  <script src="../../js/script.js"></script> 

</body>
</html>