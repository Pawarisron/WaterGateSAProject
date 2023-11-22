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

    

  
    $cmd_ID = $_GET["cmd_ID"];



    
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
        <h2>ยืนยันการลบ</h2>
        <div class="table-responsive" style="padding: 20px;">
          <table class="table">
            <tbody style="text-align: center; padding-left: 40px;">
              <tr>
                <td><b>คุณต้องการจะบันทึกของคำสั่งนี้หรือไม่ลบหรือไม่</b></td>
              </tr>
              <tr>
                <!-- <td><b><?php echo $cmd_ID ?></b></td> -->
              </tr>
            </tbody>
          </table>
        </div>
        

        <div class="form-group" style="text-align: center; padding-top: 20px;">
        
          <form method="post" >
            <button name='confirmButton' type="delete" class="btn-primary" style="font-size: 16px; margin-right: 20px;">Confirm</button>
          </form>
          <?php  
          if ($_SERVER["REQUEST_METHOD"] == "POST"){

              //## อัพเดทค่าประตูให้เก็บเป็นก่อนจะสั่งCMD ##
              $eSql = "SELECT * FROM cmd_route WHERE cmd_ID = :cmd_ID";
              $stmt = $conn->prepare($eSql);
              $stmt->bindParam(":cmd_ID", $cmd_ID);
              $stmt->execute();
              $result = $stmt->fetchAll();

              // $editGateArray = array();

              $nSql = "SELECT from_ID_gate FROM cmd_route WHERE cmd_ID <> :cmd_ID";
                $stmt = $conn->prepare($nSql);
                $stmt->bindParam(":cmd_ID", $cmd_ID);
                $stmt->execute();
                $gateInCommand = $stmt->fetchAll();
              
              function in_array_2d($value, $array) {
                foreach ($array as $subarray) {
                    if (in_array($value, $subarray)) {
                        return true;
                    }
                }
                return false;
              }

              foreach ($result as $row){
                $watergate_ID = $row["from_ID_gate"];

                $wSql = "SELECT * , (criterion - upstream) as 'd_up', ( criterion - downstream) as d_down 
                FROM watergate JOIN (SELECT upstream,downstream FROM `daily_report` WHERE watergate_ID = :watergate_ID ORDER by report_time DESC LIMIT 1) as R
                WHERE watergate_ID = :watergate_ID";

                $stmt = $conn->prepare($wSql);
                $stmt->bindParam(":watergate_ID", $watergate_ID);
                $stmt->execute();
                $water = $stmt->fetch();
                
                //เช็ค gate ต้องไม่ใช้ gate ที่ถูก CMD อื่นๆสั่งอยู่
                if(! in_array_2d($watergate_ID, $gateInCommand)){
                  if ($water['d_up'] <= 0 || $water['d_down'] <= 0){
                    //เกินเกณ
                    $newStatus = 1;
                    // echo $row["from_ID_gate"] . "-" . $newStatus;
                  }
                  else{
                    //ไม่เกินเกณ
                    $newStatus = 0;
                    // echo $row["from_ID_gate"] . "-" . $newStatus;
                  }
                  $u1SQL = "UPDATE watergate set gate_status = :newStatus WHERE watergate_ID = :watergate_ID";
                    $stmt = $conn->prepare($u1SQL);
                    $stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_INT);
                    $stmt->bindParam(':watergate_ID', $watergate_ID, PDO::PARAM_STR);
                    $stmt->execute();
                }
              }
              // ทำการลบข้อมูลหรือกระทำที่เกี่ยวข้องที่นี่
              $dSql = "DELETE FROM commands_log Where cmd_ID = :cmd_ID";
              
                $stmt = $conn->prepare($dSql);
                $stmt->bindParam(":cmd_ID", $cmd_ID);
                $stmt->execute();
                
                header("location: manager-assignment-check.php");
            }
              
              
          
          ?>
          <form action="manager-assignment-check.php">
            <button name='confirmButton' type="delete" class="btn-primary" style="font-size: 16px; margin-right: 20px; margin-top: 20px;">Cancel</button>
          </form>
        </div>
      </div>
    </div>

  </div>
  
  <script src="../../js/script.js"></script> 

</body>
</html>