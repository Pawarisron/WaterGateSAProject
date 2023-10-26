<?php

    session_start();
    require_once '../db.php';




    if(isset($_POST['submitReport'])){
        
        $watergate_ID = $_POST['watergate_ID'];
        $flow_rate = $_POST['flow_rate'];
        $upstream = $_POST['upstream'];
        $downstream = $_POST['downstream'];
        $timestamp = $_POST['timestamp'];
        $employee_report_ID = $_SESSION['employee_login'];
        
            try{

                

                $message = "INSERT INTO daily_report(employee_report_ID, 
                watergate_report_ID, upstream, downstream, flow_rate) 
                VALUES (:employee_report_ID, :watergate_ID, :upstream, :downstream, :flow_rate)";
                
                $check_data = $conn->prepare($message);

                $check_data->bindParam(':employee_report_ID', $employee_report_ID, PDO::PARAM_STR);
                $check_data->bindParam(':watergate_ID', $watergate_ID, PDO::PARAM_STR);
                $check_data->bindParam(':upstream', $upstream, PDO::PARAM_STR);
                $check_data->bindParam(':downstream', $downstream, PDO::PARAM_STR);
                $check_data->bindParam(':flow_rate', $flow_rate, PDO::PARAM_STR);
                
                
                $check_data->execute();
                

                // try{
                //     $message2 = "INSERT INTO daily_report_time(report_time_ID, report_date) VALUES ('[value-1]','[value-2]')";
                //     $check_data->bindParam(':watergate_ID', $watergate_ID, PDO::PARAM_STR);
                // }
                // catch(PDOException $e){
                //     echo $e->getMessage();

                // }
                header('location: ../view/employee/employee-wg-reporter.php');
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    
    

?>