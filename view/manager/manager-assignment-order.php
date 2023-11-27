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

    $sql = "SELECT w.*, r.*
    FROM watergate w
    INNER JOIN (
        SELECT watergate_ID, MAX(report_time) AS max_report_time
        FROM daily_report
        GROUP BY watergate_ID
    ) latest_reports
    ON w.watergate_ID = latest_reports.watergate_ID
    JOIN daily_report r
    ON latest_reports.watergate_ID = r.watergate_ID AND latest_reports.max_report_time = r.report_time WHERE w.gate_status = 1;";
    
    
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $jsonData = json_encode($rows);
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
                <td data-column="id" data-order="desc">ID</td>
                <td data-column="gate_name" data-order="desc">ชื่อประตูระบายน้ำ</td>
                <td data-column="status" data-order="desc">สถานะปัจจุบัน</td>
                <td data-column="upstream" data-order="desc">ระดับน้ำเหนือน้ำ(ม.รทก.)</td>
                <td data-column="downstream" data-order="desc">ระดับน้ำท้ายน้ำ(ม.รทก.)</td>
                <td data-column="criterion" data-order="desc">เกณฑ์ควบคุมระดับน้ำเหนือน้ำ (ม.รทก.)</td>
                <td>ดำเนินการแก้ไข</td>
              </tr>
            </thead>
            <tbody id="tableBody" style="text-align: center;">

            </tbody>
          </table>    
        </div>
      </div>
    </div>

  </div>
  <!-- echo '<td><a href="manager-assignment-order01.php?watergate_ID=' . $row['watergate_ID'] . '">สั่งการ</a></td>'; -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script> 
    var tableData = <?php echo $jsonData; ?>; 


    $('td').on('click', function(){
        var column = $(this).data('column')
        var order = $(this).data('order')
        // var tempoData = tableData;
        console.log(order, " + ", column)
        if(order == 'desc'){
          $(this).data('order', "asc")
        }
        else{
          $(this).data('order', "desc")
        }
        sortFunction(order, column, tableData);

      })
      function sortFunction(order, column , tempoData){
        tempoData.sort(function(a, b) {
          if (column === 'status') {
            var statusA = a.gate_status;
            var statusB = b.gate_status;
            return order === 'desc' ? statusB - statusA : statusA - statusB;
          }
          else if (column === 'criterion') {
            var criterionA = a.criterion;
            var criterionB = b.criterion;
            return order === 'desc' ? criterionB - criterionA : criterionA - criterionB;
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



          cell3.innerHTML = data[i].upstream;
          cell4.innerHTML = data[i].downstream;
          cell5.innerHTML = data[i].criterion;
          var managerLink = document.createElement('a');
          managerLink.href =
              'manager-assignment-order01.php?watergate_ID=' +
              data[i].watergate_ID;
          managerLink.innerHTML = 'สั่งการ';
          cell6.appendChild(managerLink);
        }
    }
    loadTable(tableData);
  </script>

  

</body>
</html>