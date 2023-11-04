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

    if (isset($_SESSION['watergate_ID'])) {
      $watergate_ID = $_SESSION['watergate_ID'];
      
    } 
    echo $watergate_ID;
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
          <table id="dataTable" class="table">
            <tbody style="text-align: left; padding-left: 40px;">
              








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
              <form id="dataForm" class="templatemo-login-form" style="text-align: left;">
                <div class="col-lg-12 col-md-12 form-group">
                  <label for="wgName">ชื่อประตู</label>
                  <select id="wgName" class="form-control" required>



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
                  <textarea class="form-control" id="inputNote" rows="3" required></textarea>
                </div>
                <div class="form-group" style="text-align: center; padding-top: 20px;">
                  <button name="nextNode" type="button" class="btn-primary" style="font-size: 16px;" onclick="addData()">Add</button>
                  <button name="finishRoute" type="submit" class="btn-primary" style="font-size: 16px; margin-left: 55%" onclick="alertFinish()">Finish</button>
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

<script>
 function addData() {
    var wgNameSelect = document.getElementById('wgName');
    
    if (wgNameSelect) {
        var watergate_ID = wgNameSelect.options[wgNameSelect.selectedIndex].value;
        var timestamp = document.getElementById('timestamp').value;
        var waterQuantity = document.getElementById('waterQuantity').value;
        var inputNote = document.getElementById('inputNote').value;
    
        if (watergate_ID === '' || timestamp === '' || waterQuantity === '' || inputNote === '') {
            alert('Please fill in all fields');
            return; // Do not proceed if any of the fields are empty
        }
    
        var dataTable = document.getElementById('dataTable');
        
        // Create a new row
        var newRow = dataTable.insertRow(dataTable.rows.length);
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        var cell4 = newRow.insertCell(3);
    
        // Set values for each cell in the new row
        cell1.innerHTML = watergate_ID;
        cell2.innerHTML = timestamp;
        cell3.innerHTML = waterQuantity;
        cell4.innerHTML = inputNote;
    
        // Clear input fields to prepare for new data entry
        document.getElementById('wgName').value = '';
        document.getElementById('timestamp').value = '';
        document.getElementById('waterQuantity').value = '';
        document.getElementById('inputNote').value = '';
    
        // Update the dropdown with fresh data
        updateWgNameDropdown(watergate_ID);
    
        // Load watergate options again
        loadWatergateOptions(watergate_ID);
        console.log(watergate_ID);
    } else {
        console.error("wgNameSelect is not defined or doesn't exist.");
    }
}





  // เพื่อโหลดข้อมูลใน Dropdown เมื่อหน้าเว็บโหลด
  document.addEventListener("DOMContentLoaded", function () {
    loadWatergateOptions(<?php echo json_encode($watergate_ID); ?>);
  });

  function loadWatergateOptions(watergateID) {
    const wgNameSelect = document.querySelector('#wgName');

    // สร้าง XMLHttpRequest เพื่อโหลดข้อมูลจากเซิร์ฟเวอร์และเพิ่มตัวเลือกใน Dropdown
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `load_watergate_options.php?watergate_ID=${watergateID}`, true);

    xhr.onload = function () {
      if (xhr.status === 200) {
        const options = JSON.parse(xhr.responseText);

        // เคลียร์ตัวเลือกเดิม
        wgNameSelect.innerHTML = '';

        // เพิ่มตัวเลือกใหม่
        for (const option of options) {
          const optionElement = document.createElement("option");
          optionElement.value = option.value;
          optionElement.textContent = option.text;
          wgNameSelect.appendChild(optionElement);
        }
      }
    };

    xhr.send();
  }

  function updateWgNameDropdown(watergateID) {
    const wgNameSelect = document.getElementById('wgName');

    // สร้าง XMLHttpRequest เพื่ออัปเดต dropdown
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `load_watergate_options.php?watergate_ID=${watergateID}`, true);

    xhr.onload = function () {
      if (xhr.status === 200) {
        const options = JSON.parse(xhr.responseText);

        // เคลียร์ตัวเลือกเดิม
        wgNameSelect.innerHTML = '';

        // เพิ่มตัวเลือกใหม่
        for (const option of options) {
          const optionElement = document.createElement("option");
          optionElement.value = option.value;
          optionElement.textContent = option.text;
          wgNameSelect.appendChild(optionElement);
        }
      }
    };

    xhr.send();
  }
</script>

</html>