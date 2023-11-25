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

    //get parameter
    $cmd_ID = $_GET['cmd_ID'];

    $sql = "SELECT cl.*, cr.amount, assi.cmd_time, f.gate_name as out_gate, t.gate_name as in_gate
    FROM commands_log AS cl
    JOIN cmd_route AS cr ON cl.cmd_ID = cr.cmd_ID AND cl.cmd_order = cr.cmd_order
    JOIN watergate AS f ON cr.from_ID_gate = f.watergate_ID 
    JOIN watergate AS t ON cr.to_ID_gate = t.watergate_ID
    JOIN assign_time AS assi ON cl.cmd_ID = assi.cmd_ID
    WHERE cl.cmd_ID = :cmd_ID";

    //get data from DB
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":cmd_ID", $cmd_ID);
    
    $stmt->execute();
    $result = $stmt->fetchAll();
// ?>


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
            <?php foreach($result as $row): ?>
              <tbody style="text-align: left; padding-left: 40px;">
                <tr>
                  <td><b>Command ID</b></td>
                  <td><?php echo $row['cmd_ID']; ?></td>
                </tr>
                <tr>
                  <td><b>Command order</b></td>
                  <td><?php echo $row['cmd_order']; ?></td>
                </tr>
                <tr>
                  <td><b>ชื่อประตูปล่อยน้ำ</b></td>
                  <td><?php echo $row['out_gate']; ?></td>
                </tr>
                <tr>
                  <td><b>ชื่อประตูรับน้ำ</b></td>
                  <td><?php echo $row['in_gate']; ?></td>
                </tr>
                <tr>
                  <td><b>สถานะ</b></td>
                  <td style="color: <?php echo $row['cmd_status'] == 0 ? 'red' : 'green'; ?>">
                    <?php echo $row['cmd_status'] == 0 ? "อยู่ระหว่างการดำเนินการ" : "ดำเนินการแล้ว"; ?>
                  </td>
                </tr>
                <tr>
                  <td><b>วันที่ออกคำสั่ง</b></td>
                  <td><?php echo $row['cmd_time']; ?></td>
                </tr>
                <tr>
                  <td><b>วันเวลาเปิด</b></td>
                  <td><?php echo $row['open_time'] == null ? "ยังไม่ลงเวลา" : $row['open_time']; ?></td>
                </tr>
                <tr>
                  <td><b>วันเวลาปิด</b></td>
                  <td><?php echo $row['close_time'] == null ? "ยังไม่ลงเวลา" : $row['close_time']; ?></td>
                </tr>
                <tr>
                  <td><b>ปริมาณน้ำระบายออก</b></td>
                  <td><?php echo $row['amount']; ?> ม.รทก.</td>
                </tr>
                <tr>
                  <td><b>หมายเหตุ</b></td>
                  <td><?php echo $row['note']; ?></td>
                </tr>
                <tr>
                  <td> </td>
                  <td> </td>
                </tr>
              </tbody>
            <?php endforeach; ?> 
          </table>
        </div>

      

        <div class="form-group" style="text-align: right; padding-top: 20px;">
        
        <form id="deleteForm" action="manager-assignment-check02.php">

          <input type="hidden" name="cmd_ID" value= <?php echo $cmd_ID?>> 

          <button class="btn-primary" style="font-size: 16px; margin-right: 20px;" >Delete</button>
        </form>
        </div>
      </div>
    </div>

  </div>
  
  <script src="../../js/script.js"></script> 

</body>
</html>