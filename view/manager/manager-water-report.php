<?php
    /*session_start();
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
    }*/

    
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
  <title>Water Report Chart Employee/Staff</title>
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
          <li><a href="#" class="active"><i class='bx bxs-report'></i> รายงานบันทึกระดับน้ำทั้งหมด</a></li>
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
        <div class="panel panel-default table-responsive">
          <table class="table table-striped table-bordered templatemo-user-table">
            <thead>
              <tr>
                <td><a href="" class="white-text templatemo-sort-by"># <span class="caret"></span></a></td>
                <td><a href="" class="white-text templatemo-sort-by">First Name <span class="caret"></span></a></td>
                <td><a href="" class="white-text templatemo-sort-by">Last Name <span class="caret"></span></a></td>
                <td><a href="" class="white-text templatemo-sort-by">User Name <span class="caret"></span></a></td>
                <td><a href="" class="white-text templatemo-sort-by">Email <span class="caret"></span></a></td>
                <td>Edit</td>
                <td>Action</td>
                <td>Delete</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1.</td>
                <td>John</td>
                <td>Smith</td>
                <td>@jS</td>
                <td>js@company.com</td>
                <td><a href="" class="templatemo-edit-btn">Edit</a></td>
                <td><a href="" class="templatemo-link">Action</a></td>
                <td><a href="" class="templatemo-link">Delete</a></td>
              </tr>
              <tr>
                <td>2.</td>
                <td>Bill</td>
                <td>Jones</td>
                <td>@bJ</td>
                <td>bj@company.com</td>
                <td><a href="" class="templatemo-edit-btn">Edit</a></td>
                <td><a href="" class="templatemo-link">Action</a></td>
                <td><a href="" class="templatemo-link">Delete</a></td>
              </tr>
              <tr>
                <td>3.</td>
                <td>Mary</td>
                <td>James</td>
                <td>@mJ</td>
                <td>mj@company.com</td>
                <td><a href="" class="templatemo-edit-btn">Edit</a></td>
                <td><a href="" class="templatemo-link">Action</a></td>
                <td><a href="" class="templatemo-link">Delete</a></td>
              </tr>
              <tr>
                <td>4.</td>
                <td>Steve</td>
                <td>Bride</td>
                <td>@sB</td>
                <td>sb@company.com</td>
                <td><a href="" class="templatemo-edit-btn">Edit</a></td>
                <td><a href="" class="templatemo-link">Action</a></td>
                <td><a href="" class="templatemo-link">Delete</a></td>
              </tr>
              <tr>
                <td>5.</td>
                <td>Paul</td>
                <td>Richard</td>
                <td>@pR</td>
                <td>pr@company.com</td>
                <td><a href="" class="templatemo-edit-btn">Edit</a></td>
                <td><a href="" class="templatemo-link">Action</a></td>
                <td><a href="" class="templatemo-link">Delete</a></td>
              </tr>  
               <tr>
                <td>6.</td>
                <td>Will</td>
                <td>Brad</td>
                <td>@wb</td>
                <td>wb@company.com</td>
                <td><a href="" class="templatemo-edit-btn">Edit</a></td>
                <td><a href="" class="templatemo-link">Action</a></td>
                <td><a href="" class="templatemo-link">Delete</a></td>
              </tr>  
               <tr>
                <td>7.</td>
                <td>Steven</td>
                <td>Eric</td>
                <td>@sE</td>
                <td>se@company.com</td>
                <td><a href="" class="templatemo-edit-btn">Edit</a></td>
                <td><a href="" class="templatemo-link">Action</a></td>
                <td><a href="" class="templatemo-link">Delete</a></td>
              </tr>  
               <tr>
                <td>8.</td>
                <td>Landi</td>
                <td>Susan</td>
                <td>@lS</td>
                <td>ls@company.com</td>
                <td><a href="" class="templatemo-edit-btn">Edit</a></td>
                <td><a href="" class="templatemo-link">Action</a></td>
                <td><a href="" class="templatemo-link">Delete</a></td>
              </tr>                    
            </tbody>
          </table>    
        </div>
      </div>
    </div>

  </div>
  
  <script src="../../js/script.js"></script> 

</body>
</html>