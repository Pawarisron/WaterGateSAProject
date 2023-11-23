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

    $sql = "SELECT assi.cmd_ID, cmd_time, watergate.watergate_ID, watergate.gate_name, c.cmd_order
    FROM assign_time AS assi
    JOIN cmd_route ON assi.cmd_ID = cmd_route.cmd_ID
    JOIN commands_log AS c ON cmd_route.cmd_ID = c.cmd_ID AND cmd_route.cmd_order = c.cmd_order
    JOIN watergate ON cmd_route.from_ID_gate = watergate.watergate_ID 
    WHERE c.cmd_status = 0
    ORDER BY cmd_ID;";

    
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
      <div class="assignment-table"  style="text-align: center; margin: 20px;">
        <h2 style="margin: 20px;">รายการการสั่งงานประจำวัน</h2>
        <div class="panel panel-default table-responsive">
          <table class="table table-striped table-bordered templatemo-user-table" style="text-align: center;">
            <thead>
              <tr>
                <td data-column="cmd_ID" data-order="desc">ID Command</td>
                <td data-column="cmd_order" data-order="desc">Command Order</td>
                <td data-column="cmd_time" data-order="desc">วันที่</td>
                <td data-column="gate_name" data-order="desc">ประตูน้ำ</td>
                <td>คำสั่ง</td>
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
        if (column === 'cmd_time') {
          var dateA = new Date(a.cmd_time);
          var dateB = new Date(b.cmd_time);
          return order === 'desc' ? dateB - dateA : dateA - dateB;
        } else if (column === 'cmd_ID') {
          console.log(a.cmd_ID , " กับ " , b.cmd_ID);
          var cmd_ID_A = a.cmd_ID;
          var cmd_ID_B = b.cmd_ID;
          return order === 'desc' ? cmd_ID_B.localeCompare(cmd_ID_A) : cmd_ID_A.localeCompare(cmd_ID_B);
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


          cell0.innerHTML = data[i].cmd_ID;
          cell1.innerHTML = data[i].cmd_order;
          cell2.innerHTML = data[i].cmd_time;
          cell3.innerHTML = data[i].gate_name;

          var link = document.createElement('a');
          link.href =
              'employee-wg-assignment01.php?cmd_ID=' +
              data[i].cmd_ID +
              '&watergate_ID=' +
              data[i].watergate_ID +
              '&cmd_order=' +
              data[i].cmd_order;
          link.innerHTML = 'รายละเอียดคำสั่ง';

          cell4.appendChild(link);          

            
        }
    }
    loadTable(tableData);
  </script>

</body>
</html>