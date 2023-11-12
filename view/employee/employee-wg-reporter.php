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
    function alertRecord() {
      alert("บันทึกระดับน้ำประจำวันสำเร็จ");
    }
  </script>
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
      <form action="../../controller/employee-wg-reporter-controller.php" method='post' onsubmit="return validateForm()">
        <div class="water-gate-reporter" style="text-align: left; margin: 20px;">
          <h2 style="text-align: center;">บันทึกระดับน้ำประจำวัน</h2>
          <!--หาวิธีดึงชื่อประตูระบายน้ำมาเป็น option-->
          
          <div class="col-lg-6 col-md-6 form-group"> 
            <label class="control-label templatemo-block">เลือกประตูน้ำ</label>  

             <select name = "watergate_name" class="form-control" require>


             <?php
              $sql = "SELECT * FROM watergate";
              $result = $conn->query($sql);
              // $result->execute();
              while ($row = $result->fetch()):
              ?>
              <option value="<?php echo $row['watergate_ID']; ?>"> 
                <?php echo $row['gate_name'] ?>
              </option>
              <?php 
                endwhile;
              ?>



            </select> 


          </div>
          <div class="col-lg-6 col-md-6 form-group">
            <label for="timestamp">เวลาที่บันทึกระดับน้ำ</label>
            <input name='timestamp' type="datetime-local" class="form-control" id="timestamp" placeholder="" required>
          </div>
          <div class="col-lg-12 has-success form-group">                  
            <label for="inputWaterFlow">อัตราการไหล (ลบ.ม./วินาที)</label>
            <input name = 'flow_rate'type="number" step="0.000001" class="form-control" id="inputWaterFlow" required>                  
          </div>
          <div class="col-lg-12 has-success form-group">                  
            <label for="inputUpstream">ระดับน้ำเหนือน้ำ (ม.รทก.)</label>
            <input name='upstream'type="number" step="0.000001" class="form-control" id="inputUpstream" required>                  
          </div>
          <div class="col-lg-12 has-success form-group" style="padding-bottom: 40px;">                  
            <label for="inpuDownpstream">ระดับน้ำท้ายน้ำ (ม.รทก.)</label>
            <input name = 'downstream'type="number" step="0.000001" class="form-control" id="inputDownstream" required>                  
          </div>
          <div class="form-group" style="margin: 15px;">
            <button name='submitReport' type="submit" class="btn-primary" style="font-size: 16px;">Submit</button>
          </div>
        </div>
        
      </form>
      <script>
       function validateForm() {
          var flow_rate = document.getElementById('inputWaterFlow').value;
          var upstream = document.getElementById('inputUpstream').value;
          var downstream = document.getElementById('inputDownstream').value;
          var timestamp = document.getElementById('timestamp').value;

          var errorMessage = '';

          if (flow_rate < 0) {
              errorMessage += "อัตราการไหลน้ำไม่สามารถมีค่าน้อยกว่า 0\n\n";
          }
          if (upstream < 0) {
              errorMessage += "ค่าเหนือน้ำไม่สามารถมีค่าน้อยกว่า 0\n\n";
          }
          if (downstream < 0) {
              errorMessage += "ค่าท้ายน้ำไม่สามารถมีค่าน้อยกว่า 0\n\n";
          }

          var selectedDate = new Date(timestamp);
          var currentDate = new Date();

          if (selectedDate > currentDate) {
              errorMessage += "กรุณาเลือกวันที่จากวันปัจจุบันหรือวันที่ผ่านมา\n\n";
          }

          if (errorMessage !== '') {
              alert(errorMessage);
              return false;
          }
          return true; 
      }

      </script>


    </div>

  </div>

</body>
</html>