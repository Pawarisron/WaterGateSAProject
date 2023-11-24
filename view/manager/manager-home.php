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
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $jsonData = json_encode($rows);

    ////////////////////////////////////////////////
    $sql2 = "SELECT * FROM watergate";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute();
    $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    $watergateName = json_encode($rows2);
    ////////////////////////////////////////////////
    $sql3 = "SELECT * FROM daily_report r JOIN watergate w ON w.watergate_ID = r.watergate_ID";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->execute();
    $rows3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
    $everyReports = json_encode($rows3);
    
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
        <div class="form-group" style="display: flex; justify-content: center; align-items: center;">
          <select id="WgName" class="form-control" style="width:50%">

          </select>
          <button name="selectWG" type="button" class="btn-primary" style="font-size: 16px; margin-left: 5%;" onclick="processSelectedValue()">ตกลง</button>
        </div>
        <div class="panel panel-default table-responsive">
          <table class="table table-striped table-bordered templatemo-user-table"  style="text-align: center;">
            <thead>
              <tr>
                <td data-column="id" data-order="desc">ID</td>
                <td data-column="gate_name" data-order="desc">ชื่อประตูระบายน้ำ</td>
                <td data-column="status" data-order="desc" >สถานะปัจจุบัน</td>
                <td data-column="date" data-order="desc">วันที่บันทึกผล</td>
                <td data-column="flow_rate" data-order="desc">อัตราการไหล (ลบ.ม./วินาที)</td>
                <td data-column="upstream" data-order="desc">ระดับน้ำเหนือน้ำ (ม.รทก.)</td>
                <td data-column="downstream" data-order="desc">ระดับน้ำท้ายน้ำ (ม.รทก.)</td>
                
              </tr>
            </thead>
            <tbody id="tableBody">
           
            </tbody>
          </table>    
        </div>
      </div>
    </div>

  </div>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <script>
    var originalTable = <?php echo $jsonData; ?>; 
    var tableData = originalTable.slice(); 
    var watergateName = <?php echo $watergateName; ?>; 
    var everyReports = <?php echo $everyReports; ?>; 
    //console.log(tableData);

      $('td').on('click', function(){
        var column = $(this).data('column');
        var order = $(this).data('order');
        // var tempoData = tableData;
        console.log(order, " + ", column)
        var originalText = $(this).data('original-text');

        if (order == 'desc') {
          $(this).data('order', 'asc');
          $(this).html(originalText + ' ▼');
        } else {
          $(this).data('order', 'desc');
          $(this).html(originalText + ' ▲');
        }
        sortFunction(order, column, tableData);

      })
      $('td').each(function() {
        if (!$(this).data('original-text')) {
          $(this).data('original-text', $(this).text());
        }
      });

    function sortFunction(order, column , tempoData){

      tempoData.sort(function(a, b) {
        if (column === 'date') {
          var dateA = new Date(a.report_time);
          var dateB = new Date(b.report_time);
          return order === 'desc' ? dateB - dateA : dateA - dateB;
        } else if (column === 'status') {
          var statusA = a.gate_status;
          var statusB = b.gate_status;
          return order === 'desc' ? statusB - statusA : statusA - statusB;
        }
        else if (column === 'flow_rate') {
          var flow_rateA = a.flow_rate;
          var flow_rateB = b.flow_rate;
          return order === 'desc' ? flow_rateB - flow_rateA : flow_rateA - flow_rateB;
        }
        else if (column === 'upstream') {
          var upstreamA = a.upstream;
          var upstreamB = b.upstream;
          return order === 'desc' ? upstreamB - upstreamA : upstreamA - upstreamB;
        }
        else if (column === 'downstream') {
          var downstreamA = a.downstream;
          var downstreamB = b.downstream;
          return order === 'desc' ? downstreamB - downstreamA : downstreamA - downstreamB;
        }
        else if (column === 'id') {
          var idA = a.watergate_ID;
          var idB = b.watergate_ID;
          return order === 'desc' ? idB.localeCompare(idA) : idA.localeCompare(idB);
        }
        else if (column === 'gate_name') {
          var gate_nameA = a.gate_name;
          var gate_nameB = b.gate_name;
          return order === 'desc' ? gate_nameB.localeCompare(gate_nameA) : gate_nameA.localeCompare(gate_nameB);
        }

        return 0;
      });


      tableData = tempoData;
      loadTable(tableData);
    }


    function loadTable(data) {
        var tableBody = document.getElementById('tableBody');

        tableBody.innerHTML = '';

        for (var i = 0; i < data.length; i++) {
          var row = tableBody.insertRow(i);
          var cell0 = row.insertCell(0);
          var cell1 = row.insertCell(1);
          var cell2 = row.insertCell(2);
          var cell3 = row.insertCell(3);
          var cell4 = row.insertCell(4);
          var cell5 = row.insertCell(5);
          var cell6 = row.insertCell(6);

          cell0.innerHTML = data[i].watergate_ID;
          cell1.innerHTML = data[i].gate_name;

          if (data[i].gate_status == 0) {
              cell2.innerHTML = "ปกติ";
          } else if (data[i].gate_status == 1) {
              cell2.innerHTML = "วิกฤติ";
          } else if (data[i].gate_status == 2) {
              cell2.innerHTML = "กำลังแก้ไข";
          } else {
              cell2.innerHTML = "Unknown Status";
          }



          cell3.innerHTML = data[i].report_time;
          cell4.innerHTML = data[i].flow_rate;
          cell5.innerHTML = data[i].upstream;
          cell6.innerHTML = data[i].downstream;

            
        }
    }
    loadTable(tableData);

    function populateDropdown() {
      wgDropdown = document.getElementById('WgName');
      wgDropdown.innerHTML = '';
      for (var i = 0; i < watergateName.length; i++) {
        if(i === 0){
          var option = document.createElement('option');
          option.value = "ตารางวันที่บันทึกผลล่าสุด";
          option.textContent = "ตารางวันที่บันทึกผลล่าสุด";
          wgDropdown.appendChild(option);

        }

          var gateName = watergateName[i].gate_name;
          var watergate_ID = watergateName[i].watergate_ID;
          var option = document.createElement('option');
          option.value = watergate_ID;
          option.textContent = gateName;
          // console.log(option);
          wgDropdown.appendChild(option);
        
      }
    }

    populateDropdown();

    function processSelectedValue() {
      var WgName = document.getElementById('WgName');
      console.log(WgName.value);
      if (WgName.value === "ตารางวันที่บันทึกผลล่าสุด") {
          // Reset the text to plain text without triangle up or down
          $('td').each(function() {
            $(this).html($(this).data('original-text'));
          });

          // Reset the order data
          $('td').data('order', 'desc');
          
          // Load the original table data
          tableData = originalTable.slice();
          loadTable(tableData);
        }
      else{
        var filteredReports = everyReports.filter(function (report) {
          return report.watergate_ID == WgName.value;
        });
        tableData = filteredReports;
        
        tableData.sort(function(a, b) {
          var dateA = new Date(a.report_time);
          var dateB = new Date(b.report_time);
          return dateB - dateA;
        });
        loadTable(tableData);
      }
      }



  </script> 

</body>
</html>