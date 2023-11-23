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

    // if (isset($_SESSION['watergate_ID'])) {
    //   $watergate_ID = $_SESSION['watergate_ID'];
    //   echo $_SESSION['watergate_ID'];
    // } 

    if (isset($_GET['watergate_ID'])) {
          $_SESSION['watergate_ID'] = $_GET['watergate_ID'];
          $watergate_ID = $_SESSION['watergate_ID'];
          echo  $_SESSION['watergate_ID'];
    }

    


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
          <table name = "dataTable" id="dataTable" class="table">
            <tbody style="text-align: left; padding-left: 40px;">
              








            </tbody>
          </table>
        </div>
        <div class="form-group" style="margin: 15px;">
          <button type="button" class="btn-primary" style="font-size: 16px;" onClick="window.location.reload();">Clear</button>
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
                <table name = "secondDataTable" id="secondDataTable"class="table">
                  <tbody style="text-align: center; padding-left: 40px;">
                    





















                  
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
               <div class="col-lg-12 col-md-12 form-group">
                    <label for="fromWgName">ประตูปล่อยน้ำ</label>
                    <select id="fromWgName" class="form-control" onchange="updateToWgNameOptions(this.value)">
                    </select>
                </div>

                <div class="col-lg-12 col-md-12 form-group">
                  <label for="toWgName">ประตูรับน้ำ</label>
                  <select id="toWgName" class="form-control">
                  </select>
                </div>

                
                
                <div class="col-lg-12 col-md-12 form-group">
                  <label for="waterQuantity">ปริมาณน้ำระบายออก (ม.รทก.)</label>
                  <input name='waterQuantity' type="number" step="0.000001" class="form-control" id="waterQuantity" placeholder="" >
                </div>
                <div class="col-lg-12 col-md-12 form-group">
                  <label for="note">หมายเหตุ</label>
                  <textarea class="form-control" id="inputNote" rows="3" ></textarea>
                </div>
                <div class="form-group" style="text-align: center; padding-top: 20px;">
                  <button name="nextNode" type="button" class="btn-primary" style="font-size: 16px;" onclick="addData()">Add</button>
                  <button name="finishRoute" type="button" class="btn-primary" style="font-size: 16px; margin-left: 55%" onclick="sendDataToPHP()">Finish</button>


                  <!-- <button name="finishRoute" type="submit" class="btn-primary" style="font-size: 16px; margin-left: 55%" formnovalidate >Finish</button> -->
                </div>
              
              <!-- <input type="submit" name="finishRoute" value="finish" class="btn-primary" style="font-size: 16px; margin-left: 55%"> -->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="../../js/script.js"></script> 
  
  
</body>

<?php 
  require_once '../../db.php';
?>

