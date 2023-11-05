<?php

    session_start();
    require_once '../db.php';




    if(isset($_POST['submitReport'])){
        
        $watergate_ID = $_POST['watergate_name'];
        $flow_rate = $_POST['flow_rate'];
        $upstream = $_POST['upstream'];
        $downstream = $_POST['downstream'];
        $report_date = $_POST['timestamp'];
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
                
                $lastInsertId = $conn->lastInsertId();
                try{
                    $message2 = "INSERT INTO daily_report_time(report_time_ID, report_date) VALUES (:report_time_ID, :report_date)";
                    $check_data = $conn->prepare($message2);
                    $check_data->bindParam(':report_time_ID', $lastInsertId);
                    $check_data->bindParam(':report_date', $report_date, PDO::PARAM_STR);
                    $check_data->execute();

                    try{
                        $criterion_query = "SELECT criterion FROM watergate WHERE watergate_ID = :watergate_ID";
                        $criterion_statement = $conn->prepare($criterion_query);
                        $criterion_statement->bindParam(':watergate_ID', $watergate_ID, PDO::PARAM_STR);
                        $criterion_statement->execute();

                        $criterion_result = $criterion_statement->fetch(PDO::FETCH_ASSOC);
                        $gate_status = ($upstream <= $criterion) ? 0 : 1;

                        $update_gate_status_query = "UPDATE watergate SET gate_status = :gate_status WHERE watergate_ID = :watergate_ID";
                        $update_gate_status_statement = $conn->prepare($update_gate_status_query);
                        $update_gate_status_statement->bindParam(':gate_status', $gate_status, PDO::PARAM_INT);
                        $update_gate_status_statement->bindParam(':watergate_ID', $watergate_ID, PDO::PARAM_STR);
                        $update_gate_status_statement->execute();
    
                        header('location: ../view/employee/employee-wg-reporter.php');
                    }
                    catch(PDOException $e){
                        echo $e->getMessage();
    
                    }
                    
                }
                catch(PDOException $e){
                    echo $e->getMessage();

                }
    
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    
    

?>