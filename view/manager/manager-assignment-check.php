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

    $sql = "SELECT *, employee.employee_Fname, employee.employee_Lname
    FROM `assign_time`
    JOIN employee ON assign_time.manager_ID = employee.employee_ID;";


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
      <div class="assignment-table-rdu" style="text-align: center; margin: 20px;">
        <h2 style="margin: 20px;">บันทึกการสั่งงานทั้งหมด</h2>
        <div class="panel panel-default table-responsive">
          <table class="table table-striped table-bordered templatemo-user-table" style="text-align: center;">
            <thead>
              <tr>
                <td data-column="cmd_ID" data-order="desc">ID</td>
                <td data-column="cmd_time" data-order="desc">วันที่</td>
                <td data-column="employee_Fname" data-order="desc">ชื่อผู้ออกคำสั่ง</td>
                <td>การจัดการ</td>
              </tr>
            </thead>
            <tbody id = "tableBody">
    
            </tbody>
          </table>    
        </div>
      </div>
    </div>

  </div>
  <!-- echo "<td><a href=manager-assignment-check01.php?cmd_ID=".$row["cmd_ID"].">รายละเอียดคำสั่ง</a></td>"; -->

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script> 
    var tableData = <?php echo $jsonData; ?>; 


    $('td').on('click', function(){
        var column = $(this).data('column')
        var order = $(this).data('order')
        // var tempoData = tableData;
        console.log(order, " + ", column)
        if(column !== undefined){
        
          var originalText = $(this).data('original-text');

          if (order == 'desc') {
            $(this).data('order', 'asc');
            $(this).html(originalText + ' ▼');
          } else {
            $(this).data('order', 'desc');
            $(this).html(originalText + ' ▲');
          }
          sortFunction(order, column, tableData);
        }
      })


      $('td').each(function() {
        if (!$(this).data('original-text')) {
          $(this).data('original-text', $(this).text());
        }
      });
      function sortFunction(order, column , tempoData){
        tempoData.sort(function(a, b) {
         if (column === 'cmd_time') {
          var dateA = new Date(a.cmd_time);
          var dateB = new Date(b.cmd_time);
          return order === 'desc' ? dateB - dateA : dateA - dateB;
        }
        else if (column === 'cmd_ID') {
            var idA = a.cmd_ID;
            var idB = b.cmd_ID;
            return order === 'desc' ? idB.localeCompare(idA) : idA.localeCompare(idB);
          }
        else if (column === 'employee_Fname') {
            var employee_FnameA = a.employee_Fname;
            var employee_FnameB = b.employee_Fname;
            return order === 'desc' ? employee_FnameB.localeCompare(employee_FnameA) : employee_FnameA.localeCompare(employee_FnameB);
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


          cell0.innerHTML = data[i].cmd_ID;
          cell1.innerHTML = data[i].cmd_time;

          cell2.innerHTML = data[i].employee_Fname + " " + data[i].employee_Lname;

          var checkLink = document.createElement('a');
          checkLink.href =
              'manager-assignment-check01.php?cmd_ID=' +
              data[i].cmd_ID;
          checkLink.innerHTML = 'รายละเอียดคำสั่ง (Manager)';
          
          cell3.appendChild(checkLink);
        }
    }
    loadTable(tableData);
  </script>


</body>
</html>