<script >
    var watergate = {
    _watergate_ID: <?php echo json_encode($_SESSION['watergate_ID']); ?>,
    
    get watergate_ID() {
        return this._watergate_ID;
    },
    
    set watergate_ID(newID) {
        this._watergate_ID = newID;
    }
    };

    const fromWgNameOptions = [];
    const toWgNameOptions = [];

    
    function addData() {
        // var fromWgNameSelect = document.getElementById('fromWgName');
        // var tempo = fromWgNameSelect.options[fromWgNameSelect.selectedIndex].value;
        var fromWgNameSelect = document.getElementById('fromWgName');
        var toWgNameSelect = document.getElementById('toWgName');
        var waterQuantity = document.getElementById('waterQuantity').value;
        var inputNote = document.getElementById('inputNote').value;

        if (fromWgNameSelect.options[fromWgNameSelect.selectedIndex].value === '' || toWgNameSelect.options[toWgNameSelect.selectedIndex].value === '' || waterQuantity === '' || inputNote === '') {
          alert('Please fill in all fields');
          return; 
        }
        var dataTable = document.getElementById('dataTable');
            

        var newRow = dataTable.insertRow(dataTable.rows.length);
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        var cell4 = newRow.insertCell(3);
            

        cell1.innerHTML = fromWgNameSelect.options[fromWgNameSelect.selectedIndex].value;
        cell2.innerHTML = toWgNameSelect.options[toWgNameSelect.selectedIndex].value;
        cell3.innerHTML = waterQuantity;
        cell4.innerHTML = inputNote;


        
        document.getElementById('waterQuantity').value = '';
        document.getElementById('inputNote').value = '';


        fromWgNameOptions.push(toWgNameSelect.options[toWgNameSelect.selectedIndex].value);
        updateFromWgOptions();
        updateToWgNameOptions(fromWgNameSelect.options[toWgNameSelect.selectedIndex].value);
        

    }
    function loadSecondDataTable() {  
            
            var fromWgNameSelect = document.getElementById('fromWgName');
            var selectedValue = fromWgNameSelect.value;
            var additionalVariable = watergate.watergate_ID;
            console.log('loadSecondDataTable ทำงานกับ ID: ' + selectedValue + ' และมี original ID เป็น: '  + additionalVariable);

            var xhr = new XMLHttpRequest();
            
            var url = `load_SecondDataTable_options.php?watergate_ID=${selectedValue}&additional_variable=${additionalVariable}`;

            xhr.open("GET", url, true);
            //console.log(watergate.watergate_ID + ' นอกบน');
            xhr.onreadystatechange = function () {
              if (xhr.readyState == 4 && xhr.status == 200) {
                  //console.log(watergate.watergate_ID + ' ใน');
                  const options = JSON.parse(xhr.responseText);
                  console.log(options);
                  

                  var secondDataTable = document.getElementById('secondDataTable');
                  while (secondDataTable.hasChildNodes()) {
                        secondDataTable.removeChild(secondDataTable.firstChild);
                  }


                  if(options.length == 0){
                    
                      var row = secondDataTable.insertRow(0);
                      var cell1 = row.insertCell(0);
                      cell1.innerHTML = '<div style="text-align: center; font-weight: bold;">ไม่สามารถปล่อยประตูน้ำไปไหนได้อีกแล้ว</div>';
                    
                  }
                  else{
                    var headerRow = secondDataTable.insertRow(0);
                    var headerCell1 = headerRow.insertCell(0);
                    var headerCell2 = headerRow.insertCell(1);
                    var headerCell3 = headerRow.insertCell(2);

                    headerCell1.innerHTML = '<div style="text-align: center; font-weight: bold;">ID</div>';
                    headerCell2.innerHTML = '<div style="text-align: center; font-weight: bold;">ชื่อประตู</div>';
                    headerCell3.innerHTML = '<div style="text-align: center; font-weight: bold;">ปริมาณน้ำที่สามารถรองรับได้</div>';
                          
                    for (var i = 0; i < options.length; i++) { 
                      var row = secondDataTable.insertRow(i+1);
                      var cell1 = row.insertCell(0);
                      var cell2 = row.insertCell(1);
                      var cell3 = row.insertCell(2);
                      if(i == 0){
                        cell1.innerHTML = '<div style="text-align: center; color: red;">' + options[i].watergate_ID + '</div>';
                        cell2.innerHTML = '<div style="text-align: center; color: red;">' + options[i].gate_name + '</div>';
                        cell3.innerHTML = '<div style="text-align: center; color: red;">' + (options[i].criterion - options[i].upstream).toFixed(3) + '</div>';
                      }
                      else{
                        cell1.innerHTML = '<div style="text-align: center;">' + options[i].watergate_ID + '</div>';
                        cell2.innerHTML = '<div style="text-align: center;">' + options[i].gate_name + '</div>';
                        cell3.innerHTML = '<div style="text-align: center;">' + (options[i].criterion - options[i].upstream).toFixed(3) + '</div>';
                      }
                      
                    }   
                  }
                  
                  


                  
              };
            }
            xhr.send();
            //console.log(watergate.watergate_ID + ' นอกล่าง');


    }
 
    function sendDataToPHP() {
        var dataTable = document.getElementById('dataTable');
        var dataRows = dataTable.getElementsByTagName('tr');

        var dataToSend = [];
        
        for (var i = 0; i < dataRows.length; i++) {  // เริ่มต้นที่ 1 เพื่อข้ามแถวหัวตาราง
            var cells = dataRows[i].getElementsByTagName('td');
            
            var from_ID_gate = cells[0].textContent;
            var to_ID_gate = cells[1].textContent;
            var waterQuantity = cells[2].textContent;
            var inputNote = cells[3].textContent;


            console.log(cells[0].textContent);
            console.log(cells[1].textContent);
            console.log(cells[2].textContent);
            console.log(cells[3].textContent);

                 
            // เพิ่มข้อมูลลงในอาร์เรย์
            dataToSend.push({
                from_ID_gate: from_ID_gate,
                to_ID_gate: to_ID_gate,
                waterQuantity: waterQuantity,
                inputNote: inputNote
            });
        }
        
        // สร้าง URL parameters จากข้อมูลที่คุณรวบรวม
        var params = 'data=' + JSON.stringify(dataToSend);
        
        // แล้วเปลี่ยนหน้าเป็น PHP และส่งข้อมูลผ่าน URL parameters
        window.location.href = 'manager-assignment-order01-controller.php?' + params;
        error_reporting(E_ALL);
        ini_set('display_errors', 1);


    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // เพื่อโหลดข้อมูลใน Dropdown เมื่อหน้าเว็บโหลด
    document.addEventListener("DOMContentLoaded", function () {
        fromWgNameOptions.push(<?php echo json_encode($watergate_ID); ?>);
        
        updateFromWgOptions();
        
        //console.log(fromWgNameOptions);
        updateToWgNameOptions(<?php echo json_encode($watergate_ID); ?>);
      })


//////////////////////////////////////////////////////////////////////////////////////////////////////////////

      
      

      function updateToWgNameOptions(selectedValue) {
        const toWgNameSelect = document.getElementById('toWgName');
        toWgNameSelect.innerHTML = '';
    
        loadSecondDataTable();
        const xhr = new XMLHttpRequest();
        xhr.open("GET", `load_watergate_options.php?watergate_ID=${selectedValue}`, true);

        xhr.onload = function () {
          if (xhr.status === 200) {
            const options = JSON.parse(xhr.responseText);

            
            
            

            toWgNameOptions.length = 0;
            for (const option of options) {
              const isOptionInFromWgName = fromWgNameOptions.includes(option.text);
              // console.log(option.value + ' สถานะคือ ' + isOptionInFromWgName  );

              



              // console.log(fromWgNameOptions);
              if (!isOptionInFromWgName) {
                  const optionElement = document.createElement("option");
                  optionElement.value = option.value;
                  optionElement.textContent = option.text;
                  toWgNameSelect.appendChild(optionElement);
                  toWgNameOptions.push(optionElement.value);
              }
              else{
                console.log("เจอแล้ววว  " + option.value);
              }
            }
            
          }
          // console.log('to: ' + toWgNameOptions);
          // console.log('from: ' + fromWgNameOptions);
          // console.log('แบ่งรอบแบ่งรอบแบ่งรอบแบ่งรอบแบ่งรอบแบ่งรอบแบ่งรอบแบ่งรอบแบ่งรอบแบ่งรอบแบ่งรอบ');
        };

        xhr.send();


      }

      function updateFromWgOptions() {
        var fromWgNameSelect = document.getElementById('fromWgName');

        // Clear existing options in the dropdown
        fromWgNameSelect.innerHTML = '';

        // Loop through fromWgNameOptions and create options
        for (var i = 0; i < fromWgNameOptions.length; i++) {
            var option = document.createElement("option");
            option.value = fromWgNameOptions[i];
            option.textContent = fromWgNameOptions[i];
            fromWgNameSelect.appendChild(option);
        }
      }

      function showDataTable() {
        var dataTable = document.getElementById('dataTable');
        var rows = dataTable.getElementsByTagName('tr');
        
        console.log(rows.length);

        for (var i = 0; i < rows.length; i++) { // Start from 1 to skip the header row
            var cells = rows[i].getElementsByTagName('td');
            var rowData = [];
            for (var j = 0; j < cells.length; j++) {
                rowData.push(cells[j].innerHTML);
            }
            console.log("Row " + (i) + ": " + rowData.join(', '));
        }
        
      }






</script>

</html>