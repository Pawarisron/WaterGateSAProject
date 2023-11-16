<?php
    
    session_start();
    require_once '../db.php';

    
    if(isset($_POST['submitAssignment'])){

        $open_time = $_POST['openTimestamp'];
        $close_time = $_POST['closeTimestamp'];
        $current_cmd_ID = $_POST['current_cmd_ID'];
        $employee_ID = $_SESSION['employee_login'];
        $watergate_ID = $_POST['watergate_ID'];
        $cmd_order = $_POST['cmd_order'];

        try{
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            $cmd_status = 1;

                $message = "UPDATE commands_log
                            SET open_time = :open_time, close_time = :close_time, staff_ID = :employee_ID, cmd_status = :cmd_status
                            WHERE cmd_ID = :current_cmd_ID AND cmd_order = :cmd_order;";

            $data = $conn->prepare($message);
            $data->bindParam(':cmd_order', $cmd_order);
            $data->bindParam(':current_cmd_ID', $current_cmd_ID);
            $data->bindParam(':cmd_status', $cmd_status, PDO::PARAM_INT);
            $data->bindParam(':employee_ID', $employee_ID);
            $data->bindParam(':close_time', $close_time);
            $data->bindParam(':open_time', $open_time);
            $data->execute();


            $gate_status = 2;
            $update_gate_status_query = "UPDATE watergate SET gate_status = :gate_status WHERE watergate_ID = :watergate_ID";
            $update_gate_status_statement = $conn->prepare($update_gate_status_query);
            $update_gate_status_statement->bindParam(':watergate_ID', $watergate_ID, PDO::PARAM_STR);
            $update_gate_status_statement->bindParam(':gate_status', $gate_status, PDO::PARAM_INT);
            $update_gate_status_statement->execute();

            header("location: ../view/employee/employee-wg-assignment01.php?cmd_ID=$current_cmd_ID&watergate_ID=$watergate_ID&cmd_order=$cmd_order");
                
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
?>