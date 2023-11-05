<?php
    session_start();
    require_once '../../db.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    function generateCommandID($conn) {
        $prefix = "CMD";  // คำนำหน้าของ command_ID
        $sql = "SELECT MAX(CAST(SUBSTR(command_ID, 4) AS UNSIGNED)) AS max_id FROM commands_log";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $max_id = $row['max_id'];
        $new_id = $max_id + 1;
        return $prefix . str_pad($new_id, 5, '0', STR_PAD_LEFT);  // รูปแบบเลขอัตโนมัติ
    }

    if (isset($_GET['data'])) {
        $data = json_decode($_GET['data'], true);

        if ($data !== null) {
            $employee_report_ID = $_SESSION['manager_login'];
            $command_ID = generateCommandID($conn);
            foreach ($data as $row) {
                $watergate_ID = $row['watergate_ID'];
                $timestamp = $row['timestamp'];
                
                if($row['waterQuantity'] == NULL){
                    $waterQuantity = 0;
                }else{
                    $waterQuantity = $row['waterQuantity'];
                }

                if($row['inputNote'] == NULL){
                    $inputNote = "นี่คือประตูสุดท้ายของคำสั่ง " . $command_ID . " ไม่ต้องกระทำการใดๆต่อ" ;
                }else{
                    $inputNote = $row['inputNote'];
                }

                
                
                $sql = "INSERT INTO commands_log(command_ID, watergate_com_ID, employee_com_ID, note, amount, open_time, close_time) 
                VALUES (:command_ID, :watergate_com_ID, :employee_report_ID, :note, :amount, NULL, NULL)";

                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':command_ID', $command_ID, PDO::PARAM_STR);
                $stmt->bindParam(':watergate_com_ID', $watergate_ID , PDO::PARAM_STR);  
                $stmt->bindParam(':employee_report_ID', $employee_report_ID, PDO::PARAM_STR);
                $stmt->bindParam(':amount', $waterQuantity, PDO::PARAM_STR);
                $stmt->bindParam(':note', $inputNote, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    header('location: manager-assignment-order.php');
                } else {
                    echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $stmt->errorInfo();
                }
            }

        } 
        else {
            // รับข้อมูล JSON ผิดพลาด
            echo "Invalid JSON data";
        }
    }


    
?>
