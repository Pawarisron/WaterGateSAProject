<?php
    session_start();
    require_once '../../db.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    function generateCommandID($conn) {
        $prefix = "CMD";  // คำนำหน้าของ command_ID
        $sql = "SELECT MAX(CAST(SUBSTR(cmd_ID, 4) AS UNSIGNED)) AS max_id FROM commands_log";
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
            $manager_ID = $_SESSION['manager_login'];
            $cmd_ID = generateCommandID($conn);
            $success = true;
            $cmd_order = 1;
            foreach ($data as $row) {
                $from_ID_gate = $row['from_ID_gate'];
                $to_ID_gate = $row['to_ID_gate'];
                $waterQuantity = $row['waterQuantity'];
                $inputNote = $row['inputNote'];
                $cmd_status = 1;

                // ใส่ข้อมูลเข้าตาราง commands_log
                $sql = "INSERT INTO commands_log(cmd_ID, cmd_order, note, open_time, close_time, staff_ID, cmd_status) 
                VALUES (:cmd_ID, :cmd_order, :note, NULL, NULL, NULL, :cmd_status)";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':cmd_ID', $cmd_ID, PDO::PARAM_STR);
                $stmt->bindParam(':cmd_order', $cmd_order , PDO::PARAM_STR); 
                $stmt->bindParam(':note', $inputNote, PDO::PARAM_STR);
                $stmt->bindParam(':cmd_status', $cmd_status, PDO::PARAM_STR);

                if (!$stmt->execute() ) {
                    $success = false;
                    break; 
                }

                // เก็บค่าเข้า cmd_route
                $sql2 = "INSERT INTO cmd_route(cmd_ID, cmd_order, from_ID_gate, to_ID_gate, amount) VALUES (:cmd_ID, :cmd_order, :from_ID_gate, :to_ID_gate, :amount)";

                $stmt2 = $conn->prepare($sql2);
                $stmt2->bindParam(':cmd_ID', $cmd_ID, PDO::PARAM_STR);
                $stmt2->bindParam(':cmd_order', $cmd_order , PDO::PARAM_STR); 
                $stmt2->bindParam(':from_ID_gate', $from_ID_gate, PDO::PARAM_STR);
                $stmt2->bindParam(':to_ID_gate', $to_ID_gate, PDO::PARAM_STR);
                $stmt2->bindParam(':amount', $waterQuantity, PDO::PARAM_STR);

                

                if (!$stmt2->execute() ) {
                    $success = false;
                    break; 
                }

                // อัพเดต Gate Status ของประตูนั้นๆ
                $newStatus = 2;
                $sql3 = "UPDATE watergate SET gate_status = :gate_status WHERE watergate_ID = :watergate_ID";
                $stmt3 = $conn->prepare($sql3);
                $stmt3->bindParam(':gate_status', $newStatus, PDO::PARAM_INT);
                $stmt3->bindParam(':watergate_ID', $from_ID_gate, PDO::PARAM_STR);

                if (!$stmt3->execute() ) {
                    $success = false;
                    break; 
                }
                $cmd_order = $cmd_order + 1;
            }

            // ส่วนที่ใส่เวลาใน assign_time
            $sql4 = "INSERT INTO assign_time(cmd_ID, manager_ID) VALUES (:cmd_ID, :manager_ID)";
            $stmt4 = $conn->prepare($sql4);
            $stmt4->bindParam(':cmd_ID', $cmd_ID, PDO::PARAM_STR);
            $stmt4->bindParam(':manager_ID', $manager_ID, PDO::PARAM_STR);
            
            if (!$stmt4->execute()) {
                $success = false;
                
            }

            if ($success) {

                header('location: manager-assignment-order.php');
            } else {
                echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $stmt->errorInfo();
            }
    

        } else {
            // รับข้อมูล JSON ผิดพลาด
            echo "Invalid JSON data";
        }
        
    }


    
?>
