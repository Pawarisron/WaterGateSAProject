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
  <script type="text/javascript">
    function alertFinish(){
      alert("บันทึกการสั่งการสำเร็จ");
    }
  </script>
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
      <div class="panel panel-default margin-10" style="text-align: center; margin: 20px; padding: 20px;">
        <h2 style="text-align: left;"><a href="manager-assignment-order.php" class="templatemo-link"><i class='bx bx-arrow-back'></i></a></h2>
        <h2>สร้างเส้นทางระบายน้ำ</h2>
        <div class="table-responsive" style="padding: 20px;">
          <table class="table">
            <tbody style="text-align: left; padding-left: 40px;">
              <tr>
                <td><b>1.</b></td>
                <td>WG001</td>
                <td>ประตูที่ 1</td>
                <td>0.50</td>
                <td style="width: 50%;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
              </tr>
              <tr>
                <td><b>2.</b></td>
                <td>WG002</td>
                <td>ประตูที่ 2</td>
                <td>0.32</td>
                <td style="width: 50%;">เปิดประตูไม่เกิน 08:00 น.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="templatemo-flex-row flex-content-row">
        <div class="col-1">
          <div class="panel panel-default margin-10" style="text-align: center; margin: 20px;">
            <div class="panel-heading">
              <h2>คำนวณปริมาณน้ำระบายออก</h2>
            </div>
            <div class="panel-body">
              <div class="table-responsive" style="padding: 20px;">
                <table class="table">
                  <tbody style="text-align: center; padding-left: 40px;">
                    <tr>
                      <td><b>ID</b></td>
                      <td><b>ชื่อประตู</b></td>
                      <td><b>ปริมาณน้ำที่สามารถรองรับได้</b></td>
                    </tr>
                    <tr style="color: #E14311;">
                      <td>ID ประตูที่เลือก</td>
                      <td>ชื่อประตูที่เลือก</td>
                      <td>เกณฑ์ควบคุมระดับน้ำ-ระดับน้ำปัจจุบัน</td>
                    </tr>
                    <tr>
                      <td>ID ประตูที่อยู่ติดกัน</td>
                      <td>ชื่อประตูที่อยู่ติดกัน</td>
                      <td>เกณฑ์ควบคุมระดับน้ำ-ระดับน้ำปัจจุบัน</td>
                    </tr>
                    <tr>
                      <td>ID ประตูที่อยู่ติดกัน</td>
                      <td>ชื่อประตูที่อยู่ติดกัน</td>
                      <td>เกณฑ์ควบคุมระดับน้ำ-ระดับน้ำปัจจุบัน</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-1">
          <div class="panel panel-default margin-10" style="text-align: center; margin: 20px;">
            <div class="panel-heading">
              <h2>เลือกประตูน้ำถัดไป</h2>
            </div>
            <div class="panel-body">
              <!--ฝากเติมตรง action ด้วยต้าฟ-->
              <form action="" class="templatemo-login-form" style="text-align: left;">
                <div class="col-lg-12 col-md-12 form-group">
                  <label for="wgName">ชื่อประตู</label>
                  <select class="form-control" require>
                    <option value="wgName">ประตูที่ 1</option>
                    <option value="wgName">ประตูที่ 2</option>
                    <!--เฉพาะรอบแรกจะมีตัวเลือกแค่ประตูที่เลือกจากหน้าก่อน-->
                    <!--รอบต่อไปจะเป็นตัวเลือกที่เป็นประตูที่มันอยู่ต่อกัน-->
                  </select>
                </div>
                <div class="col-lg-12 col-md-12 form-group">
                  <label for="timestamp">วันที่</label>
                  <input name='timestamp' type="datetime-local" class="form-control" id="timestamp" placeholder="" required>
                </div>
                <div class="col-lg-12 col-md-12 form-group">
                  <label for="waterQuantity">ปริมาณน้ำระบายออก</label>
                  <input name='waterQuantity' type="number" step="0.000001" class="form-control" id="waterQuantity" placeholder="" required>
                </div>
                <div class="col-lg-12 col-md-12 form-group">
                  <label for="note">หมายเหตุ</label>
                  <textarea class="form-control" id="inputNote" rows="3"></textarea>
                </div>
                <div class="form-group" style="text-align: center; padding-top: 20px;">
                  <button name='nextNode' type="submit" class="btn-primary" style="font-size: 16px;">Next</button>
                  <button name='finishRoute' type="submit" class="btn-primary" style="font-size: 16px; margin-left: 55%" online="alertFinish()">Finish</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="../../js/script.js"></script> 

</body>
</html>